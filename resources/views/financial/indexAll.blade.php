
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Financial Statement </title>

    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link to jsPDF library for PDF generation -->
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>

    <style>
        /* Custom table styling */
        .table th, .table td {
            text-align: center; /* Center the text in table cells */
        }
        
        .table {
            border: 1px solid #ddd; /* Border styling for the table */
        }

        .btn-download {
            background-color: #4CAF50; /* Green button color */
            color: white; /* White text on the button */
        }

        .btn-filter {
            background-color: #007bff; /* Blue button color for filter */
            color: white;
        }

        .card-header {
            background-color: #f8f9fa; /* Light background color for card header */
            font-weight: bold; /* Bold text for header */
        }
    </style>
</head>
<body>
<x-app-layout>
<!-- Container for the content -->
<div class="container mt-0">
    <h1 class="text-center mb-2">Financial Data Overview</h1>

    <section class="" id="financeDy"> 
    <!-- Dropdown for Filter -->
    <div class="mb-4 d-flex justify-content-center">
        <select id="durationFilter" class="form-select w-25" onchange="filterData();  createGraph();">

            <option value="1">Last 1 Day</option>
            <option value="7" >Last 1 Week</option> <!-- Default value: Last 1 Week -->
            <option value="30" selected>Last 1 Month</option>
        </select>
    </div>

    <!-- Transfers Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Transfers</h3>
        </div>
    <div class="card-body">
    <table class="table" id="transfersTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cash to Cash</th>
            <th>Bank to Bank</th>
            <th>Transfer Details</th>
            <th>Created Date</th>
            <th>Action</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

    @foreach($transfers->sortByDesc('transfer_date') as $transfer)
        <tr data-created="{{ $transfer->transfer_date }}">
            <td>{{ $transfer->id }}</td>
            <td>{{ $transfer->cash_to_cash == 0 ? '-' : 'Rs.' . number_format($transfer->cash_to_cash, 2) }}</td>
            <td>{{ $transfer->bank_to_bank == 0 ? '-' : 'Rs.' . number_format($transfer->bank_to_bank, 2) }}</td>
            <td>{{ $transfer->transfer_details }}</td>
            <td>{{ $transfer->transfer_date }}</td>
            <td>
                <button class="btn btn-success btn-download" onclick="downloadPDF('transfersTable', {{ $transfer->id }})">Download PDF</button>
                </td>
                <td>   
                <!-- Add the Delete button with form submission -->
                <form action="{{ route('financial.deleteTransfer', $transfer->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this transfer?')">Delete</button>
                </form>
            </td>                 
        </tr>
    @endforeach


</tbody>

</table>

    </div>
    </div>


    <!-- Custom Financial Entries Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Custom Financial Entries</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="customFinancialEntriesTable">
                <thead>
                    <tr>
                        <th>Entry ID</th>
                        <th>Details</th>
                        <th>Amount</th>
                        <th>Income</th>
                        <th>Expense</th>

                        <th class="d-none">Transaction</th>
                        <th>Created Date</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
    <!-- Loop to display custom financial entries dynamically -->
    @foreach ($customFinancialEntries->sortByDesc('entry_date') as $entry)
    <tr data-created="{{ $entry->entry_date }}" >
        <td>{{ $entry->id }}</td>
        <td>{{ $entry->details }}</td>
        <td>Rs.{{ $entry->amount }}</td>
        <td>{{ $entry->is_income ? 'Yes' : 'No' }}</td>
        <td>{{ $entry->is_expense ? 'Yes' : 'No' }}</td>
        <td class="d-none">{{ $entry->is_transaction ? 'Yes' : 'No' }}</td>
        <td>{{ $entry->entry_date }}</td>
        <td>

            <button class="btn btn-success btn-download" onclick="downloadPDF('customFinancialEntry', {{ $entry->id }})">Download PDF</button>
            <a href="{{ route('financial.editCustomFinancialEntry', $entry->id) }}" class="btn btn-warning">Edit</a>

        </td>
        

        

        <td>
                <!-- Delete Custom Financial Entry -->
                <form action="{{ route('financial.deleteCustomFinancialEntry', $entry->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
                </form>
            </td>

    </tr>
@endforeach

</tbody>

            </table>
        </div>
    </div>

    <!-- Income Details Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Income Details</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="incomeDetailsTable">
                <thead>
                    <tr>
                        <th>Income ID</th>
                        <th>Income Salary</th>
                        <th>Income Investment</th>
                        <th>Income Details</th>
                        <th>Created Date</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
    <!-- Loop to display income data dynamically -->
    <tbody>
    <!-- Loop to display income data dynamically -->
    @foreach ($incomeDetails->sortByDesc('income_date') as $income)
        <tr data-created="{{ $income->income_date }}">
            <td>{{ $income->id }}</td>
            <td>{{ $income->income_salary == 0 ? '-' : 'Rs.' . $income->income_salary }}</td>
            <td>{{ $income->income_investment == 0 ? '-' : 'Rs.' . $income->income_investment }}</td>
            <td>{{ $income->income_details }}</td>
            <td>{{ $income->income_date }}</td>
            <td>
                
                <button class="btn btn-success btn-download" onclick="downloadPDF('incomeDetail', {{ $income->id }})">Download PDF</button>
                <a href="{{ route('financial.editIncomeDetail', $income->id) }}" class="btn btn-warning">Edit</a>
            </td>
            <td>
            <form action="{{ route('financial.deleteIncomeDetail', $income->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this income detail?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

