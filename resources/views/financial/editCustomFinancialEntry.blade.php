<!-- resources/views/financial/editCustomFinancialEntry.blade.php -->

<x-app-layout>


    <div class="container">
        <h2>Edit Custom Financial Entry</h2>

        <!-- Display validation errors if any -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('financial.updateCustomFinancialEntry', $customFinancialEntry->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="details">Details:</label>
                <input type="text" id="details" name="details" class="form-control" value="{{ old('details', $customFinancialEntry->details) }}" required>
            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', $customFinancialEntry->amount) }}" required>
            </div>

            <div class="form-group">
                <label for="entry_date">Entry Date:</label>
                <input type="date" id="entry_date" name="entry_date" class="form-control" value="{{ old('entry_date', $customFinancialEntry->entry_date) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Custom Entry</button>
            <a href="{{ route('financial.indexAll') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
