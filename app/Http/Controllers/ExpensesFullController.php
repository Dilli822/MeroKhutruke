<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesFullController extends Controller
{
    /**
     * Show the form to create a new expense.
     */
    public function create()
    {
        return view('expenses.expensecreate');
    }

    /**
     * Store a new expense.
     */
  
     public function store(Request $request)
     {
         // Validate the incoming request data
         $validated = $request->validate([
             'details' => 'string|max:255',
             'expenses_transportation' => 'numeric|min:0',
             'expenses_fooding' => 'numeric|min:0',
             'expenses_refreshment' => 'numeric|min:0',
             'expenses_shopping' => 'numeric|min:0',
             'expense_date' => 'required|date', // Ensure expense_date is provided and is a valid date
         ]);
     
         // Handle missing fields (set to 0.00 if not provided)
         $validated['expenses_transportation'] = $request->has('expenses_transportation') ? $validated['expenses_transportation'] : 0.00;
         $validated['expenses_fooding'] = $request->has('expenses_fooding') ? $validated['expenses_fooding'] : 0.00;
         $validated['expenses_refreshment'] = $request->has('expenses_refreshment') ? $validated['expenses_refreshment'] : 0.00;
         $validated['expenses_shopping'] = $request->has('expenses_shopping') ? $validated['expenses_shopping'] : 0.00;
     
         // Create a new expense entry
         Expense::create(array_merge($validated, ['user_id' => auth()->id()]));
     
         return redirect()->route('expenses.create')->with('success', 'Expense created successfully!');
     }
     

    /**
     * Display a list of all expenses.
     */
    public function index()
    {
        // Fetch expenses for the authenticated user
        $expenses = Expense::where('user_id', auth()->id())->get();

        return view('expenses.expensedetails', compact('expenses'));
    }

    /**
     * Show details of a specific expense.
     */
    public function show($id)
    {
        $expense = Expense::where('user_id', auth()->id())->findOrFail($id);

        return view('expenses.expensedetail', compact('expense'));
    }

    /**
     * Delete a specific expense.
     */
    public function destroy($id)
    {
        $expense = Expense::where('user_id', auth()->id())->findOrFail($id);

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }
}
