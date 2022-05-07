<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;

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
});

Route::get('/transfers', [TransferController::class, 'index'])->name('transfer.index');
Route::get('/transfers/{transfer}', [TransferController::class, 'show'])->name('transfer.show');
Route::post('/transfers', [TransferController::class, 'store'])->name('transfer.store');
Route::get('/transfers/create/{id}', [TransferController::class, 'create'])->name('transfer.create');
Route::get('/customers', [UserController::class, 'index'])->name('customer.index');
