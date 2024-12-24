

<x-app-layout>
    <div class="container p-0">

        <div class="card mx-auto shadow-lg p-4"  style="max-width: 600px;">
            <h2 class="text-center">Create Expense Details</h2>

            <!-- Success Message -->
            @if(session('success'))
                <div id="messageDiv" class="alert alert-success mb-4 text-center" style="display:none;">
                    {{ session('success') }}
                </div>
                <script>
                    // Show success message when it's available
                    showSuccessMessage();
                </script>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form for Adding Expense Details -->
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf

                <!-- Hidden Field for user_id -->
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />

                <!-- Select Field for Choosing Expense Type -->
                <div class="mb-3">
                <label for="expense_type" class="block text-gray-700 font-semibold">Select Expense Type:</label>
              

    <select id="expense_type" name="expense_type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" onchange="toggleFields()" required style="width: 100%;">
        <option value="">-- Select --</option>
        <option value="transportation">Transportation</option>
        <option value="fooding">Fooding</option>
        <option value="refreshment">Refreshment</option>
        <option value="shopping">Shopping</option>
    </select>
</div>


                <!-- Transportation Field -->
                <div class="mb-3">
                    <label for="expenses_transportation" class="form-label">Transportation:</label>
                    <input type="number" name="expenses_transportation" id="expenses_transportation" step="0.01" value="0.00"
                        class="form-control" min="0" disabled>
                </div>

                <!-- Fooding Field -->
                <div class="mb-3">
                    <label for="expenses_fooding" class="form-label">Fooding:</label>
                    <input type="number" name="expenses_fooding" id="expenses_fooding" step="0.01" value="0.00"
                        class="form-control" min="0" disabled>
                </div>

                <!-- Refreshment Field -->
                <div class="mb-3">
                    <label for="expenses_refreshment" class="form-label">Refreshment:</label>
                    <input type="number" name="expenses_refreshment" id="expenses_refreshment" step="0.01" value="0.00"
                        class="form-control" min="0" disabled>
                </div>

                <!-- Shopping Field -->
                <div class="mb-3">
                    <label for="expenses_shopping" class="form-label">Shopping:</label>
                    <input type="number" name="expenses_shopping" id="expenses_shopping" step="0.01" value="0.00"
                        class="form-control" min="0" disabled>
                </div>

                <!-- Expense Details Field -->
                <div class="mb-3">
                    <label for="details" class="form-label">Expense Details:</label>
                    <textarea name="details" id="details" rows="4" class="form-control"></textarea>
                </div>
                <div class="form-group">
        <label for="expense_date">Expense Date:</label>
        <input type="date" class="form-control" id="expense_date" name="expense_date" value="{{ old('expense_date', now()->toDateString()) }}" required >
    </div>


                <!-- Submit Button -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary w-100">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>    </x-app-layout>

    <script>
        // Function to toggle the input fields based on the selected expense type
        function toggleFields() {
            var selectedValue = document.getElementById('expense_type').value;

            var transportationField = document.getElementById('expenses_transportation');
            var foodingField = document.getElementById('expenses_fooding');
            var refreshmentField = document.getElementById('expenses_refreshment');
            var shoppingField = document.getElementById('expenses_shopping');

            // Reset all fields to 0.00, disable them, and apply a red border if unselected
            [transportationField, foodingField, refreshmentField, shoppingField].forEach(field => {
                field.value = '0.00';
                field.disabled = true;
                field.classList.remove('border-success');
                field.classList.add('border-danger'); // Red border for unselected fields
            });

            // Enable and highlight the selected field
            if (selectedValue === 'transportation') {
                transportationField.disabled = false;
                transportationField.classList.add('border-success');
                transportationField.classList.remove('border-danger');
            } else if (selectedValue === 'fooding') {
                foodingField.disabled = false;
                foodingField.classList.add('border-success');
                foodingField.classList.remove('border-danger');
            } else if (selectedValue === 'refreshment') {
                refreshmentField.disabled = false;
                refreshmentField.classList.add('border-success');
                refreshmentField.classList.remove('border-danger');
            } else if (selectedValue === 'shopping') {
                shoppingField.disabled = false;
                shoppingField.classList.add('border-success');
                shoppingField.classList.remove('border-danger');
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

        // Ensure fields are reset on page load
        window.onload = function () {
            toggleFields(); // Reset fields based on initial selection
        }
    </script>

