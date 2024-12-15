<?php

use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EcategoryController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\IcategoryController;
use App\Http\Controllers\Backend\IncomeController;
use App\Http\Controllers\Backend\TcategoryController;
use App\Http\Controllers\Backend\CustomTransferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncomeDetailsController;
use App\Http\Controllers\CustomFinanceDetailsController;
use App\Http\Controllers\ExpensesFinalController;
use App\Http\Controllers\UserDetailController;

use App\Http\Controllers\TransferController;

use App\Models\Dashboard;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('layout');
});

Route::get('/dashboard', [DashboardController::class, 'profile'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('/user/dashboard', DashboardController::class)->names('user.dashboard');

    // Route to display the form
  
    Route::get('/income_details/create', [IncomeDetailsController::class, 'create'])->name('income_details.create');
    Route::post('/income_details', [IncomeDetailsController::class, 'store'])->name('income_details.store');
    Route::get('/custom_financial/create', [CustomFinanceDetailsController::class, 'create'])->name('custom_financial.create');
    Route::post('/custom_financial/store', [CustomFinanceDetailsController::class, 'store'])->name('custom_financial.store');




    Route::get('/transfers', [TransferController::class, 'index'])->name('transfers.index');
    Route::get('/transfers/create', [TransferController::class, 'create'])->name('transfers.create');
    Route::post('/transfers', [TransferController::class, 'store'])->name('transfers.store');
    


Route::get('/expenses_final/create', [ExpensesFinalController::class, 'create'])->name('expenses_final.create');
Route::post('/expenses_final/store', [ExpensesFinalController::class, 'store'])->name('expenses_final.store');
Route::get('/expenses_final', [ExpensesFinalController::class, 'index'])->name('expenses_final.index');

});

require __DIR__ . '/auth.php';

