<?php

use App\Models\User;
use App\Mail\ForgetPwdMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CustomController;
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
    // return view('welcome');
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
    Route::get('dashboard', 'dashboard')->name('dashboard');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('profile', 'index')->name('profile');
    Route::post('profile/edit_validation', 'edit_validation')->name('profile.edit_validation');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('employee', 'index')->name('employee');
    Route::get('employee/fetchall', 'fetch_all')->name('employee.fetchall');
    Route::get('employee/add', 'add')->name('employee.add');
    Route::post('employee/add_validation', 'add_validation')->name('employee.add_validation');
    Route::get('employee/edit/{id}', 'edit')->name('edit');
    Route::post('employee/edit_validation', 'edit_validation')->name('employee.edit_validation');
    Route::get('employee/delete/{id}', 'delete')->name('delete');
});

Route::controller(CountryController::class)->prefix('country')->group(function () {
    Route::get('/', 'index');
    Route::get('create', 'createPage');
    Route::post('save', 'create');
    Route::get('edit/{id}', 'edit');
    Route::put('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});

Route::controller(StateController::class)->prefix('state')->group(function () {
    Route::get('/', 'index');
    Route::get('create', 'createPage');
    Route::post('save', 'create');
    Route::get('edit/{id}', 'edit');
    Route::put('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});

Route::controller(CityController::class)->prefix('city')->group(function () {
    Route::get('/', 'index');
    Route::get('create', 'createPage');
    Route::post('save', 'create');
    Route::get('edit/{id}', 'edit');
    Route::put('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
