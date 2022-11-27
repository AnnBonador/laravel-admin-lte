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


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'redirectUser'])->name('home');

Route::controller(App\Http\Controllers\ForgotPasswordController::class)->group(function () {
    Route::get('forget-password',  'showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password',  'submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}',  'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password',  'submitResetPasswordForm')->name('reset.password.post');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('admin')->middleware(['auth', 'verified', 'user-access:admin'])->group(function () {

    Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
        Route::get('/dashboard', 'adminHome')->name('admin.dashboard');
        Route::get('/dashboard/{id}', 'adminShow')->name('admin.dashboard.show');
    });

    Route::controller(App\Http\Controllers\Admin\ClinicsController::class)->group(function () {
        Route::get('/clinics',  'index')->name('clinics.index');
        Route::get('/clinics/create', 'create')->name('clinics.create');
        Route::post('/clinics', 'store')->name('clinics.store');
        Route::get('/clinics/{id}/edit', 'edit')->name('clinics.edit');
        Route::put('/clinics/{id}', 'update')->name('clinics.update');
        Route::post('/clinics/delete', 'destroy')->name('clinics.delete');
        Route::get('/clinics-send/{id}', 'resendCredentials')->name('clinicCredentials');
        Route::get('/clinic-status/update', 'updateStatus')->name('clinics.status.update');
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
        Route::get('/appointment/{id}/show', 'getAppointmentDetails')->name('getAppointmentDetails');
        Route::post('/amount/getAmount', 'getAmount')->name('getAmount');
    });

    Route::controller(App\Http\Controllers\Admin\DoctorController::class)->group(function () {
        Route::get('/doctor', 'index')->name('doctors.index');
        Route::get('/doctor/create', 'create')->name('doctors.create');
        Route::post('/doctor', 'store')->name('doctors.store');
        Route::get('/doctor/{id}/edit', 'edit')->name('doctors.edit');
        Route::get('/doctor-send/{id}', 'resendCredentials')->name('doctorCredentials');
        Route::put('/doctor/{id}', 'update')->name('doctors.update');
        Route::post('/doctor/delete', 'destroy')->name('doctors.delete');
        Route::get('/doctor-status/update', 'updateStatus')->name('doctors.status.update');
    });

    Route::controller(App\Http\Controllers\Admin\ReceptionistController::class)->group(function () {
        Route::get('/receptionist', 'index')->name('receptionist.index');
        Route::get('/receptionist/create', 'create')->name('receptionist.create');
        Route::post('/receptionist', 'store')->name('receptionist.store');
        Route::get('/receptionist/{id}/edit', 'edit')->name('receptionist.edit');
        Route::put('/receptionist/{id}', 'update')->name('receptionist.update');
        Route::post('/receptionist/delete', 'destroy')->name('receptionist.delete');
        Route::get('/receptionist-send/{id}', 'resendCredentials')->name('receptionistCredentials');
        Route::get('/receptionist-status/update', 'updateStatus')->name('receptionist.status.update');
    });

    Route::controller(App\Http\Controllers\Admin\PatientController::class)->group(function () {
        Route::get('/patient', 'index')->name('patients.index');
        Route::get('/patient/create', 'create')->name('patients.create');
        Route::post('/patient', 'store')->name('patients.store');
        Route::get('/patient/{id}/edit', 'edit')->name('patients.edit');
        Route::put('/patient/{id}', 'update')->name('patients.update');
        Route::post('/patient/delete', 'destroy')->name('patients.delete');
        Route::get('/patient-send/{id}', 'resendCredentials')->name('patientCredentials');
        Route::get('/patient-status/update', 'updateStatus')->name('patients.status.update');
    });

    Route::controller(App\Http\Controllers\Admin\ServicesController::class)->group(function () {
        Route::get('/service', 'index')->name('services.index');
        Route::get('/service/create', 'create')->name('services.create');
        Route::post('/service', 'store')->name('services.store');
        Route::get('/service/{id}/edit', 'edit')->name('services.edit');
        Route::put('/service/{id}', 'update')->name('services.update');
        Route::post('/service/delete', 'destroy')->name('services.delete');
        Route::get('/services-status/update', 'updateStatus')->name('services.status.update');
    });
    Route::controller(App\Http\Controllers\Admin\PrescriptionController::class)->group(function () {
        Route::get('/prescription', 'index')->name('prescription.index');
        Route::get('/prescription/create', 'create')->name('prescription.create');
        Route::post('/prescription', 'store')->name('prescription.store');
        Route::get('/prescription/{id}/edit', 'edit')->name('prescription.edit');
        Route::put('/prescription/{id}', 'update')->name('prescription.update');
        Route::post('/prescription/delete', 'destroy')->name('prescription.delete');
        Route::get('/print-prescription/{id}', 'print')->name('print-prescription');
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
    Route::controller(App\Http\Controllers\Admin\SpecializationController::class)->group(function () {
        Route::get('/specialization', 'index')->name('specialization.index');
        Route::get('/specialization/create', 'create')->name('specialization.create');
        Route::post('/specialization', 'store')->name('specialization.store');
        Route::get('/specialization/{id}/edit', 'edit')->name('specialization.edit');
        Route::put('/specialization/{id}', 'update')->name('specialization.update');
        Route::post('/specialization/delete', 'destroy')->name('specialization.delete');
    });

    Route::controller(App\Http\Controllers\Admin\ChangePasswordController::class)->group(function () {
        Route::get('change-password', 'index')->name('change.password.index');
        Route::post('change-password', 'store')->name('change.password');
    });
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users', 'store')->name('users.store');
        Route::get('/users/{id}/edit', 'edit')->name('users.edit');
        Route::put('/users/{id}', 'update')->name('users.update');
        Route::post('/users/delete', 'destroy')->name('users.delete');
    });
    Route::controller(App\Http\Controllers\Admin\RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('roles.index');
        Route::get('/roles/create', 'create')->name('roles.create');
        Route::post('/roles', 'store')->name('roles.store');
        Route::get('/roles/{id}/edit', 'edit')->name('roles.edit');
        Route::put('/roles/{id}', 'update')->name('roles.update');
        Route::post('/roles/delete', 'destroy')->name('roles.delete');
    });

    Route::controller(App\Http\Controllers\Admin\ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('change.profile');
        Route::put('/profile-clinic/{id}', 'updateClinicAdmin')->name('update.clinic.profile');
        Route::put('/profile-doctor/{id}', 'updateDoctor')->name('update.doctor.profile');
        Route::put('/profile-admni/{id}', 'updateAdmin')->name('update.admin.profile');
    });
    Route::controller(App\Http\Controllers\Admin\ReviewsController::class)->group(function () {
        Route::get('/reviews', 'index')->name('reviews');
    });
    Route::controller(App\Http\Controllers\Admin\MedicalReportController::class)->group(function () {
        Route::get('/reports', 'index')->name('reports');
    });
});

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('user')->middleware(['auth', 'verified', 'user-access:user'])->group(function () {

    Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('user.dashboard');
        Route::get('/dashboard/{id}', 'userShow')->name('user.dashboard.show');
    });
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
        Route::get('/appointment/{id}/show', 'usergetAppointmentDetails')->name('usergetAppointmentDetails');
    });
    Route::controller(App\Http\Controllers\User\FetchController::class)->group(function () {
        Route::post('/getDoctor', 'getDoctor')->name('user.getDoctor');
        Route::post('/getService', 'getService')->name('user.getService');
        Route::get('/viewDoctor', 'getDoctor')->name('user.viewDoctor');
        Route::post('/getSlots', 'getSlots')->name('user.getSlots');
    });
    Route::controller(App\Http\Controllers\User\DoctorRatingsController::class)->group(function () {
        Route::post('/doctor/rating', 'store')->name('user.review.store');
    });
    Route::controller(App\Http\Controllers\User\ClinicController::class)->group(function () {
        Route::get('/clinic', 'index')->name('user.clinic.index');
        Route::put('/clinic', 'update')->name('user.clinic.update');
    });
    Route::controller(App\Http\Controllers\User\TreatedController::class)->group(function () {
        Route::get('/treated', 'index')->name('user.treated.index');
        Route::get('/treated/{id}', 'show')->name('user.treated.show');
    });
    Route::controller(App\Http\Controllers\User\PrescriptionController::class)->group(function () {
        Route::get('/prescription', 'index')->name('user.prescription.index');
    });

    Route::controller(App\Http\Controllers\User\ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('user.profile');
        Route::put('/profile-update/{id}', 'update')->name('profileuser.update');
    });
    Route::controller(App\Http\Controllers\User\ChangePasswordController::class)->group(function () {
        Route::get('/change-password', 'index')->name('user.change-password');
        Route::post('/change-password', 'store')->name('user.store-password');
    });
});

Route::controller(App\Http\Controllers\Front\FrontEndController::class)->group(function () {
    Route::get('/', 'homepage')->name('home.page');
    Route::get('/dentist', 'dentist')->name('dentist.page');
    Route::get('/clinic-profile/{id}', 'clinicProfile')->name('clinics.profile');
    Route::get('/doctor-profile/{id}', 'doctorProfile')->name('doctor.profile');
});
