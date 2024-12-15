<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpensesFinal;  // Model for expenses_final table

class ExpensesFinalController extends Controller
{
    // Display the form to create a new expense entry
    public function create()
    {
        return view('expenses_final.create');
    }

    // Store the new expense entry
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_transportation' => 'required|numeric|min:0',
            'expense_refreshment' => 'required|numeric|min:0',
            'expense_fooding' => 'required|numeric|min:0',
            'expense_shopping' => 'required|numeric|min:0',
        ]);

        ExpensesFinal::create($validated);

        return redirect()->route('expenses_final.create')->with('success', 'Expense added successfully');
    }

    // Show all expenses (for the modal to load data)
    public function index()
    {
        $expenses = ExpensesFinal::all();
        return view('expenses_final.index', compact('expenses'));
    }
}
