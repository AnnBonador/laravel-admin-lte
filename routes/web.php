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
    });
    Route::controller(App\Http\Controllers\Admin\AppointmentController::class)->group(function () {
        Route::get('/appointment',  'index')->name('appointments.index');
        Route::get('/appointment/create', 'create')->name('appointments.create');
        // Route::post('/clinics', 'store')->name('clinics.store');
    });

    Route::controller(App\Http\Controllers\Admin\DoctorController::class)->group(function () {
        Route::get('/doctor', 'index')->name('doctors.index');
        Route::get('/doctor/create', 'create')->name('doctors.create');
        Route::post('/doctor', 'store')->name('doctors.store');
        Route::get('/doctor/{id}/edit', 'edit')->name('doctors.edit');
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
    });

    Route::controller(App\Http\Controllers\Admin\PatientController::class)->group(function () {
        Route::get('/patient', 'index')->name('patients.index');
        Route::get('/patient/create', 'create')->name('patients.create');
        Route::post('/patient', 'store')->name('patients.store');
        Route::get('/patient/{id}/edit', 'edit')->name('patients.edit');
        Route::put('/patient/{id}', 'update')->name('patients.update');
        Route::post('/patient/delete', 'destroy')->name('patients.delete');
    });

    Route::controller(App\Http\Controllers\Admin\ServicesController::class)->group(function () {
        Route::get('/service', 'index')->name('services.index');
        Route::get('/service/create', 'create')->name('services.create');
        Route::post('/service', 'store')->name('services.store');
        Route::get('/service/{id}/edit', 'edit')->name('services.edit');
        Route::put('/service/{id}', 'update')->name('services.update');
        Route::post('/service/delete', 'destroy')->name('services.delete');
    });
    Route::controller(App\Http\Controllers\Admin\ScheduleController::class)->group(function () {
        Route::get('/schedule', 'index')->name('schedules.index');
        Route::get('/schedule/create', 'create')->name('schedules.create');
        Route::post('/schedule/getDoctor', 'getDoctor')->name('getDoctor');
        Route::post('/schedule/getService', 'getService')->name('getService');
        Route::post('/schedule', 'store')->name('schedules.store');
        Route::get('/schedule/{id}/edit', 'edit')->name('schedules.edit');
        Route::get('/schedule/viewDoctor', 'getDoctor')->name('viewDoctor');
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
});


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:doctor'])->group(function () {

    Route::get('/doctor/home', [HomeController::class, 'managerHome'])->name('doctor.home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
