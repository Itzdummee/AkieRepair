<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = User::with('availabilities')->where('role', 'technician')->latest()->get();
        $services = \App\Models\Service::all();

        return view('admin.technicians', compact('technicians', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => ['nullable', 'string', 'regex:/^[0-9]{1,11}$/'],
            'password' => 'required|min:6',
            'specialties' => 'nullable|array',
            'specialties.*' => 'string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'phone_number.regex' => 'The phone number must be between 1 and 11 digits and contain only numbers.',
        ]);

        $lastUser = User::where('id', 'like', 'T%')->orderBy('id', 'desc')->first();
        $newNumber = $lastUser ? ((int) substr($lastUser->id, 1)) + 1 : 1;
        $newId = 'T' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/technicians', $fileName);
            $profileImagePath = 'storage/technicians/' . $fileName;
        }

        User::create([
            'id' => $newId,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => 'technician',
            'approval_status' => 'approved',
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'specialty' => $request->has('specialties') ? implode(', ', $request->specialties) : null,
            'profile_image' => $profileImagePath,
        ]);

        return back()->with('success', 'Technician added successfully.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'phone_number' => ['nullable', 'string', 'regex:/^[0-9]{1,11}$/'],
            'password' => 'nullable|min:6',
            'specialties' => 'nullable|array',
            'specialties.*' => 'string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'phone_number.regex' => 'The phone number must be between 1 and 11 digits and contain only numbers.',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'specialty' => $request->has('specialties') ? implode(', ', $request->specialties) : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            // delete old image if exists
            if ($user->profile_image) {
                $oldPath = str_replace('storage/', 'public/', $user->profile_image);
                \Illuminate\Support\Facades\Storage::delete($oldPath);
            }
            $file = $request->file('profile_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/technicians', $fileName);
            $data['profile_image'] = 'storage/technicians/' . $fileName;
        }

        $user->update($data);

        return back()->with('success', 'Technician updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->assignedBookings()->exists() || $user->availabilities()->exists()) {
            return back()->withErrors([
                'delete' => 'Cannot delete technician because this technician is still linked to bookings or availability records.',
            ]);
        }

        if ($user->profile_image) {
            $oldPath = str_replace('storage/', 'public/', $user->profile_image);
            \Illuminate\Support\Facades\Storage::delete($oldPath);
        }

        $user->delete();

        return back()->with('delete', 'Technician deleted successfully.');
    }
}