</tbody>

            </table>
        </div>
    </div>

    <!-- Expenses Details Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Expenses Details</h3>
        </div>
        <div class="card-body">
        <table class="table table-striped" id="expensesDetailsTable">
    <thead>
        <tr>
            <th>Expense ID</th>
            <th>Details</th>
            <th>Transportation</th>
            <th>Fooding</th>
            <th>Refreshment</th>
            <th>Shopping</th>
            <th>Created Date</th>
            <th>Action</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loop to display expense data dynamically -->
        @foreach ($expenses->sortByDesc('expense_date') as $expense)
            <tr data-created="{{ $expense->expense_date }}">
                <td>{{ $expense->id }}</td>
                <td>{{ $expense->details }}</td>
                <td>{{ $expense->expenses_transportation == 0 ? '-' : 'Rs.' . $expense->expenses_transportation }}</td>
                <td>{{ $expense->expenses_fooding == 0 ? '-' : 'Rs.' . $expense->expenses_fooding }}</td>
                <td>{{ $expense->expenses_refreshment == 0 ? '-' : 'Rs.' . $expense->expenses_refreshment }}</td>
                <td>{{ $expense->expenses_shopping == 0 ? '-' : 'Rs.' . $expense->expenses_shopping }}</td>
                <td>{{ $expense->expense_date }}</td>
                <td>
                    <button class="btn btn-success btn-download" onclick="downloadPDF('expense', {{ $expense->id }})">Download PDF</button>
                    <a href="{{ route('financial.editExpense', $expense->id) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <!-- Delete Expense -->
                    <form action="{{ route('financial.deleteExpense', $expense->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this expense?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    
        </div>
    </div>

    </section>




</div> <!-- End of container -->


<script>
// Function to filter table data based on selected duration
function filterData() {
    const filterValue = document.getElementById('durationFilter').value;
    const today = new Date();
    const filterDate = new Date(today.setDate(today.getDate() - filterValue));

    // Loop through each table row for each section and apply filter
    const sections = ['#transfersTable', '#customFinancialEntriesTable', '#incomeDetailsTable', '#expensesDetailsTable'];

    sections.forEach(tableId => {
        const rows = document.querySelectorAll(`${tableId} tbody tr`);
        rows.forEach(row => {
            const createdDate = new Date(row.getAttribute('data-created'));

            // Show row if it matches the filter condition
            if (createdDate >= filterDate ) {
                row.style.display = ''; // Display row
            } else {
                row.style.display = 'none'; // Hide row
            }
        });
    });
    createGraphs();
}

// Call filterData on page load to apply the default filter
window.onload = function() {
    filterData();
};


    window.userId = "{{ auth()->user()->id }}";  // Laravel user ID to JavaScript
    window.userEmail = "{{ auth()->user()->email }}";  // Laravel user email to JavaScript
    window.userName = "{{ auth()->user()->name }}";  // Laravel user email to JavaScript
   


function downloadPDF(type, id) {
    // Get the row containing the clicked button
    const row = event.target.closest('tr');
    const table = row.closest('table');
    
    // Extract the table headers dynamically, skipping the last header
    const headers = Array.from(table.querySelectorAll('thead th')).map((header, index) => {
        // Skip the last header column
        if (index !== table.querySelectorAll('thead th').length - 1) {
            return header.innerText;
        }
    }).filter(Boolean);  // Remove undefined values (for the skipped header)

    // Extract the row data for the clicked row, excluding the last cell (delete button)
    const data = Array.from(row.cells)
        .filter((cell, index) => index !== row.cells.length - 1)  // Skip the last cell (delete button)
        .map(cell => cell.innerText);

    // Get the current timestamp
    const currentTimestamp = new Date().toLocaleString();

    // Access the user ID and email from the script passed from Laravel
    const userId = window.userId;  // Get the user ID passed from Laravel
    const userEmail = window.userEmail;  // Get the user email passed from Laravel

    // Generate the PDF document using jsPDF
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Add "Mero Khutruke" at the top
    doc.setFontSize(16); // Set a larger font size for the title
    doc.text('Mero Khutruke', 10, 10);

    // Add a title for the PDF (below "Mero Khutruke")
    doc.setFontSize(12);  // Reset font size for the type title
    doc.text(`${type} PDF`, 10, 20);

    // Starting Y position for text (after the title)
    let yPosition = 30;

    // Loop through headers and corresponding row data to display in the PDF
    headers.forEach((header, index) => {
        doc.text(`${header}: ${data[index]}`, 10, yPosition); // Add header and its corresponding data
        yPosition += 10; // Move Y position down for the next header
    });

    // Add user info and timestamp at the bottom of the PDF
    yPosition += 10; // Add some space before the user info section
    doc.text(`Generated By UserId: ${userId}`, 10, yPosition);
    yPosition += 10;
    doc.text(`Generated By Username: ${userName}`, 10, yPosition);
    yPosition += 10;
    doc.text(`User Email: ${userEmail}`, 10, yPosition);
    yPosition += 10;
    doc.text(`Timestamp: ${currentTimestamp}`, 10, yPosition);
    yPosition += 10;

    // Decrease the font size to 8 (or any other size you prefer)
    doc.setFontSize(8);
    doc.text('Please Keep Your PDF Save and Secure. It may contain sensitive information. Mero Khutruke: Takes no responsibility further. Thanks!', 5, yPosition);

    // Save the PDF with the file name as type + id
    doc.save(`${type}_${id}.pdf`);
}


