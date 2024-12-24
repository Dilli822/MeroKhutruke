<x-app-layout>
<form action="{{ route('financial.updateExpense', $expense->id) }}" method="POST" id="expenseForm">
    @csrf
    @method('PUT')

    <h3>Edit Your Expense</h3>
    <div class="container">
         
    <div class="form-group" id="expenseDetails">
        <label for="details">Details</label>
        <textarea name="details" id="details" class="form-control">{{ old('tetails', $expense->details) }}</textarea>
    </div>


    <div class="form-group" id="expenseTransport">
        <label for="transportation">Transportation</label>
        <input type="number" name="transportation" id="transportation" value="{{ old('transportation', $expense->expenses_transportation) }}" class="form-control">
    </div>

    <div class="form-group" id="expenseFood">
        <label for="fooding">Fooding</label>
        <input type="number" name="fooding" id="fooding" value="{{ old('fooding', $expense->expenses_fooding) }}" class="form-control">
    </div>

    <div class="form-group" id="expenseRefreshment">
        <label for="refreshment">Refreshment</label>
        <input type="number" name="refreshment" id="refreshment" value="{{ old('refreshment', $expense->expenses_refreshment) }}" class="form-control">
    </div>

    <div class="form-group" id="expenseShopping">
        <label for="shopping">Shopping</label>
        <input type="number" name="shopping" id="shopping" value="{{ old('shopping', $expense->expenses_shopping) }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="expense_date">Expense Date</label>
        <input type="date" name="expense_date" id="expense_date" value="{{ old('expense_date', $expense->expense_date) }}" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update Expense</button>
    <a href="{{ route('financial.indexAll') }}" class="btn btn-secondary">Cancel</a>
</form>
</div>

<script>

if (document.getElementById("shopping").value <= 0) {
    document.getElementById("expenseShopping").classList.add("d-none");
}

if (document.getElementById("refreshment").value <= 0) {
    document.getElementById("expenseRefreshment").classList.add("d-none");
}


if (document.getElementById("transportation").value <= 0) {
    document.getElementById("expenseTransport").classList.add("d-none");
}

if (document.getElementById("fooding").value <= 0) {
    document.getElementById("expenseFood").classList.add("d-none");
}

</script>

</x-app-layout>
