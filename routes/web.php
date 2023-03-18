<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/clients', [App\Http\Controllers\ClientsController::class, 'index'])->name('clients')->middleware('auth');
Route::get('/reports', [App\Http\Controllers\ReportsController::class, 'index'])->name('reports')->middleware('auth');
