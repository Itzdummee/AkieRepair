<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    /**
     * Show payment page for a booking
     */
    public function show(Booking $booking)
    {
        Log::info('PaymentController@show - Start', ['booking_id' => $booking->id, 'user_id' => Auth::id()]);
        
        // Verify the booking belongs to the authenticated customer
        if ($booking->customer_id !== Auth::id()) {
            Log::warning('PaymentController@show - Unauthorized access', [
                'booking_customer_id' => $booking->customer_id, 
                'auth_user_id' => Auth::id()
            ]);
            abort(403, 'Unauthorized');
        }

        // Check if repair is finished and waiting for payment
        if ($booking->status !== 'Repair Finished') {
            Log::warning('PaymentController@show - Booking not ready for payment', [
                'booking_id' => $booking->id,
                'current_status' => $booking->status
            ]);
            abort(403, 'This booking is not ready for payment');
        }

        Log::info('PaymentController@show - Success', ['booking_id' => $booking->id]);
        return view('customer.payment', compact('booking'));
    }

    /**
     * Create a Stripe Checkout Session for payment
     */
    public function initiate(Request $request, Booking $booking)
    {
        Log::info('PaymentController@initiate - Start', [
            'booking_id' => $booking->id,
            'user_id' => Auth::id()
        ]);
        
        // Verify the booking belongs to the authenticated customer
        if ($booking->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if repair is finished and waiting for payment
        if ($booking->status !== 'Repair Finished') {
            return response()->json(['error' => 'This booking is not ready for payment'], 400);
        }

        try {
            $stripeSecret = $this->stripeSecret();

            if (!$stripeSecret) {
                Log::error('PaymentController@initiate - Missing Stripe secret key', [
                    'booking_id' => $booking->id,
                ]);

                return response()->json([
                    'success' => false,
                    'error' => 'Payment service is not configured. Please contact admin.',
                ], 500);
            }

            Stripe::setApiKey($stripeSecret);
            
            $deviceName = $booking->device->device_name ?? 'Device Repair';
            $amount = (int) round(((float) $booking->quotation_price) * 100); // Amount in cents

            if ($amount <= 0) {
                Log::warning('PaymentController@initiate - Invalid payment amount', [
                    'booking_id' => $booking->id,
                    'quotation_price' => $booking->quotation_price,
                ]);

                return response()->json([
                    'success' => false,
                    'error' => 'Payment amount is invalid. Please contact admin.',
                ], 422);
            }

            $successUrl = $this->absolutePaymentUrl(
                $request,
                route('customer.payment.callback', ['booking' => $booking->id], false) . '?session_id={CHECKOUT_SESSION_ID}'
            );
            $cancelUrl = $this->absolutePaymentUrl(
                $request,
                route('customer.booking.show', ['booking' => $booking->id], false)
            );

            $checkout_session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'myr',
                        'product_data' => [
                            'name' => 'Repair - ' . $deviceName,
                            'description' => $booking->inspection_report ?? 'Repair service',
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'customer_email' => Auth::user()->email,
                'metadata' => [
                    'booking_id' => $booking->id
                ]
            ]);

            // Save session ID to booking
            $booking->update([
                'payment_session_id' => $checkout_session->id,
                'payment_status' => 'Pending',
            ]);

            return response()->json([
                'success' => true,
                'paymentUrl' => $checkout_session->url,
            ]);

        } catch (\Throwable $e) {
            Log::error('PaymentController@initiate - Exception', [
                'booking_id' => $booking->id,
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'error' => config('app.debug')
                    ? 'Payment initialization failed: ' . $e->getMessage()
                    : 'Payment initialization failed. Please contact admin.',
            ], 500);
        }
    }

    /**
     * Handle Stripe callback after payment
     */
    public function callback(Request $request, Booking $booking)
    {
        Log::info('PaymentController@callback - Start Stripe Validation', [
            'booking_id' => $booking->id,
            'session_id' => $request->query('session_id')
        ]);
        
        try {
            $sessionId = $request->query('session_id');
            
            if (!$sessionId || $booking->payment_session_id !== $sessionId) {
                return redirect()->route('customer.booking.status')->with('error', 'Invalid payment session.');
            }

            $stripeSecret = $this->stripeSecret();

            if (!$stripeSecret) {
                Log::error('PaymentController@callback - Missing Stripe secret key', [
                    'booking_id' => $booking->id,
                ]);

                return redirect()
                    ->route('customer.booking.status')
                    ->with('error', 'Payment service is not configured. Please contact admin.');
            }

            Stripe::setApiKey($stripeSecret);
            $session = Session::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $booking->update([
                    'payment_status' => 'Paid',
                    'amount_paid' => $booking->quotation_price,
                    'payment_date' => now(),
                    'status' => 'Repair Completed',
                ]);

                BookingTimeline::create([
                    'booking_id' => $booking->id,
                    'title' => 'Payment Completed',
                    'description' => 'Payment received successfully via Stripe. Repair work is completed.',
                    'status' => 'Completed',
                ]);

                return redirect()
                    ->route('customer.review.create', $booking->id)
                    ->with('success', 'Payment successful! Please rate your repair service.');
            } else {
                return redirect()
                    ->route('customer.booking.status')
                    ->with('warning', 'Payment is not completed yet. Status: ' . $session->payment_status);
            }
        } catch (\Throwable $e) {
            Log::error('PaymentController@callback - Exception', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'booking_id' => $booking->id
            ]);
            
            return redirect()
                ->route('customer.booking.status')
                ->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }
}
