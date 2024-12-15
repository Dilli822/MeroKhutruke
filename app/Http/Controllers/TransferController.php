<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    // Display the form to create a new transfer
    public function create()
    {
        return view('transfers.create');
    }

    // Store the transfer record in the database
    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'cash_to_cash' => 'nullable|numeric',  // Validate as a numeric value
            'bank_to_bank' => 'nullable|numeric',  // Validate as a numeric value
        ]);

        // Create a new Transfer record with default values if fields are empty
        $transfer = new Transfer();

        // Default values for cash_to_cash and bank_to_bank
        $transfer->cash_to_cash = $request->input('cash_to_cash', 0.00);
        $transfer->bank_to_bank = $request->input('bank_to_bank', 0.00);

        // Save the transfer record to the database
        $transfer->save();

        // Redirect back with a success message
        return redirect()->route('transfers.create')->with('success', 'Transfer record created successfully!');
    }

    // Show the list of transfers (Optional)
    public function index()
    {
        $transfers = Transfer::all();
        return view('transfers.create', compact('transfers'));
    }
}
