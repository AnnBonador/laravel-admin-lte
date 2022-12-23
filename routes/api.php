<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccountManagement;
use App\Http\Controllers\API\PatientManagement;
use App\Http\Controllers\API\DentistManagement;
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

Route::post('register', [AccountManagement::class, 'register']);
Route::post('login', [AccountManagement::class, 'login']);

Route::get('rating', [DentistManagement::class, 'ratings']);

Route::middleware('auth:api')->group( function () {
    //Route::resource('products', ProductController::class);
    Route::get('profile', [AccountManagement::class, 'UserProfile']);
    Route::get('patient_information', [PatientManagement::class, 'get_patient']);
    Route::get('dentist_information', [DentistManagement::class, 'dentist_information']);
});