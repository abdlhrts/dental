<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/home', function () {
    return redirect('/dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Administrator
    Route::get('/setting', [App\Http\Controllers\WebsiteSettingController::class, 'index'])->name('website-setting.index');

    Route::get('/master-data', function () {
        return view('pages.master-data.index');
    })->name('master-data.index');

    Route::view('/patient-registration', 'pages.patient-registration.index')->name('patient-registration.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::view('role-permission', 'pages.role-permission.index')->name('role-permission.index');
    Route::view('role-permission/create', 'pages.role-permission.create')->name('role-permission.create');

    Route::view('/medical-record', 'pages.medical-record.index')->name('medical-record.index');
    Route::resource('/medical-record', App\Http\Controllers\MedicalRecordController::class)->except(['index']);

    Route::resource('patient', App\Http\Controllers\PatientController::class);
});

require __DIR__ . '/auth.php';
