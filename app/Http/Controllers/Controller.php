<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




    // Route::controller(CustomController::class)->group(function () {
    //     Route::get('login', 'login')->name('login');
    //     Route::post('validate_login', 'validate_login')->name('sample.validate_login');
    //     Route::get('register', 'register')->name('register');
    //     Route::post('validate_register', 'validate_register')->name('sample.validate_register');
    //     Route::get('logout', 'logout')->name('logout');
    //     Route::get('forget-password', 'forget');
    //     Route::post('forget-password', 'forgetPassword')->name('forgetPassword');
    //     Route::get('reset-password', 'reset');
    //     Route::post('reset-password', 'resetPassword')->name('resetPassword');
    //     Route::get('change-password', 'changePassword')->name('changePassword');
    //     Route::post('change-password', 'updatePassword')->name('updatePassword');
    //     Route::get('dashboard', 'dashboard')->name('dashboard');
    // });

    // Route::controller(ProfileController::class)->group(function () {
    //     Route::get('profile', 'index')->name('profile');
    //     Route::post('profile/edit_validation', 'edit_validation')->name('profile.edit_validation');
    // });

    // Route::controller(EmployeeController::class)->group(function () {
    //     Route::get('employee', 'index')->name('employee');
    //     Route::get('employee/fetchall', 'fetch_all')->name('employee.fetchall');
    //     Route::get('employee/edit/{id}', 'edit')->name('edit');
    //     Route::post('employee/edit_validation', 'edit_validation')->name('employee.edit_validation');
    //     Route::get('employee/delete/{id}', 'delete')->name('delete');
    // });

    // Route::controller(CountryController::class)->prefix('country')->group(function () {
    //     Route::get('/', 'index');
    //     Route::get('create', 'createPage');
    //     Route::post('save', 'create');
    //     Route::get('edit/{id}', 'edit');
    //     Route::put('update/{id}', 'update');
    //     Route::delete('delete/{id}', 'destroy');
    // });

    // Route::controller(StateController::class)->prefix('state')->group(function () {
    //     Route::get('/', 'index');
    //     Route::get('create', 'createPage');
    //     Route::post('save', 'create');
    //     Route::get('edit/{id}', 'edit');
    //     Route::put('update/{id}', 'update');
    //     Route::delete('delete/{id}', 'destroy');
    // });

    // Route::controller(CityController::class)->prefix('city')->group(function () {
    //     Route::get('/', 'index');
    //     Route::get('create', 'createPage');
    //     Route::post('save', 'create');
    //     Route::get('edit/{id}', 'edit');
    //     Route::put('update/{id}', 'update');
    //     Route::delete('delete/{id}', 'destroy');
    // });
}
