<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ecategory;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
        $ecategories = Ecategory::all();
        return view('backend.expense.index',compact('expenses', 'ecategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expense = Expense::all();
        $ecategories = Ecategory::all();
        return view('backend.expense.create', compact('expense','ecategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $expense = new Expense();
        $expense->ecategory_id = $request->ecategory_id;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->date = $request->date;
        $expense->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::find($id);
        return view('backend.expense.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $expense = Expense::find($id);
        $expense->ecategory_id = $request->ecategory_id;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->date = $request->date;
        $expense->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::find($id);
        $expense->delete();
        return redirect()->back();
    }
}
