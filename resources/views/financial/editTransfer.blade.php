<!-- resources/views/financial/editTransfer.blade.php -->

    <div class="container">
        <h2>Edit Transfer</h2>

        <!-- Display validation errors if any -->
        @if($errors->any())


        <form action="{{ route('financial.updateTransfer', $transfer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="details">Details:</label>
                <input type="text" id="details" name="details" class="form-control" value="{{ old('details', $transfer->details) }}" required>
            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', $transfer->amount) }}" required>
            </div>

            <div class="form-group">
                <label for="transfer_date">Entry Date:</label>
                <input type="date" id="transfer_date" name="transfer_date" class="form-control" value="{{ old('transfer_date', $transfer->transfer_date) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Transfer</button>
            <a href="{{ route('financial.indexAll') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

