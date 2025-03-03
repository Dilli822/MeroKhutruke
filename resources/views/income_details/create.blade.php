
<x-app-layout>
<div class="">

    <div class="container">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Create Income Details</h2>

                <!-- Success Message -->
                @if(session('success'))
                    <div id="messageDiv" class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    <script>
                        showSuccessMessage();
                    </script>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
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
                    <label for="income_type" class="block text-gray-700 font-semibold">Select Income Type:</label>
                    <div class="mb-4">
                      
                            <select id="income_type" name="income_type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" onchange="toggleFields()" required style="width: 100%;">
        <option value="">-- Select --</option>
        <option value="salary">Salary</option>
        <option value="investment">Investment</option>
    </select>
                    
                        </div>
   




                    <!-- Salary Field -->
                    <div class="mb-3">
                        <label for="income_salary" class="form-label">Salary:</label>
                        <input type="number" name="income_salary" id="income_salary" step="0.01" value="{{ old('income_salary') }}" 
                            class="form-control" min="0" disabled>
                    </div>

                    <!-- Investment Field -->
                    <div class="mb-3">
                        <label for="income_investment" class="form-label">Investment:</label>
                        <input type="number" name="income_investment" id="income_investment" step="0.01" value="{{ old('income_investment') }}" 
                            class="form-control" min="0" disabled>
                    </div>

                    <div class="mb-3">
                    <label for="details" class="form-label">Income Details:</label>
                    <textarea name="income_details" id="income_details" rows="4" class="form-control"></textarea>
                </div>

                <div class="mb-4">
    <label for="income_date" class="block text-gray-700 font-semibold">Date:</label>
    <input type="date" name="income_date" id="income_date" required value="{{ old('income_date', now()->toDateString()) }}" 
        class="form-input mt-1 block w-full p-2 border border-gray-300 rounded-md" style="width: 100%;">
</div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



<script>
        // Function to toggle the input fields based on the selected option
        function toggleFields() {
            var selectedValue = document.getElementById('income_type').value;
            var salaryField = document.getElementById('income_salary');
            var investmentField = document.getElementById('income_investment');

            // Reset field validation and states
            salaryField.classList.remove('is-invalid');
            investmentField.classList.remove('is-invalid');

            // Enable/Disable fields based on selection
            if (selectedValue === 'salary') {
                salaryField.disabled = false;
                investmentField.disabled = true;
                investmentField.classList.add('is-invalid');
                investmentField.value = '0.00';
            } else if (selectedValue === 'investment') {
                investmentField.disabled = false;
                salaryField.disabled = true;
                salaryField.classList.add('is-invalid');
                salaryField.value = '0.00';
            } else {
                salaryField.disabled = true;
                investmentField.disabled = true;
                salaryField.classList.add('is-invalid');
                investmentField.classList.add('is-invalid');
                salaryField.value = '0.00';
                investmentField.value = '0.00';
            }
        }

        // Function to show success message for 3 seconds
        function showSuccessMessage() {
            var messageDiv = document.getElementById('messageDiv');
            messageDiv.classList.remove('d-none');
            setTimeout(function() {
                messageDiv.classList.add('d-none');
            }, 3000);
        }

        // Ensure only one input field is enabled on page load with default values set to 0.00
        window.onload = function () {
            var salaryField = document.getElementById('income_salary');
            var investmentField = document.getElementById('income_investment');

            // Set default values to 0.00
            salaryField.value = '0.00';
            investmentField.value = '0.00';

            // Disable the fields
            salaryField.disabled = true;
            investmentField.disabled = true;
        }
    </script>

</x-app-layout>