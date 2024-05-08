<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\ChartController;
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
    return view('Contents.login');
});
Route::get('/login', function () {
    return view('Contents.login');
});

Route::get('/dashboard', [ChartController::class, 'barChart']); //, function () {
    // return view('Contents.dashboard');
// })->name('dashboard');

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


Route::get('/dashboard-user', [UserController::class, 'index']); 
Route::post('/dashboard-tambah-user', [UserController::class, 'store']);
Route::get('/dashboard-edit-user/{id}', [UserController::class, 'edit']);
Route::put('/dashboard-edit-user/{id}',[UserController::class, 'update']);
Route::delete('/dashboard-delete-user/{id}', [UserController::class, 'delete']);

Route::get('/dashboard-mesin', [MesinController::class, 'index']);
Route::post('/dashboard-tambah-mesin', [MesinController::class, 'store']);
Route::get('/dashboard-edit-mesin/{id}', [MesinController::class, 'edit']);
Route::put('/dashboard-edit-mesin/{id}',[MesinController::class, 'update']);
Route::delete('/dashboard-delete-mesin/{id}', [MesinController::class, 'delete']);

Route::get('/dashboard-order', [OrderController::class, 'index']);
Route::post('/dashboard-tambah-order', [OrderController::class, 'store']);
Route::get('/dashboard-edit-order/{id}', [OrderController::class, 'edit']);
Route::put('/dashboard-edit-order/{id}',[OrderController::class, 'update']);
Route::delete('/dashboard-delete-order/{id}', [OrderController::class, 'delete']);
