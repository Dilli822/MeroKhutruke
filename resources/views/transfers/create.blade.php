<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Transfer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <script>
        // JavaScript function to toggle the visibility of fields based on selected option
        function toggleFields() {
            // Get selected value
            var selectedOption = document.querySelector('input[name="transfer_type"]:checked').value;

            // Hide both fields by default
            document.getElementById('cash_to_cash_field').style.display = 'none';
            document.getElementById('bank_to_bank_field').style.display = 'none';

            // Show the selected field
            if (selectedOption === 'cash_to_cash') {
                document.getElementById('cash_to_cash_field').style.display = 'block';
            } else if (selectedOption === 'bank_to_bank') {
                document.getElementById('bank_to_bank_field').style.display = 'block';
            }
        }

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
        <h1 class="text-2xl font-semibold text-center mb-4">Create Transfer</h1>

        <!-- Success Message -->
        @if(session('success'))
            <p class="success-message text-green-500 mb-4 text-center p-4 bg-green-100 border-l-4 border-green-500 rounded">
                {{ session('success') }}
            </p>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="error-message mb-4">
                <ul class="text-red-500">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transfers.store') }}" method="POST">
            @csrf

            <!-- Radio Buttons to select transfer type -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Transfer Type:</label>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <input type="radio" id="cash_to_cash_radio" name="transfer_type" value="cash_to_cash" onclick="toggleFields()" checked>
                        <label for="cash_to_cash_radio" class="ml-2">Cash to Cash</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="bank_to_bank_radio" name="transfer_type" value="bank_to_bank" onclick="toggleFields()">
                        <label for="bank_to_bank_radio" class="ml-2">Bank to Bank</label>
                    </div>
                </div>
            </div>

            <!-- Cash to Cash Field (initially visible) -->
            <div class="mb-4" id="cash_to_cash_field" style="display: block;">
                <label for="cash_to_cash" class="block text-sm font-medium text-gray-700">Cash to Cash:</label>
                <input type="number" name="cash_to_cash" id="cash_to_cash" step="0.01" value="{{ old('cash_to_cash', 0.00) }}" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" min="0">
            </div>

            <!-- Bank to Bank Field (hidden initially) -->
            <div class="mb-4" id="bank_to_bank_field" style="display: none;">
                <label for="bank_to_bank" class="block text-sm font-medium text-gray-700">Bank to Bank:</label>
                <input type="number" name="bank_to_bank" id="bank_to_bank" step="0.01" value="{{ old('bank_to_bank', 0.00) }}" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" min="0">
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Submit Transfer
                </button>
            </div>
        </form>
    </div>

</body>
</html>
