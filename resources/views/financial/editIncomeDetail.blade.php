<x-app-layout>
    <h2 id="incomeType"></h2>
    
    <form method="POST" action="{{ route('financial.updateIncomeDetail', $incomeDetail->id) }}">
        @csrf
        @method('PUT')
    
        <div class="form-group">
            <label for="income_salary">Income Salary</label>
            <input type="text" name="income_salary" id="income_salary" class="form-control" value="{{ old('income_salary', $incomeDetail->income_salary) }}" {{ $incomeDetail->income_salary == '0.00' ? 'disabled' : '' }}>
            @if ($incomeDetail->income_salary == '0.00')
                <input type="hidden" name="income_salary" value="0.00">
            @endif
        </div>
    
        <div class="form-group">
            <label for="income_investment">Income Investment</label>
            <input type="text" name="income_investment" id="income_investment" class="form-control" value="{{ old('income_investment', $incomeDetail->income_investment) }}" {{ $incomeDetail->income_investment == '0.00' ? 'disabled' : '' }}>
            @if ($incomeDetail->income_investment == '0.00')
                <input type="hidden" name="income_investment" value="0.00">
            @endif
        </div>
    
        <div class="form-group">
            <label for="income_details">Income Details</label>
            <input type="text" name="income_details" id="income_details" class="form-control" value="{{ old('income_details', $incomeDetail->income_details) }}" required>
        </div>
    
        <div class="form-group">
            <label for="income_date">Entry Date</label>
            <input type="date" name="income_date" id="income_date" class="form-control" value="{{ old('income_date', $incomeDetail->income_date) }}" required>
        </div>
    
        <button type="submit" class="btn btn-primary">Update Income Detail</button>
        <a href="{{ route('financial.indexAll') }}" class="btn btn-secondary">Cancel</a>
    </form>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let incomeSalary = parseFloat(document.getElementById('income_salary').value);
            let incomeInvestment = parseFloat(document.getElementById('income_investment').value);
    
            let incomeTypeElement = document.getElementById('incomeType');
    
            if (incomeSalary === 0.00 && incomeInvestment === 0.00) {
                incomeTypeElement.textContent = 'Income Type: None';
            } else if (incomeSalary === 0.00) {
                incomeTypeElement.textContent = 'Income Type: Investment';
            } else if (incomeInvestment === 0.00) {
                incomeTypeElement.textContent = 'Income Type: Salary';
            }
        });
    </script>
</x-app-layout>
