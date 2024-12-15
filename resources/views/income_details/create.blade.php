<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Income Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Function to toggle the input fields based on the selected option
        function toggleFields() {
            var selectedValue = document.getElementById('income_type').value;
            var salaryField = document.getElementById('income_salary');
            var investmentField = document.getElementById('income_investment');

            // Reset the borders to default when switching between fields
            salaryField.classList.remove('border-red-500');
            investmentField.classList.remove('border-red-500');

            // Show/hide fields based on the selected type
            if (selectedValue === 'salary') {
                salaryField.disabled = false;
                investmentField.disabled = true;
                investmentField.classList.add('border-red-500');
            } else if (selectedValue === 'investment') {
                investmentField.disabled = false;
                salaryField.disabled = true;
                salaryField.classList.add('border-red-500');
            } else {
                salaryField.disabled = true;
                investmentField.disabled = true;
                salaryField.classList.add('border-red-500');
                investmentField.classList.add('border-red-500');
            }
        }

        // Function to show success message for 3 seconds
        function showSuccessMessage() {
            var messageDiv = document.getElementById('messageDiv');
            messageDiv.style.display = 'block';
            setTimeout(function() {
                messageDiv.style.display = 'none';
            }, 3000); // 3 seconds
        }

        // Ensure only one input field is enabled on page load
        window.onload = function () {
            document.getElementById('income_salary').disabled = true;
            document.getElementById('income_investment').disabled = true;
        }
    </script>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-lg">
        <h1 class="text-2xl font-semibold text-center mb-4">Create Income Details</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div id="messageDiv" class="text-green-500 mb-4 text-center p-4 bg-green-100 border-l-4 border-green-500 rounded hidden">
                {{ session('success') }}
            </div>
            <script>
                // Show success message when it's available
                showSuccessMessage();
            </script>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="text-red-500 mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form for Adding Income Details -->
        <form action="{{ route('income_details.store') }}" method="POST">
            @csrf

            <!-- Select Field for Choosing Income Type -->
            <div class="mb-4">
                <label for="income_type" class="block text-sm font-medium text-gray-700">Select Income Type:</label>
                <select id="income_type" name="income_type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" onchange="toggleFields()" required>
                    <option value="">-- Select --</option>
                    <option value="salary">Salary</option>
                    <option value="investment">Investment</option>
                </select>
            </div>

            <!-- Salary Field -->
            <div class="mb-4">
                <label for="income_salary" class="block text-sm font-medium text-gray-700">Salary:</label>
                <input type="number" name="income_salary" id="income_salary" step="0.01" value="{{ old('income_salary') }}" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" min="0" disabled>
            </div>

            <!-- Investment Field -->
            <div class="mb-4">
                <label for="income_investment" class="block text-sm font-medium text-gray-700">Investment:</label>
                <input type="number" name="income_investment" id="income_investment" step="0.01" value="{{ old('income_investment') }}" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" min="0" disabled>
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