</script>


<script>
function getCustomFinancialData() {
    const rows = document.querySelectorAll('#customFinancialEntriesTable tbody tr');
    let customIncome = 0;
    let customExpense = 0;
    let customTransaction = 0;

    rows.forEach(row => {
        if (row.style.display !== 'none') { // Only include visible rows
            const amount = parseFloat(row.cells[1].innerText.replace('Rs.', '').trim()) || 0;
            const isIncome = row.cells[2].innerText.trim() === '1'; // Check if the income column is 1
            const isExpense = row.cells[3].innerText.trim() === '1'; // Check if the expense column is 1
            const isTransaction = row.cells[5].innerText.trim() === '1'; // Check if it's a transaction

            if (isIncome) customIncome += amount; // Add to custom income if it's marked as income
            if (isExpense) customExpense += amount; // Add to custom expense if it's marked as expense
            if (isTransaction) customTransaction += amount; // Add to custom transaction if it's marked as transaction
        }
    });

    return { customIncome, customExpense, customTransaction };
}


function createGraphs() {
    // Prepare data for the Pie Chart
   
    const incomeRows = document.querySelectorAll('#incomeDetailsTable tbody tr');
    const incomeSalary = Array.from(incomeRows).reduce((sum, row) => {
        if (row.style.display !== 'none') { // Only include visible rows
            sum += parseFloat(row.cells[1].innerText.replace('Rs.', '')) || 0;
        }
        return sum;
    }, 0);

    const incomeInvestment = Array.from(incomeRows).reduce((sum, row) => {
        if (row.style.display !== 'none') {
            sum += parseFloat(row.cells[2].innerText.replace('Rs.', '')) || 0;
        }
        return sum;
    }, 0);

    const expenseRows = document.querySelectorAll('#expensesDetailsTable tbody tr');
    const expensesTotal = Array.from(expenseRows).reduce((sum, row) => {
        if (row.style.display !== 'none') {
            sum += ['2', '3', '4', '5'].reduce((subSum, colIndex) => 
                subSum + (parseFloat(row.cells[colIndex].innerText.replace('Rs.', '')) || 0), 0);
        }
        return sum;
    }, 0);

    // Get custom financial data
    const { customIncome, customExpense, customTransaction } = getCustomFinancialData();

    // Pie Chart: Income vs Expenses vs Custom Financial Data
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Income Salary', 'Income Investment', 'Expenses', 'Custom Income', 'Custom Expense', 'Custom Transactions'],
            datasets: [{
                data: [incomeSalary, incomeInvestment, expensesTotal, customIncome, customExpense, customTransaction],
                backgroundColor: ['#4caf50', '#2196f3', '#f44336', '#ff9800', '#9c27b0', '#00bcd4']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
        }
    });

// Prepare data for the Bar Chart
const transferRows = document.querySelectorAll('tr'); // Select all rows in the table
let cashToCash = 0;
let bankToBank = 0;

transferRows.forEach(row => {
    if (row.style.display !== 'none') {
        const cashToCashValue = parseFloat(row.cells[1]?.innerText.replace('Rs.', '').trim()) || 0;
        const bankToBankValue = parseFloat(row.cells[2]?.innerText.replace('Rs.', '').trim()) || 0;

        cashToCash += cashToCashValue;
        bankToBank += bankToBankValue;
    }
});

// Create the bar chart
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Cash to Cash', 'Bank to Bank'],
        datasets: [{
            label: 'Amount in Rs.',
            data: [cashToCash, bankToBank],
            backgroundColor: ['#4caf50', '#2196f3'],
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
}

</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Link to Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
</x-app-layout>
