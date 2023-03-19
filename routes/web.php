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

Route::prefix('clients')->group(function () {
    Route::get('/', [App\Http\Controllers\ClientsController::class, 'index'])->name('clients');
    Route::get('/create', [App\Http\Controllers\ClientsController::class, 'create'])->name('create-client');
    Route::post('/store', [App\Http\Controllers\ClientsController::class, 'store'])->name('save-client');
    Route::get('/{id}/edit', [App\Http\Controllers\ClientsController::class, 'edit'])->name('edit-client');
    Route::post('/{id}/update', [App\Http\Controllers\ClientsController::class, 'update'])->name('update-client');
    Route::get('/{id}/delete', [App\Http\Controllers\ClientsController::class, 'delete'])->name('delete-client');
})->middleware('auth');


Route::prefix('reports')->group(function () {
    Route::get('/', [App\Http\Controllers\ReportsController::class, 'index'])->name('reports');
    Route::get('/export', [App\Http\Controllers\ReportsController::class, 'export'])->name('export');
})->middleware('auth');
