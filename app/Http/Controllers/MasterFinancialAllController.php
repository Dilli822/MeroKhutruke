<?php 


namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\CustomFinanceDetails;
use App\Models\IncomeDetail;
use App\Models\Expense;
use Illuminate\Http\Request;

class MasterFinancialAllController extends Controller
{
    public function getFinancialData()
    {
        // Get authenticated user
        $user = auth()->user();
    
        // Fetch all user-specific data from the tables
        $transfers = Transfer::where('user_id', $user->id)->get();
        $customFinancialEntries = CustomFinanceDetails::where('user_id', $user->id)->get();
        $incomeDetails = IncomeDetail::where('user_id', $user->id)->get();
        $expenses = Expense::where('user_id', $user->id)->get();
    
        // Check if data is fetched correctly
        if (!$transfers || !$customFinancialEntries || !$incomeDetails || !$expenses) {
            abort(500, 'Failed to fetch financial data.');
        }
    
        // Return data to the view, including the authenticated user
        return view('financial.indexAll', compact('transfers', 'customFinancialEntries', 'incomeDetails', 'expenses', 'user'));
    }
    

    // Delete a Transfer record
    public function deleteTransfer($id)
    {
        $transfer = Transfer::find($id);

        if (!$transfer) {
            return redirect()->route('financial.indexAll')->with('error', 'Transfer not found.');
        }

        $transfer->delete();

        return redirect()->route('financial.indexAll')->with('success', 'Transfer deleted successfully.');
    }

    // Delete a CustomFinancialEntry record
    public function deleteCustomFinancialEntry($id)
    {
        $customFinancialEntry = CustomFinanceDetails::find($id);

        if (!$customFinancialEntry) {
            return redirect()->route('financial.indexAll')->with('error', 'Custom Financial Entry not found.');
        }

        $customFinancialEntry->delete();

        return redirect()->route('financial.indexAll')->with('success', 'Custom Financial Entry deleted successfully.');
    }

    // Delete an IncomeDetail record
    public function deleteIncomeDetail($id)
    {
        $incomeDetail = IncomeDetail::find($id);

        if (!$incomeDetail) {
            return redirect()->route('financial.indexAll')->with('error', 'Income Detail not found.');
        }

        $incomeDetail->delete();

        return redirect()->route('financial.indexAll')->with('success', 'Income Detail deleted successfully.');
    }

    // Delete an Expense record
    public function deleteExpense($id)
    {
        $expense = Expense::find($id);

        if (!$expense) {
            return redirect()->route('financial.indexAll')->with('error', 'Expense not found.');
        }

        $expense->delete();

        return redirect()->route('financial.indexAll')->with('success', 'Expense deleted successfully.');
    }

    // Edit a Transfer record
    public function editTransfer($id)
    {
        $transfer = Transfer::find($id);

        if (!$transfer) {
            return redirect()->route('financial.indexAll')->with('error', 'Transfer not found.');
        }

        return view('financial.editTransfer', compact('transfer'));
    }

    // Update a Transfer record
    public function updateTransfer(Request $request, $id)
    {
        $request->validate([
            'details' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'entry_date' => 'required|date',
        ]);

        $transfer = Transfer::find($id);

        if (!$transfer) {
            return redirect()->route('financial.indexAll')->with('error', 'Transfer not found.');
        }

        $transfer->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'entry_date' => $request->entry_date,
        ]);

        return redirect()->route('financial.indexAll')->with('success', 'Transfer updated successfully.');
    }

    // Edit a CustomFinancialEntry record
    public function editCustomFinancialEntry($id)
    {
        $customFinancialEntry = CustomFinanceDetails::find($id); // Corrected model name
    
        if (!$customFinancialEntry) {
            return redirect()->route('financial.indexAll')->with('error', 'Custom Financial Entry not found.');
        }
    
        return view('financial.editCustomFinancialEntry', compact('customFinancialEntry'));
    }
    
    // Update a CustomFinancialEntry record
    public function updateCustomFinancialEntry(Request $request, $id)
    {
        $request->validate([
            'details' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'entry_date' => 'required|date',
        ]);

        $customFinancialEntry = CustomFinanceDetails::find($id);

        if (!$customFinancialEntry) {
            return redirect()->route('financial.indexAll')->with('error', 'Custom Financial Entry not found.');
        }

        $customFinancialEntry->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'entry_date' => $request->entry_date,
        ]);

        return redirect()->route('financial.indexAll')->with('success', 'Custom Financial Entry updated successfully.');
    }

    // Edit an IncomeDetail record
    public function editIncomeDetail($id)
    {
        $incomeDetail = IncomeDetail::find($id);
    
        if (!$incomeDetail) {
            return redirect()->route('financial.indexAll')->with('error', 'Income Detail not found.');
        }
    
        return view('financial.editIncomeDetail', compact('incomeDetail'));
    }
    
    public function updateIncomeDetail(Request $request, $id)
    {
        $request->validate([
            'income_salary' => 'nullable|numeric',
            'income_investment' => 'nullable|numeric',
            'income_details' => 'required|string|max:255',
            'income_date' => 'required|date',
        ]);
    
        $incomeDetail = IncomeDetail::find($id);
    
        if (!$incomeDetail) {
            return redirect()->route('financial.indexAll')->with('error', 'Income Detail not found.');
        }
    
        $incomeDetail->update([
            'income_salary' => $request->income_salary,
            'income_investment' => $request->income_investment,
            'income_details' => $request->income_details,
            'income_date' => $request->income_date,
        ]);
    
        return redirect()->route('financial.indexAll')->with('success', 'Income Detail updated successfully.');
    }
    public function editExpenseDetail($id)
    {
        // Fetch the expense record by ID
        $expense = Expense::find($id);
    
        // If the expense record is not found, redirect with an error message
        if (!$expense) {
            return redirect()->route('financial.indexAll')->with('error', 'Expense not found.');
        }
    
        // Return the edit view with the expense data
        return view('financial.editExpense', compact('expense'));
    }
    

    public function updateExpenseDetail(Request $request, $id)
{
    $request->validate([
        'details' => 'required|string|max:255',
        'transportation' => 'nullable|numeric',
        'fooding' => 'nullable|numeric',
        'refreshment' => 'nullable|numeric',
        'shopping' => 'nullable|numeric',
        'expense_date' => 'required|date',
    ]);

    $expense = Expense::find($id);

    if (!$expense) {
        return redirect()->route('financial.indexAll')->with('error', 'Expense not found.');
    }

    $expense->update([
        'details' => $request->details,
        'expenses_transportation' => $request->transportation,
        'expenses_fooding' => $request->fooding,
        'expenses_refreshment' => $request->refreshment,
        'expenses_shopping' => $request->shopping,
        'expense_date' => $request->expense_date,
    ]);

    return redirect()->route('financial.indexAll')->with('success', 'Expense updated successfully.');
}

}
    