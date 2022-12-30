<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccountManagement;
use App\Http\Controllers\API\PatientManagement;
use App\Http\Controllers\API\DentistManagement;
use App\Http\Controllers\API\AppointmentManagement;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AccountManagement::class, 'register']); //universal for patient and doctor
Route::post('login', [AccountManagement::class, 'login']);

Route::get('rating', [DentistManagement::class, 'ratings']);

Route::middleware('auth:api')->group( function () {
    
    //Universal for Patient and  Doctor
    Route::post('update_profile', [AccountManagement::class, 'updateProfile']);
    Route::get('profile', [AccountManagement::class, 'UserProfile']);

    
    Route::get('patient_information', [PatientManagement::class, 'get_patient']);
    Route::get('dentist_information', [DentistManagement::class, 'dentist_information']);
    
    //dentist

    //patient
    Route::get('get_clinics', [AppointmentManagement::class, 'get_clinic']);
    Route::get('get_clinic_doctors/{id}', [AppointmentManagement::class, 'get_doctor']);
    Route::get('get_doctor_services/{id}', [AppointmentManagement::class, 'get_service']);
    Route::post('get_doctor_slots', [AppointmentManagement::class, 'get_doctor_slots']);
    Route::post('appointment', [AppointmentManagement::class, 'appointmentTrigger']);

    

    //appointment data
    Route::get('get_patient_appointment/{id}', [AppointmentManagement::class, 'get_patient_appointment']);

    Route::get('get_appointment/{id}', [AppointmentManagement::class, 'get_appointment']);

    //prescription
    Route::get('get_prescription/{id}', [PatientManagement::class, 'prescription_list']);
    Route::get('view_prescription/{id}', [PatientManagement::class, 'view_prescription']);
});