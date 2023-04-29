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
});
// for used customer
Route::get('/Customer/List', [customerController::class, 'index'])->name('customerList');
Route::get('/addCustomer', [customerController::class, 'create'])->name('customerAdd');
Route::get('/Customer/edit/{id}', [customerController::class, 'edit'])->name('editCustomer');
Route::post('/Customer/update/{id}', [customerController::class, 'update'])->name('customer.update');
Route::get('/Customer/delete/{id}', [customerController::class, 'delete'])->name('deleteCustomer');
Route::post('/customer/store', [customerController::class, 'store'])->name('customer.store');

//for used loans
Route::get('/Loan/Add', [LoanController::class, 'create'])->name('createLoan');
Route::get('/Loan/List', [LoanController::class, 'index'])->name('loanList');
Route::post('/Loan/store', [LoanController::class, 'store'])->name('loan.store');
Route::get('/Loan/edit/{id}', [LoanController::class, 'edit'])->name('loanUpdate');
Route::post('/Loan/update/{id}', [LoanController::class, 'update'])->name('loanUpdateStore');
Route::get('/Loan/delete/{id}', [LoanController::class, 'delete'])->name('loanDelete');

//use for payment
Route::get('/payment/List', [PaymentController::class, 'index'])->name('paymentList');
Route::get('/Payment/add', [PaymentController::class, 'create'])->name('createPayment');
Route::get('/Payment/edit/{id}', [PaymentController::class, 'edit'])->name('paymentUpdate');
Route::post('/Payment/store', [PaymentController::class, 'store'])->name('payment.store');
Route::post('/Payment/Update/{id}', [PaymentController::class, 'update'])->name('payment.update');
Route::get('/Payment/delete/{id}', [PaymentController::class, 'delete'])->name('paymentDelete');


require __DIR__.'/auth.php';

