<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['device', 'repair'])
            ->where('customer_id', Auth::id())
            ->latest()
            ->get();

        $totalBookings = $bookings->count();

        $totalSpent = $bookings
            ->where('status', 'Repair Completed')
            ->sum('quotation_price');

        $pendingQuotations = $bookings
            ->where('status', 'Quotation Sent')
            ->count();

        $activeRepairs = $bookings
            ->whereIn('status', [
                'Visit Requested',
                'Technician Assigned',
                'Inspection Completed',
                'Quotation Sent',
                'Quotation Accepted',
                'Pickup Scheduled',
                'Repair In Progress',
            ])
            ->count();

        $completedRepairs = $bookings
            ->where('status', 'Repair Completed')
            ->count();

        $actionableBookings = $bookings
            ->filter(function (Booking $booking) {
                $needsQuotationApproval = $booking->status === 'Quotation Sent'
                    && $booking->quotation_status === 'Pending Customer Approval';

                $needsPayment = $booking->status === 'Repair Finished'
                    && $booking->payment_status !== 'Paid';

                return $needsQuotationApproval || $needsPayment;
            })
            ->values();

        return view('customer.dashboard', compact(
            'bookings',
            'actionableBookings',
            'totalBookings',
            'totalSpent',
            'pendingQuotations',
            'activeRepairs',
            'completedRepairs'
        ));
    }

    public function account()
    {
        $user = Auth::user();
        return view('customer.account', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone_number' => ['required', 'string', 'regex:/^[0-9]{1,11}$/'],
        ], [
            'phone_number.regex' => 'The phone number must be between 1 and 11 digits and contain only numbers.',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('customer.account')
            ->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'The new password confirmation does not match.',
            'password.min' => 'The new password must be at least 6 characters.',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password you entered is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('customer.account')
            ->with('success', 'Password updated successfully.');
    }
}
