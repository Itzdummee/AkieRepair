<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CustomerApprovedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class CustomerApprovalController extends Controller
{
    public function pending()
    {
        $customers = User::where('role', 'customer')
            ->where('approval_status', 'pending')
            ->latest()
            ->get();

        return view('admin.pending-customers', compact('customers'));
    }

    public function index()
    {
        $customers = User::where('role', 'customer')
            ->with(['bookings'])
            ->latest()
            ->get();

        $totalCount = $customers->count();
        $approvedCount = $customers->where('approval_status', 'approved')->count();
        $pendingCount = $customers->where('approval_status', 'pending')->count();
        $rejectedCount = $customers->where('approval_status', 'rejected')->count();

        return view('admin.total-customers', compact(
            'customers',
            'totalCount',
            'approvedCount',
            'pendingCount',
            'rejectedCount'
        ));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => ['nullable', 'string', 'regex:/^[0-9]{1,11}$/'],
            'approval_status' => 'required|in:pending,approved,rejected',
        ], [
            'phone_number.regex' => 'The phone number must be between 1 and 11 digits and contain only numbers.',
        ]);

        $oldStatus = $user->approval_status;
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'approval_status' => $request->approval_status,
            'email_verified_at' => ($request->approval_status === 'approved' && !$user->email_verified_at) ? now() : $user->email_verified_at,
        ]);

        if ($request->approval_status === 'approved' && $oldStatus !== 'approved' && !empty($user->email)) {
            $this->sendApprovalMailAfterResponse($user);
        }

        return back()->with('success', 'Customer account updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->update([
            'is_active' => ! $user->is_active,
        ]);

        $message = $user->is_active
            ? 'Customer account activated successfully.'
            : 'Customer account deactivated successfully.';

        return back()->with('success', $message);
    }

    public function approve(User $user)
    {
        $user->update([
            'approval_status' => 'approved',
            'email_verified_at' => now(),
        ]);

        if (!empty($user->email)) {
            $this->sendApprovalMailAfterResponse($user);
        }

        return back()->with('success', 'Customer approved successfully.');
    }

    public function reject(User $user)
    {
        $user->update([
            'approval_status' => 'rejected',
        ]);

        return back()->with('delete', 'Customer rejected.');
    }

    private function sendApprovalMailAfterResponse(User $user): void
    {
        $userId = $user->id;
        $email = $user->email;

        dispatch(function () use ($userId, $email) {
            try {
                $freshUser = User::find($userId);

                if (! $freshUser || empty($email)) {
                    return;
                }

                Mail::to($email)->send(new CustomerApprovedMail($freshUser));
            } catch (Throwable $e) {
                Log::error('Customer approval email failed for ' . $email . ': ' . $e->getMessage());
            }
        })->afterResponse();
    }
}
