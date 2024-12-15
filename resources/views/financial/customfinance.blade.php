<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Custom Financial Entry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      
      // Function to handle the checkbox logic
function handleCheckboxChange(selected) {
    // Uncheck all checkboxes when one is checked
    const expenseCheckbox = document.getElementById('is_expense');
    const incomeCheckbox = document.getElementById('is_income');
    const transactionCheckbox = document.getElementById('is_transaction');

    // Reset all checkboxes
    expenseCheckbox.checked = false;
    incomeCheckbox.checked = false;
    transactionCheckbox.checked = false;

    // Set the selected checkbox to true
    selected.checked = true;

    // Autofill the fields based on selection
    autofillFields();
}

// Function to autofill fields based on selection
function autofillFields() {
    const expenseField = document.getElementById('expense');
    const incomeField = document.getElementById('income');
    const transactionField = document.getElementById('transaction');
    
    const amountField = document.getElementById('amount');
    
    // Disable all fields and set their value to 0.00 initially
    expenseField.disabled = true;
    incomeField.disabled = true;
    transactionField.disabled = true;

    expenseField.value = "0.00";
    incomeField.value = "0.00";
    transactionField.value = "0.00";

    // Enable and set value of the selected field to 1.00
    if (document.getElementById('is_expense').checked) {
        expenseField.disabled = false;
        expenseField.value = "1.00";
    } else if (document.getElementById('is_income').checked) {
        incomeField.disabled = false;
        incomeField.value = "1.00";
    } else if (document.getElementById('is_transaction').checked) {
        transactionField.disabled = false;
        transactionField.value = "1.00";
    }
}

// Function to copy the amount to the enabled field
function copyAmountToSelectedField() {
    const amountField = document.getElementById('amount');
    const expenseField = document.getElementById('expense');
    const incomeField = document.getElementById('income');
    const transactionField = document.getElementById('transaction');

    // Get the value from the amount field
    const amountValue = amountField.value;

    // If expense field is enabled, copy amount to it
    if (!expenseField.disabled) {
        expenseField.value = amountValue;
    }
    // If income field is enabled, copy amount to it
    else if (!incomeField.disabled) {
        incomeField.value = amountValue;
    }
    // If transaction field is enabled, copy amount to it
    else if (!transactionField.disabled) {
        transactionField.value = amountValue;
    }
}

// Initialize autofill on page load
window.onload = function() {
    autofillFields();  // Autofill based on current selection
    const amountField = document.getElementById('amount');
    amountField.addEventListener('input', copyAmountToSelectedField);  // Listen for changes in the amount field
};
                // JavaScript function to hide the message after 3 seconds
                window.onload = function() {
            var successMessage = document.querySelector('.success-message');
            var errorMessage = document.querySelector('.error-message');
            
            // Hide success message after 3 seconds
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 3000);
            }

            // Hide error message after 3 seconds
            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000);
            }
        };
    </script>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-lg">
        <h1 class="text-2xl font-semibold text-center mb-4">Create Custom Financial Entry</h1>

        <!-- Success Message -->
        @if(session('success'))
            <p id="success-message" class="text-green-500 mb-4 text-center p-4 bg-green-100 border-l-4 border-green-500 rounded">
                {{ session('success') }}
            </p>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div id="error-messages">
                <ul class="text-red-500 mb-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('custom_financial.store') }}" method="POST">
            @csrf

            <!-- Details Field -->
            <div class="mb-4">
                <label for="details" class="block text-sm font-medium text-gray-700">Details:</label>
                <input type="text" name="details" id="details" value="{{ old('details') }}" required 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" min="0">
            </div>

            <!-- Amount Field -->
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount:</label>
                <input type="number" name="amount" id="amount" step="0.01" value="{{ old('amount') }}" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" min="0">
            </div>

            <!-- Expense Checkbox -->
            <div class="mb-4">
                <label for="is_expense" class="inline-flex items-center">
                    <input type="checkbox" name="is_expense" id="is_expense" value="1" {{ old('is_expense') ? 'checked' : '' }} 
                        class="form-checkbox h-5 w-5 text-indigo-600" onclick="handleCheckboxChange(this)">
                    <span class="ml-2 text-sm text-gray-700">Expense</span>
                </label>
            </div>

            <!-- Income Checkbox -->
            <div class="mb-4">
                <label for="is_income" class="inline-flex items-center">
                    <input type="checkbox" name="is_income" id="is_income" value="1" {{ old('is_income') ? 'checked' : '' }} 
                        class="form-checkbox h-5 w-5 text-indigo-600" onclick="handleCheckboxChange(this)">
                    <span class="ml-2 text-sm text-gray-700">Income</span>
                </label>
            </div>

            <!-- Transaction Checkbox -->
            <div class="mb-4">
                <label for="is_transaction" class="inline-flex items-center">
                    <input type="checkbox" name="is_transaction" id="is_transaction" value="1" {{ old('is_transaction') ? 'checked' : '' }} 
                        class="form-checkbox h-5 w-5 text-indigo-600" onclick="handleCheckboxChange(this)">
                    <span class="ml-2 text-sm text-gray-700">Transaction</span>
                </label>
            </div>

            <!-- Expense Amount Field -->
             <div style="display: none;">
            <div class="mb-4">
                <label for="expense" class="block text-sm font-medium text-gray-700">Expense Amount:</label>
                <input type="number" name="expense" id="expense" step="0.01" value="{{ old('expense') }}" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" min="0">
            </div>

            <!-- Income Amount Field -->
            <div class="mb-4">
                <label for="income" class="block text-sm font-medium text-gray-700">Income Amount:</label>
                <input type="number" name="income" id="income" step="0.01" value="{{ old('income') }}" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" min="0">
            </div>

            <!-- Transaction Amount Field -->
            <div class="mb-4">
                <label for="transaction" class="block text-sm font-medium text-gray-700">Transaction Amount:</label>
                <input type="number" name="transaction" id="transaction" step="0.01" value="{{ old('transaction') }}" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" min="0">
            </div>
            </div>
            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Submit
                </button>
            </div>
        </form>
    </div>

</body>
</html>
