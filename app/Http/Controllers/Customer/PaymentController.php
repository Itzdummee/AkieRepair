<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
            Stripe::setApiKey(config('services.stripe.secret'));
            
            $deviceName = $booking->device->device_name ?? 'Device Repair';
            $amount = (int)($booking->quotation_price * 100); // Amount in cents

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
                'success_url' => route('customer.payment.callback', ['booking' => $booking->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('customer.booking.show', ['booking' => $booking->id]),
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

        } catch (\Exception $e) {
            Log::error('PaymentController@initiate - Exception', [
                'message' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'error' => 'Payment initialization failed: ' . $e->getMessage()
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

            Stripe::setApiKey(config('services.stripe.secret'));
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
                    ->route('customer.booking.history')
                    ->with('success', 'Payment successful! Your repair service is now complete.');
            } else {
                return redirect()
                    ->route('customer.booking.status')
                    ->with('warning', 'Payment is not completed yet. Status: ' . $session->payment_status);
            }
        } catch (\Exception $e) {
            Log::error('PaymentController@callback - Exception', [
                'message' => $e->getMessage(),
                'booking_id' => $booking->id
            ]);
            
            return redirect()
                ->route('customer.booking.status')
                ->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }
}