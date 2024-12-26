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
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\MasterFinancialController;
use App\Http\Controllers\MasterFinancialAllController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\CustomExpensesDetails;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpensesFullController;


// Root route - check if authenticated, if so redirect to masterfinancial, otherwise show layout
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('financial.index')  // Redirect to financial.index (Master Financial) if authenticated
        : view('layout');                        // Show layout if not authenticated
});

// Login route - show login page if not authenticated, otherwise redirect to financial.index
Route::get('/login', function () {
    return auth()->check()
        ? redirect()->route('financial.index')  // Redirect to financial.index (Master Financial) if authenticated
        : view('auth.login');                    // Show login page if not authenticated
})->name('login');

// Dashboard route - authenticated users are redirected to financial.index (Master Financial)
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return redirect()->route('financial.index');  // Redirect authenticated user to financial.index (Master Financial)
})->name('dashboard');

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    
    // Register route for creating a new user (usually for admin)
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

    // Master Financial Dashboard route (financial.index)
    Route::get('/masterfinancial', [MasterFinancialController::class, 'index'])->name('financial.index');
    
    // Master Financial all entries (view all financial records)
    Route::get('/masterfinancial/all', [MasterFinancialAllController::class, 'getFinancialData'])->name('financial.indexAll');
    
    // Income details routes
    Route::get('/income_details/create', [IncomeDetailsController::class, 'create'])->name('income_details.create');  // Show income details creation form
    Route::post('/income_details', [IncomeDetailsController::class, 'store'])->name('income_details.store');  // Store income details

    // Custom financial details routes
    Route::get('/custom_financial/create', [CustomFinanceDetailsController::class, 'create'])->name('custom_financial.create');  // Show custom financial details creation form
    Route::post('/custom_financial/store', [CustomFinanceDetailsController::class, 'store'])->name('custom_financial.store');  // Store custom financial details

    // Transfers routes
    Route::get('/transfers', [TransferController::class, 'index'])->name('transfers.create');  // Show transfers
    Route::get('/transfers/create', [TransferController::class, 'create'])->name('transfers.create');  // Show create transfer form
    Route::post('/transfers', [TransferController::class, 'store'])->name('transfers.store');  // Store transfer

    // Expenses routes
    Route::get('/expenses/create', [ExpensesFullController::class, 'create'])->name('expenses.create');  // Show expenses creation form
    Route::post('/expenses', [ExpensesFullController::class, 'store'])->name('expenses.store');  // Store expense
    Route::get('/expenses', [ExpensesFullController::class, 'index'])->name('expenses.index');  // Show all expenses

    // Deleting entries
    Route::delete('/financial/transfers/{id}', [MasterFinancialAllController::class, 'deleteTransfer'])->name('financial.deleteTransfer');
    Route::delete('/financial/custom-financial-entries/{id}', [MasterFinancialAllController::class, 'deleteCustomFinancialEntry'])->name('financial.deleteCustomFinancialEntry');
    Route::delete('/financial/income-details/{id}', [MasterFinancialAllController::class, 'deleteIncomeDetail'])->name('financial.deleteIncomeDetail');
    Route::delete('/financial/expenses/{id}', [MasterFinancialAllController::class, 'deleteExpense'])->name('financial.deleteExpense');

    // Edit routes for custom financial entries, income details, and expenses
    Route::get('/edit-custom-financial-entry/{id}', [MasterFinancialAllController::class, 'editCustomFinancialEntry'])->name('financial.editCustomFinancialEntry');
    Route::put('/update-custom-financial-entry/{id}', [MasterFinancialAllController::class, 'updateCustomFinancialEntry'])->name('financial.updateCustomFinancialEntry');
    
    Route::get('/edit-income-detail/{id}', [MasterFinancialAllController::class, 'editIncomeDetail'])->name('financial.editIncomeDetail');
    Route::put('/update-income-detail/{id}', [MasterFinancialAllController::class, 'updateIncomeDetail'])->name('financial.updateIncomeDetail');
    
    Route::get('/edit-expense-detail/{id}', [MasterFinancialAllController::class, 'editExpenseDetail'])->name('financial.editExpense');
    Route::put('/update-expense-detail/{id}', [MasterFinancialAllController::class, 'updateExpenseDetail'])->name('financial.updateExpense');
});

require __DIR__ . '/auth.php';  // Include the auth routes
