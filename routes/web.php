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

// Route::get('/dashboard', function () {
//     return view('contents.dashboard');
// })->name('app');

Route::get('/', function() {
    return redirect()->route('login');
});

Route::post('/login', function () {
    return view('login');
})->name('login');

// Route::get('/home', function() {
//     return view('home');
// })->name('home');

Route::get('/dashboard', [SPKController::class, 'index'], function () {
    return view('Contents.dashboard.index');
})->name('dashboard');
Route::post('/dashboard-tambah-spk', [SPKController::class, 'store']);
Route::get('/dashboard-edit-spk/{id}', [SPKController::class, 'edit']);
Route::put('/dashboard-edit-spk/{id}', [SPKController::class, 'update']);
Route::delete('/dashboard-delete-spk/{id}',[SPKController::class, 'delete']);

// Route::get('/dashboard', [ChartController::class, 'barChart'])->name('dashboard'); //, function () {
    // return view('Contents.dashboard');
// })->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', [SPKController::class, 'index'])->name('dashboard');
// });

// Route::get('/bar-chart', );

// Route::controller(UserController::class)->prefix('user')->group(function () {
//     Route::get('', 'index')->name('user');
//     Route::get('create', 'create')->name('user.create');
//     Route::post('store', 'store')->name('user.store');
//     Route::get('show/{id}', 'show')->name('user.show');
//     Route::get('edit/{id}', 'edit')->name('user.edit');
//     Route::put('edit/{id}', 'update')->name('user.update');
//     Route::delete('destroy/{id}', 'destroy')->name('user.destroy');
// });

// Route::get('/dashboard-user', [UserController::class, 'index']); 
// Route::post('/dashboard-tambah-user', [UserController::class, 'store']);
// Route::get('/dashboard-edit-user/{id}', [UserController::class, 'edit']);
// Route::put('/dashboard-edit-user/{id}',[UserController::class, 'update']);
// Route::delete('/dashboard-delete-user/{id}', [UserController::class, 'delete']);

Route::get('/dashboard-mesin', [MesinController::class, 'index']);
// Route::post('/dashboard-tambah-mesin', [MesinController::class, 'store']);
// Route::get('/dashboard-edit-mesin/{id}', [MesinController::class, 'edit']);
// Route::put('/dashboard-edit-mesin/{id}',[MesinController::class, 'update']);
// Route::delete('/dashboard-delete-mesin/{id}', [MesinController::class, 'delete']);

Route::get('/dashboard-order', [OrderController::class, 'index']);
// Route::post('/dashboard-tambah-order', [OrderController::class, 'store']);
// Route::get('/dashboard-edit-order/{id}', [OrderController::class, 'edit']);
// Route::put('/dashboard-edit-order/{id}',[OrderController::class, 'update']);
// Route::delete('/dashboard-delete-order/{id}', [OrderController::class, 'delete']);

Auth::routes();

Route::group(['middleware' => 'auth', 'user-role:superadmin'], function () {
    // Menu Order
    Route::post('/dashboard-tambah-order', [OrderController::class, 'store']);
    Route::get('/dashboard-edit-order/{id}', [OrderController::class, 'edit']);
    Route::put('/dashboard-edit-order/{id}',[OrderController::class, 'update']);
    Route::delete('/dashboard-delete-order/{id}', [OrderController::class, 'delete']);

    // Menu Mesin
    Route::post('/dashboard-tambah-mesin', [MesinController::class, 'store']);
    Route::get('/dashboard-edit-mesin/{id}', [MesinController::class, 'edit']);
    Route::put('/dashboard-edit-mesin/{id}',[MesinController::class, 'update']);
    Route::delete('/dashboard-delete-mesin/{id}', [MesinController::class, 'delete']);

    // Menu User
    Route::get('/dashboard-user', [UserController::class, 'index']); 
    Route::post('/dashboard-tambah-user', [UserController::class, 'store']);
    Route::get('/dashboard-edit-user/{id}', [UserController::class, 'edit']);
    Route::put('/dashboard-edit-user/{id}',[UserController::class, 'update']);
    Route::delete('/dashboard-delete-user/{id}', [UserController::class, 'delete']);
});

Route::group(['middleware' => 'auth', 'user-role:admin'], function () {

    // Menu Order
    Route::post('/dashboard-tambah-order', [OrderController::class, 'store']);
    Route::get('/dashboard-edit-order/{id}', [OrderController::class, 'edit']);
    Route::put('/dashboard-edit-order/{id}',[OrderController::class, 'update']);
    Route::delete('/dashboard-delete-order/{id}', [OrderController::class, 'delete']);

    // Menu Mesin
    Route::post('/dashboard-tambah-mesin', [MesinController::class, 'store']);
    Route::get('/dashboard-edit-mesin/{id}', [MesinController::class, 'edit']);
    Route::put('/dashboard-edit-mesin/{id}',[MesinController::class, 'update']);
    Route::delete('/dashboard-delete-mesin/{id}', [MesinController::class, 'delete']);
});

// Route::get('logout', [LoginController::class, 'logout'])->name('logout');