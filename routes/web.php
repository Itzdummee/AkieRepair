<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\RepairController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CustomerApprovalController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Technician\DashboardController as TechnicianDashboardController;
use App\Http\Controllers\Customer\ServiceController as CustomerServiceController;
use App\Http\Controllers\Customer\RepairController as CustomerRepairController;
use App\Http\Controllers\Customer\DeviceController as CustomerDeviceController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Customer\ReviewController as CustomerReviewController;

/*
|--------------------------------------------------------------------------
| PUBLIC CUSTOMER PAGES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('customer.home');

Route::get('/home', function () {
    return redirect()->route('customer.home');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::get('/register', [AuthController::class, 'showLogin'])
        ->name('register');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/account', [CustomerDashboardController::class, 'account'])->name('customer.account');
    Route::put('/account/profile', [CustomerDashboardController::class, 'updateProfile'])->name('customer.account.update');
    Route::put('/account/password', [CustomerDashboardController::class, 'changePassword'])->name('customer.account.password');
    Route::put('/account/status', [CustomerDashboardController::class, 'toggleStatus'])->name('customer.account.status');

    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])
        ->name('customer.dashboard');

    Route::get('/services', [CustomerServiceController::class, 'index'])
        ->name('customer.services');

    Route::get('/devices', [CustomerDeviceController::class, 'index'])
        ->name('customer.devices');

    Route::get('/services/{service}/repairs', [CustomerRepairController::class, 'index'])
        ->name('customer.repairs');

    Route::get('/repairs', [CustomerRepairController::class, 'all'])
        ->name('customer.repairs.all');

    Route::get('/customer/booking/create', [CustomerBookingController::class, 'create'])
        ->name('customer.booking.create');

    Route::post('/customer/booking/store', [CustomerBookingController::class, 'store'])
        ->name('customer.booking.store');

    Route::get('/customer/booking/status', [CustomerBookingController::class, 'status'])
        ->name('customer.booking.status');

    Route::get('/customer/booking/history', [CustomerBookingController::class, 'history'])
        ->name('customer.booking.history');

    Route::get('/customer/bookings/{booking}/review', [CustomerReviewController::class, 'create'])
        ->name('customer.review.create');

    Route::post('/customer/bookings/{booking}/review', [CustomerReviewController::class, 'store'])
        ->name('customer.review.store');

    Route::get('/customer/booking/{booking}', [CustomerBookingController::class, 'show'])
        ->name('customer.booking.show');

    Route::put('/customer/bookings/{booking}/accept', [CustomerBookingController::class, 'acceptQuotation'])
        ->name('customer.booking.accept');

    Route::put('/customer/bookings/{booking}/reject', [CustomerBookingController::class, 'rejectQuotation'])
        ->name('customer.booking.reject');

    Route::get('/customer/payment/{booking}', [CustomerPaymentController::class, 'show'])
        ->name('customer.payment.show');

    Route::post('/customer/payment/{booking}/initiate', [CustomerPaymentController::class, 'initiate'])
        ->name('customer.payment.initiate');

    Route::get('/customer/payment/{booking}/callback', [CustomerPaymentController::class, 'callback'])
        ->name('customer.payment.callback');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/bookings/pending', [BookingController::class, 'pending'])
        ->name('admin.bookings.pending');

    Route::get('/admin/bookings/history', [BookingController::class, 'history'])
        ->name('admin.bookings.history');

    Route::put('/admin/bookings/{booking}/assign', [BookingController::class, 'assignTechnician'])
        ->name('admin.bookings.assign');

    Route::get('/admin/devices', [DeviceController::class, 'index'])
        ->name('admin.devices');

    Route::post('/admin/devices', [DeviceController::class, 'store'])
        ->name('admin.devices.store');

    Route::put('/admin/devices/{device}', [DeviceController::class, 'update'])
        ->name('admin.devices.update');

    Route::delete('/admin/devices/{device}', [DeviceController::class, 'destroy'])
        ->name('admin.devices.destroy');

    Route::get('/admin/services', [RepairController::class, 'index'])
        ->name('admin.services');

    Route::post('/admin/services', [ServiceController::class, 'store'])
        ->name('admin.services.store');

    Route::put('/admin/services/{service}', [ServiceController::class, 'update'])
        ->name('admin.services.update');

    Route::delete('/admin/services/{service}', [ServiceController::class, 'destroy'])
        ->name('admin.services.destroy');

    Route::get('/admin/customers/pending', [CustomerApprovalController::class, 'pending'])
        ->name('admin.customers.pending');

    Route::get('/admin/customers', [CustomerApprovalController::class, 'index'])
        ->name('admin.customers.index');

    Route::put('/admin/customers/{user}', [CustomerApprovalController::class, 'update'])
        ->name('admin.customers.update');

    Route::delete('/admin/customers/{user}', [CustomerApprovalController::class, 'destroy'])
        ->name('admin.customers.destroy');

    Route::put('/admin/customers/{user}/approve', [CustomerApprovalController::class, 'approve'])
        ->name('admin.customers.approve');

    Route::put('/admin/customers/{user}/reject', [CustomerApprovalController::class, 'reject'])
        ->name('admin.customers.reject');

    Route::get('/admin/technicians', [TechnicianController::class, 'index'])->name('admin.technicians');
    Route::post('/admin/technicians', [TechnicianController::class, 'store'])->name('admin.technicians.store');
    Route::put('/admin/technicians/{user}', [TechnicianController::class, 'update'])->name('admin.technicians.update');
    Route::delete('/admin/technicians/{user}', [TechnicianController::class, 'destroy'])->name('admin.technicians.destroy');

    Route::get('/admin/repairs', [RepairController::class, 'index'])
        ->name('admin.repairs');

    Route::post('/admin/repairs', [RepairController::class, 'store'])
        ->name('admin.repairs.store');

    Route::put('/admin/repairs/{repair}', [RepairController::class, 'update'])
        ->name('admin.repairs.update');

    Route::delete('/admin/repairs/{repair}', [RepairController::class, 'destroy'])
        ->name('admin.repairs.destroy');

    Route::get('/admin/bookings/quotation', [BookingController::class, 'quotation'])
        ->name('admin.bookings.quotation');

    Route::put('/admin/bookings/{booking}/quotation', [BookingController::class, 'sendQuotation'])
        ->name('admin.bookings.sendQuotation');

    Route::get('/admin/bookings/{booking}/quotation-pdf',
        [BookingController::class, 'generateQuotationPdf'])
        ->name('admin.bookings.quotation.pdf');
});
    

/*
|--------------------------------------------------------------------------
| TECHNICIAN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technician/dashboard', [TechnicianDashboardController::class, 'index'])
        ->name('technician.dashboard');

    Route::get('/technician/assigned-jobs', [TechnicianDashboardController::class, 'assignedJobs'])
        ->name('technician.assigned.jobs');

    Route::get('/technician/assigned-jobs/{booking}', [TechnicianDashboardController::class, 'showJob'])
        ->name('technician.assigned.show');

    Route::get('/technician/availability', [TechnicianDashboardController::class, 'availability'])
        ->name('technician.availability');

    Route::get('/technician/bookings/{booking}/inspection', [TechnicianDashboardController::class, 'showInspection'])
        ->name('technician.bookings.inspection.show');

    Route::put('/technician/bookings/{booking}/inspection', [TechnicianDashboardController::class, 'updateInspection'])
        ->name('technician.bookings.inspection');

    Route::put('/technician/bookings/{booking}/progress', [TechnicianDashboardController::class, 'updateProgress'])
        ->name('technician.bookings.progress');

    Route::put('/technician/bookings/{booking}/finish', [TechnicianDashboardController::class, 'finishRepair'])
        ->name('technician.bookings.finish');

    Route::post('/technician/availability', [TechnicianDashboardController::class, 'storeAvailability'])
        ->name('technician.availability.store');

    Route::put('/technician/availability/{availability}', [TechnicianDashboardController::class, 'updateAvailability'])
        ->name('technician.availability.update');

    Route::delete('/technician/availability/{availability}', [TechnicianDashboardController::class, 'deleteAvailability'])
        ->name('technician.availability.delete');
});

/*
|--------------------------------------------------------------------------
| EMAIL TESTING ROUTE (for development only, remove in production)
|--------------------------------------------------------------------------
*/

// In routes/web.php (for testing only)

if (app()->environment('local')) {
    Route::middleware(['auth', 'role:admin'])->get('/test-email', function () {

        Mail::raw('Ini email test daripada Laravel + Brevo', function ($message) {
            $message->to('zamriyahya03@gmail.com')
                    ->subject('Test Email');
        });

        return 'Email berjaya dihantar!';
    });
}
