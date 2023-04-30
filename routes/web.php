<?php

use App\Http\Controllers\customerController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PaymentController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboardCopy');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resources(['customer'=>CustomerController::class]);
    Route::get('customer/{customer}/delete', [CustomerController::class, 'destroy'])->name('customer.destroy');

    Route::resources(['loan'=>LoanController::class]);
    Route::get('loan/{loan}/delete', [LoanController::class, 'destroy'])->name('loan.destroy');

    Route::resources(['payment'=>PaymentController::class]);
    Route::get('payment/{payment}/delete', [PaymentController::class, 'destroy'])->name('payment.destroy');

});


require __DIR__.'/auth.php';

