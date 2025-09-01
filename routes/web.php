<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstallmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Models\Client;

Route::get('/', function () {
    $clients = Client::all();
    return view('home', compact('clients'));
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');




Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
Route::post('/installments/{installment}/pay', [PaymentController::class, 'markAsPaid'])->name('installments.pay');

Route::get('/payments/create/{client?}', [PaymentController::class, 'create'])->name('payments.create');
Route::get('/clients/{client}/payments', [PaymentController::class, 'history'])->name('clients.payments.history');

Route::get('/installments/{status}', [InstallmentController::class, 'indexByStatus'])->name('installments.index');

Route::get('/installments/{id}/qrcode', [InstallmentController::class, 'generateQrCode'])->name('installments.qrcode');


