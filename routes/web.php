<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\ChartController;
use App\Http\Controller\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserRoleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SPKController;
use App\Http\Controllers\SPKandOrderController;


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

Route::get('/', function() {
    return redirect()->route('login');
});

Route::post('/login', function () {
    return view('login');
})->name('login');

Auth::routes();

Route::group(['middleware' => 'auth', 'user-role:superadmin'], function () {
    Route::get('/settings', [UserController::class, 'setting'], function () {
        return view('Contents.settings');
    })->name('settings');
    Route::get('/settings-edit{id}', [UserController::class, 'settingEdit']);
    Route::PUT('/settings-edit{id}', [UserController::class, 'settingUpdate']);

    // Dashboard
    Route::get('/dashboard', [SPKandOrderController::class, 'index'], function() {
        return view('Contents.dashboard');
    })->name('dashboard');
    Route::post('/dashboard-tambah-spk-mesin', [SPKController::class, 'storeSPKMesin']);
    Route::post('/dashboard-tambah-spk-nota', [SPKController::class, 'storeSPKNota']);
    Route::get('/dashboard-edit-spk/{id}', [SPKController::class, 'edit']);
    Route::PUT('/dashboard-edit-spk/{id}', [SPKController::class, 'update']);
    Route::delete('/dashboard-delete-spk/{id}',[SPKController::class, 'delete']);

    // Menu Order
    Route::get('/dashboard-order', [OrderController::class, 'index']);
    Route::post('/dashboard-tambah-order', [OrderController::class, 'store']);
    Route::get('/dashboard-edit-order/{id}', [OrderController::class, 'edit']);
    Route::PUT('/dashboard-edit-order/{id}',[OrderController::class, 'update']);
    Route::delete('/dashboard-delete-order/{id}', [OrderController::class, 'delete']);

    // Menu Mesin
    Route::get('/dashboard-mesin', [MesinController::class, 'index']);
    Route::post('/dashboard-tambah-mesin', [MesinController::class, 'store']);
    Route::get('/dashboard-edit-mesin/{id}', [MesinController::class, 'edit']);
    Route::PUT('/dashboard-edit-mesin/{id}',[MesinController::class, 'update']);
    Route::delete('/dashboard-delete-mesin/{id}', [MesinController::class, 'delete']);

    // Menu User
    Route::get('/dashboard-user', [UserController::class, 'index']); 
    Route::post('/dashboard-tambah-user', [UserController::class, 'store']);
    Route::get('/dashboard-edit-user/{id}', [UserController::class, 'edit']);
    Route::PUT('/dashboard-edit-user/{id}',[UserController::class, 'update']);
    Route::delete('/dashboard-delete-user/{id}', [UserController::class, 'delete']);
});

Route::group(['middleware' => 'auth', 'user-role:admin'], function () {
    Route::get('/settings', [UserController::class, 'setting'], function () {
        return view('Contents.settings');
    })->name('settings');
    Route::get('/settings-edit/{id}', [UserController::class, 'settingEdit']);
    Route::PUT('/settings-edit/{id}', [UserController::class, 'settingUpdate']);

    // Dashboard
    Route::get('/dashboard', [SPKandOrderController::class, 'index'], function() {
        return view('Contents.dashboard');
    })->name('dashboard');
    Route::post('/dashboard-tambah-spk', [SPKController::class, 'store']);
    Route::get('/dashboard-edit-spk/{id}', [SPKController::class, 'edit']);
    Route::PUT('/dashboard-edit-spk/{id}', [SPKController::class, 'update']);
    Route::delete('/dashboard-delete-spk/{id}',[SPKController::class, 'delete']);

    // Menu Order
    Route::get('/dashboard-order', [OrderController::class, 'index']);
    Route::post('/dashboard-tambah-order', [OrderController::class, 'store']);
    Route::get('/dashboard-edit-order/{id}', [OrderController::class, 'edit']);
    Route::PUT('/dashboard-edit-order/{id}',[OrderController::class, 'update']);
    Route::delete('/dashboard-delete-order/{id}', [OrderController::class, 'delete']);

    // Menu Mesin
    Route::get('/dashboard-mesin', [MesinController::class, 'index']);
    Route::post('/dashboard-tambah-mesin', [MesinController::class, 'store']);
    Route::get('/dashboard-edit-mesin/{id}', [MesinController::class, 'edit']);
    Route::PUT('/dashboard-edit-mesin/{id}',[MesinController::class, 'update']);
    Route::delete('/dashboard-delete-mesin/{id}', [MesinController::class, 'delete']);
});