<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.repairs');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string|max:255',
        ]);

        Service::create([
            'service_type' => $request->service_type,
            'admin_id' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.services')
            ->with('success', 'Service added successfully.');
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_type' => 'required|string|max:255',
        ]);

        $service->update([
            'service_type' => $request->service_type,
            'admin_id' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.services')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->update([
            'is_active' => ! $service->is_active,
        ]);

        if (! $service->is_active) {
            $service->repairs()->update(['is_active' => false]);
        }

        $message = $service->is_active
            ? 'Service category activated successfully.'
            : 'Service category deactivated successfully. Related repair pricing records were also deactivated.';

        return redirect()
            ->route('admin.services')
            ->with('delete', $message);
    }
}
