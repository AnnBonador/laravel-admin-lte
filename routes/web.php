<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('post-login', 'postLogin')->name('login.post');
});
Route::controller(App\Http\Controllers\ForgotPasswordController::class)->group(function () {
    Route::get('forget-password',  'showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password',  'submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}',  'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password',  'submitResetPasswordForm')->name('reset.password.post');
});

// Route::get('reset-password/{token}', [App\Http\Controllers\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('admin')->middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.dashboard');

    Route::controller(App\Http\Controllers\Admin\ClinicsController::class)->group(function () {
        Route::get('/clinics',  'index')->name('clinics.index');
        Route::get('/clinics/create', 'create')->name('clinics.create');
        Route::post('/clinics', 'store')->name('clinics.store');
        Route::get('/clinics/{id}/edit', 'edit')->name('clinics.edit');
        Route::put('/clinics/{id}', 'update')->name('clinics.update');
        Route::post('/clinics/delete', 'destroy')->name('clinics.delete');
        Route::get('/clinics-send/{id}', 'resendCredentials')->name('clinicCredentials');
    });

    Route::controller(App\Http\Controllers\Admin\RatingsController::class)->group(function () {
        Route::get('/doctor/{id}/ratings',  'ratings')->name('ratings.index');
    });
    Route::controller(App\Http\Controllers\Admin\SettingsController::class)->group(function () {
        Route::get('/settings',  'index')->name('settings.index');
        Route::put('/settings/{id}', 'update')->name('settings.update');
    });
    Route::controller(App\Http\Controllers\Admin\AppointmentController::class)->group(function () {
        Route::get('/appointment',  'index')->name('appointments.index');
        Route::get('/appointment/create', 'create')->name('appointments.create');
        Route::post('/appointment', 'store')->name('appointments.store');
        Route::get('/appointment/{id}/edit', 'edit')->name('appointments.edit');
        Route::put('/appointment/{id}', 'update')->name('appointments.update');
        Route::post('/appointment/delete', 'destroy')->name('appointments.delete');
        Route::get('/appointment/all', 'all')->name('appointments.all');
        Route::get('/appointment/past', 'past')->name('appointments.past');
    });

    Route::controller(App\Http\Controllers\Admin\DoctorController::class)->group(function () {
        Route::get('/doctor', 'index')->name('doctors.index');
        Route::get('/doctor/create', 'create')->name('doctors.create');
        Route::post('/doctor', 'store')->name('doctors.store');
        Route::get('/doctor/{id}/edit', 'edit')->name('doctors.edit');
        Route::get('/doctor-send/{id}', 'resendCredentials')->name('doctorCredentials');
        Route::put('/doctor/{id}', 'update')->name('doctors.update');
        Route::post('/doctor/delete', 'destroy')->name('doctors.delete');
    });

    Route::controller(App\Http\Controllers\Admin\ReceptionistController::class)->group(function () {
        Route::get('/receptionist', 'index')->name('receptionist.index');
        Route::get('/receptionist/create', 'create')->name('receptionist.create');
        Route::post('/receptionist', 'store')->name('receptionist.store');
        Route::get('/receptionist/{id}/edit', 'edit')->name('receptionist.edit');
        Route::put('/receptionist/{id}', 'update')->name('receptionist.update');
        Route::post('/receptionist/delete', 'destroy')->name('receptionist.delete');
        Route::get('/receptionist-send/{id}', 'resendCredentials')->name('receptionistCredentials');
    });

    Route::controller(App\Http\Controllers\Admin\PatientController::class)->group(function () {
        Route::get('/patient', 'index')->name('patients.index');
        Route::get('/patient/create', 'create')->name('patients.create');
        Route::post('/patient', 'store')->name('patients.store');
        Route::get('/patient/{id}/edit', 'edit')->name('patients.edit');
        Route::put('/patient/{id}', 'update')->name('patients.update');
        Route::post('/patient/delete', 'destroy')->name('patients.delete');
        Route::get('/patient-send/{id}', 'resendCredentials')->name('patientCredentials');
    });

    Route::controller(App\Http\Controllers\Admin\ServicesController::class)->group(function () {
        Route::get('/service', 'index')->name('services.index');
        Route::get('/service/create', 'create')->name('services.create');
        Route::post('/service', 'store')->name('services.store');
        Route::get('/service/{id}/edit', 'edit')->name('services.edit');
        Route::put('/service/{id}', 'update')->name('services.update');
        Route::post('/service/delete', 'destroy')->name('services.delete');
    });
    Route::controller(App\Http\Controllers\Admin\PrescriptionController::class)->group(function () {
        Route::get('/prescription', 'index')->name('prescription.index');
        Route::get('/prescription/create', 'create')->name('prescription.create');
        Route::post('/prescription', 'store')->name('prescription.store');
        Route::get('/prescription/{id}/edit', 'edit')->name('prescription.edit');
        Route::put('/prescription/{id}', 'update')->name('prescription.update');
        Route::post('/prescription/delete', 'destroy')->name('prescription.delete');
    });
    Route::controller(App\Http\Controllers\Admin\TreatedController::class)->group(function () {
        Route::get('/treated', 'index')->name('treated.index');
        Route::get('/treated/create', 'create')->name('treated.create');
        Route::post('/treated', 'store')->name('treated.store');
        Route::get('/treated/{id}/edit', 'edit')->name('treated.edit');
        Route::put('/treated/{id}', 'update')->name('treated.update');
        Route::post('/treated/delete', 'destroy')->name('treated.delete');
    });
    Route::controller(App\Http\Controllers\Admin\ScheduleController::class)->group(function () {
        Route::get('/schedule', 'index')->name('schedules.index');
        Route::get('/schedule/create', 'create')->name('schedules.create');
        Route::post('/schedule/getDoctor', 'getDoctor')->name('getDoctor');
        Route::post('/schedule/getService', 'getService')->name('getService');
        Route::post('/schedule', 'store')->name('schedules.store');
        Route::get('/schedule/{id}/edit', 'edit')->name('schedules.edit');
        Route::get('/schedule/viewDoctor', 'getDoctor')->name('viewDoctor');
        Route::post('/schedule/getSlots', 'getSlots')->name('getSlots');
        Route::put('/schedule/{id}', 'update')->name('schedules.update');
        Route::post('/schedule/delete', 'destroy')->name('schedules.delete');
    });
});

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('user')->middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard');
    Route::controller(App\Http\Controllers\User\AppointmentsController::class)->group(function () {
        Route::get('/appointment',  'index')->name('user.appointments.index');
        Route::get('/appointment/create', 'create')->name('user.appointments.create');
        Route::post('/appointment', 'store')->name('user.appointments.store');
        Route::get('/appointment/{id}/edit', 'edit')->name('user.appointments.edit');
        Route::put('/appointment/{id}', 'update')->name('user.appointments.update');
        Route::post('/appointment/delete', 'destroy')->name('user.appointments.delete');
        Route::get('/appointment/cancel-payment', 'paymentCancel')->name('cancel.payment');
        Route::get('/appointment/payment-success', 'paymentSuccess')->name('success.payment');
        Route::get('appointment/rating/{id}', 'rateDoctor')->name('user.ratings');
    });
    Route::controller(App\Http\Controllers\User\FetchController::class)->group(function () {
        Route::post('/getDoctor', 'getDoctor')->name('user.getDoctor');
        Route::post('/getService', 'getService')->name('user.getService');
        Route::get('/viewDoctor', 'getDoctor')->name('user.viewDoctor');
        Route::post('/getSlots', 'getSlots')->name('user.getSlots');
    });
    Route::controller(App\Http\Controllers\User\CalendarController::class)->group(function () {
        Route::get('/calendar', 'index')->name('user.calendar.index');
        Route::get('/calendar/{id}', 'show')->name('user.calendar.show');
    });
    Route::controller(App\Http\Controllers\User\DoctorRatingsController::class)->group(function () {
        Route::post('/doctor/rating', 'store')->name('user.review.store');
    });
    Route::controller(App\Http\Controllers\User\ClinicController::class)->group(function () {
        Route::get('/clinic', 'index')->name('user.clinic.index');
        Route::put('/clinic', 'update')->name('user.clinic.update');
    });
});



Route::prefix('doctor')->middleware(['auth', 'user-access:doctor'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'doctorHome'])->name('doctor.dashboard');
});

Route::prefix('receptionist')->middleware(['auth', 'user-access:receptionist'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'receptionistHome'])->name('receptionist.dashboard');
});
