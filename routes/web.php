<?php

use App\Models\User;
use App\Mail\ForgetPwdMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;

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
    // return view('auth.login');
});

Route::controller(CustomController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('validate_login', 'validate_login')->name('sample.validate_login');
    Route::get('register', 'register')->name('register');
    Route::post('validate_register', 'validate_register')->name('sample.validate_register');
    Route::get('logout', 'logout')->name('logout');
    Route::get('forget-password', 'forget');
    Route::post('forget-password', 'forgetPassword')->name('forgetPassword');
    Route::get('reset-password', 'reset');
    Route::post('reset-password', 'resetPassword')->name('resetPassword');
    Route::get('change-password', 'changePassword')->name('changePassword');
    Route::post('change-password', 'updatePassword')->name('updatePassword');
    // Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::get('dashboard', 'index');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('profile', 'index')->name('profile');
    Route::post('profile/edit_validation', 'edit_validation')->name('profile.edit_validation');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('employee', 'index')->name('employee');
    Route::get('employee/fetchall', 'fetch_all')->name('employee.fetchall');
    Route::get('employee/edit/{id}', 'edit')->name('edit');
    Route::post('employee/edit_validation', 'edit_validation')->name('employee.edit_validation');
    Route::get('employee/delete/{id}', 'delete')->name('delete');
    Route::get('employee/records', 'records')->name('employee.records');
    // Route::get('employee/destroy/{id}', 'destroy')->name('destroy');
});

Route::resource('country', CountryController::class);

Route::resource('state', StateController::class);

Route::resource('city', CityController::class);

// Route::controller(CityController::class)->prefix('city')->group(function () {
//     Route::get('/', 'index');
//     Route::get('store', 'store');
//     Route::get('create', 'save');
//     Route::post('save', 'create');
//     Route::get('edit/{id}', 'edit');
//     Route::put('update/{id}', 'update');
//     Route::get('delete/{id}', 'destroy');
// });


// Route::get('ajax-crud-datatable', [CompanyController::class, 'index']);
// Route::post('store-company', [CompanyController::class, 'store']);
// Route::post('edit-company', [CompanyController::class, 'edit']);
// Route::post('delete-company', [CompanyController::class, 'destroy']);
