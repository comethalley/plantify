@include('templates.header')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-e5WfKVfL25ax9BJ0zVs53XnmtoM3veeUGJNV5iFFeVOq82kV4ky4R5p5ocD9z/L" crossorigin="anonymous"></script>
</head>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Expense Tracker</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Expense Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6" hidden>
                @if ($userRoleId != 3)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Dynamic Loaded Chart</h4>
                        </div>

                        <div class="card-body">
                            <div id="dynamicloadedchart-wrap" dir="ltr">
                                <div id="chart-year" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-body-color", "--vz-info"]' class="apex-charts"></div>
                                <div id="chart-quarter" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12" hidden>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Expense Tracker</h4>
                        </div>

                        <div class="card-body">
                            <div id="column_distributed" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-dark", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Your "Add Budget" button -->
            <div class="row g-4 mb-3">
                <div class="col-sm-auto order-sm-2 mb-1 ms-auto me-3"> <!-- Align to the right -->
                    <form id="filterForm" class="d-flex align-items-center">
                        <select class="form-select me-2" id="budgetMonth" name="month">
                            <option value="" disabled selected>Select Month</option>
                            @foreach ($months as $month)
                                <option value="{{ $month }}" {{ \Carbon\Carbon::now()->format('F') === $month ? 'selected' : '' }}>
                                    {{ $month }}
                                </option>
                            @endforeach
                        </select>
                        <select class="form-select me-2" id="budgetYear" name="year">
                            <option value="" disabled selected>Select Year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ \Carbon\Carbon::now()->format('Y') === $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="col-sm-auto order-sm-1"> <!-- Align to the left -->
                    @if ($userRoleId != 2)
                    <button type="button" class="btn btn-primary" onclick="openAddBudgetModal()">
                        Add Budget
                    </button>
                    @endif
                </div>
            </div>

            <!-- Add Budget Modal -->
            @if($userRoleId == 3 && $farm)
            <div class="modal fade" id="addBudgetModal" tabindex="-1" aria-labelledby="addBudgetModalLabel" aria-hidden="true">
                <div class="modal-dialog" id="dialogBox">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBudgetModalLabel">Add Allotted Budget</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add-budget-form" id="addBudgetForm" action="/expenses/add-budget" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="farmName" class="form-label">Farm Name</label>
                                    <input type="text" class="form-control" id="farmName" name="farm_name" value="{{ $farm->first()->farm_name }}" data-farm-id="{{ $farm->first()->id }}" readonly>
                                    <input type="hidden" id="farm_id" name="farm_id" value="{{ $farm->first()->id }}">
                                </div>

                                <div class="mb-3">
                                    <label for="budgetAmount" class="form-label">Budget Amount</label>
                                    <input type="number" class="form-control" id="budgetAmount" name="allotted_budget" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="budgetMonth" class="form-label">Month</label>
                                    <select class="form-select me-2" id="budgetMonth">
                                        <option value="" disabled>Select Month</option>
                                        @foreach ($months as $month)
                                            <option value="{{ $month }}" {{ \Carbon\Carbon::now()->format('F') === $month ? '' : 'disabled' }}>
                                                {{ $month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Add Budget</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

            
            <div class="row">
                <div class="col-xl-12">
                    <div class="d-flex flex-column h-100">
                        <div class="row">
                            <div class="col-xl-4 col-md-9">
                                <div class="card card-animate overflow-hidden">
                                    <div class="position-absolute start-0" style="z-index: 0;">
                                        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                            <style>
                                                .s0 {
                                                    opacity: .05;
                                                    fill: var(--vz-success)
                                                }
                                            </style>
                                            <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                                        </svg>
                                    </div>
                                    <div class="card-body" style="z-index:1;">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> Allotted Budget</p>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                                    <span id="allottedBudget" class="counter-value" data-target="{{ $allottedBudget ?? '0' }}">
                                                        {{ $allottedBudget ?? '0' }}
                                                    </span>
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div id="total_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-animate overflow-hidden">
                                    <div class="position-absolute start-0" style="z-index: 0;">
                                        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                            <style>
                                                .s0 {
                                                    opacity: .05;
                                                    fill: var(--vz-success)
                                                }
                                            </style>
                                            <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                                        </svg>
                                    </div>
                                    <div class="card-body" style="z-index:1 ;">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> Balance</p>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                                    <span id="balance" class="counter-value" data-target="{{ $balance ?? '0' }}">
                                                        {{ $balance ?? '0' }}
                                                    </span>
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div id="apply_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-animate overflow-hidden">
                                    <div class="position-absolute start-0" style="z-index: 0;">
                                        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                            <style>
                                                .s0 {
                                                    opacity: .05;
                                                    fill: var(--vz-success)
                                                }
                                            </style>
                                            <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                                        </svg>
                                    </div>
                                    <div class="card-body" style="z-index:1;">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Expenses</p>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                                    <span id="totalExpenses" class="counter-value" data-target="{{ $totalExpenses ?? '0' }}">
                                                        {{ $totalExpenses ?? '0' }}
                                                    </span>
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div id="new_jobs_chart" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">List of Expenses</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    @if ($userRoleId != 2)
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addModal">
                                                <i class="ri-add-line align-bottom me-1"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto">
                                        <select class="form-select" id="expenseCategory">
                                            <option value="">All Categories</option>
                                            @foreach($farmCategory as $categories)
                                                <option value="{{ $categories->id }}">{{ $categories->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                </div>
                                
                                
                                
                                <!-- Modal -->
                                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" id="dialogBox">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">Add Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="add-expense-form" id="addExpenseForm" action="/expenses/save-expense" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <select class="form-select" id="category" name="category">
                                                            <option value="">Select Category</option>
                                                            @foreach($farmCategory as $category)
                                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3" id="descriptionInput" style="display: none;">
                                                        <label for="description" class="form-label">Description</label>
                                                        <input type="text" class="form-control" id="description" placeholder="Enter description">
                                                    </div>

                                                    <div class="mb-3" id="previousInput" style="display: none;">
                                                        <label for="previous" class="form-label">Previous</label>
                                                        <input type="number" class="form-control" id="previous">
                                                    </div>

                                                    <div class="mb-3" id="currentInput" style="display: none;">
                                                        <label for="current" class="form-label">Current</label>
                                                        <input type="number" class="form-control" id="current">
                                                    </div>

                                                    <div class="mb-3" id="kwhInput" style="display: none;">
                                                        <label for="kwh" class="form-label">Kilo Watt per Hour</label>
                                                        <input type="number" class="form-control" id="kwh">
                                                    </div>

                                                    <div class="mb-3" id="rateInput" style="display: none;">
                                                        <label for="rate" class="form-label">Rate</label>
                                                        <input type="number" class="form-control" id="rate">
                                                    </div>

                                                    <div class="mb-3" id="totalAmount" style="display: none;">
                                                        <label colspan="3"  for="total" class="form-label">Total Amount</label>
                                                        <label colspan="2"  type="number" class="form-control" id="total" style="color: black; font-weight: bold; font-size: 10pt; padding-top: 5px; padding-bottom: 5px;">0.00</label>
                                                    </div>

                                                    <div class="mb-3" id="amountInput" style="display: none;">
                                                        <label for="amount" class="form-label">Amount</label>
                                                        <input type="number" class="form-control" id="amount" placeholder="Enter amount">
                                                    </div>

                                                    <!-- Image Upload Input -->
                                                    <div class="mb-3" id="imageInput" style="display: none;">
                                                        <label for="image" class="form-label">Upload Image</label>
                                                        <input type="file" class="form-control" id="image" accept="image/*">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="saveItemButton">Save Item</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;"></th>
                                                <th class="sort" data-sort="description">Description</th>
                                                <th class="sort" data-sort="amount" style="width: 20%;">Amount</th>
                                                <th class="sort" data-sort="image" style="width: 10%;">Image</th>
                                                <!-- <th class="sort" data-sort="action" style="width: 20%;">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach($expenses as $expense)
                                                <tr data-expense-id="{{ $expense->id }}">
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <!-- <input class="form-check-input" type="checkbox" name="chk_child" value="option1"> -->
                                                        </div>
                                                    </th>
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#{{ $expense->farm_id }}</a></td>
                                                    <td class="description">{{ $expense->description }}</td>
                                                    <td class="amount">{{ $expense->amount }}</td>
                                                    <td class="image">
                                                        @if($expense->image_path)
                                                            <img src="{{ $expense->image_path }}" alt="Expense Image" style="max-width: 100px;">
                                                        @else
                                                            No Image
                                                        @endif
                                                    </td>
                                                    <!-- <td>
                                                        <div class="d-flex gap-2">
                                                            @if ($userRoleId != 2)
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn" onclick="editExpenseModal(this.closest('tr'))">Edit</button>
                                                            </div>
                                                            <div class="remove">
                                                                <button class="btn btn-sm btn-danger remove-item-btn" onclick="removeExpense(this.closest('tr'))">Remove</button>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </td> -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0);">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('templates.footer')


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('js/your-script.js') }}"></script>


<!-- JAVASCRIPT -->

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js"></script>

<!-- apexcharts init -->
<script src="assets/js/pages/apexcharts-column.init.js"></script>

<!-- expenses modal -->
<script>
    
    document.addEventListener('DOMContentLoaded', function () {

        var categorySelect = document.getElementById('category');
        var descriptionInput = document.getElementById('descriptionInput');
        var previousInput = document.getElementById('previousInput');
        var currentInput = document.getElementById('currentInput');
        var kwhInput = document.getElementById('kwhInput');
        var rateInput = document.getElementById('rateInput');
        var totalAmount = document.getElementById('totalAmount');
        var amountInput = document.getElementById('amountInput');
        var imageInput = document.getElementById('imageInput');

        function showInputsForCategory() {
            var selectedCategoryId = categorySelect.value;

            descriptionInput.style.display = 'none';
            previousInput.style.display = 'none';
            currentInput.style.display = 'none';
            kwhInput.style.display = 'none';
            rateInput.style.display = 'none';
            totalAmount.style.display = 'none';
            amountInput.style.display = 'none';
            imageInput.style.display = 'none';

            if (selectedCategoryId === '1') {
                previousInput.style.display = 'block';
                currentInput.style.display = 'block';
                kwhInput.style.display = 'block';
                totalAmount.style.display = 'block';
                imageInput.style.display = 'block';
            } else if (selectedCategoryId === '2') {
                previousInput.style.display = 'block';
                currentInput.style.display = 'block';
                rateInput.style.display = 'block';
                totalAmount.style.display = 'block';
                imageInput.style.display = 'block';
            } else if (selectedCategoryId === '3' || selectedCategoryId === '4') {
                descriptionInput.style.display = 'block';
                amountInput.style.display = 'block';
                imageInput.style.display = 'block';
            }
        }

        showInputsForCategory();
        categorySelect.addEventListener('change', showInputsForCategory);
    });

    document.addEventListener('DOMContentLoaded', function () {
    var categorySelect = document.getElementById('category');
    var descriptionInput = document.getElementById('description');
    var amountInput = document.getElementById('amount');
    var previousInput = document.getElementById('previous');
    var currentInput = document.getElementById('current');
    var kwhInput = document.getElementById('kwh');
    var rateInput = document.getElementById('rate');
    var imageInput = document.getElementById('image');

    function calculateTotalAmount() {
        var category = categorySelect.value;
        var previous = parseFloat(previousInput.value) || 0;
        var current = parseFloat(currentInput.value) || 0;
        var kwh = parseFloat(kwhInput.value) || 0;
        var rate = parseFloat(rateInput.value) || 0;
        var total = 0;

        if (category === '1') {
            if (previous > current) {
                total = (previous - current) * kwh;
                total = Math.abs(total);
            } else {
                total = (current - previous) * kwh;
            }
        } else if (category === '2') {
            if (previous > current) {
                total = (previous - current) * rate;
                total = Math.abs(total);
            } else {
                total = (previous - current) * rate;
            }
        } else {
            total = parseFloat(amountInput.value) || 0;
        }

        total = Math.abs(total);

        document.getElementById('total').textContent = total.toFixed(2);
    }

    $('#previous, #current, #kwh, #rate, #amount').on('input', calculateTotalAmount);

    categorySelect.addEventListener('change', function () {
        var categoryId = categorySelect.value;
        var farmId = document.getElementById('farm_id').value;

        if (categoryId === '1' || categoryId === '2') {
            fetch('/expenses/get-last-amount?farm_id=' + farmId + '&category_id=' + categoryId)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        previousInput.value = data.lastAmount;
                        if (data.lastAmount !== null && data.lastAmount !== '') {
                            previousInput.disabled = true;
                        } else {
                            previousInput.disabled = false;
                        }
                        calculateTotalAmount();
                    } else {
                        console.error('Failed to fetch last amount:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching last amount:', error);
                });
        }
    });

    // Function to save new expense item
    function saveNewItem() {
        var formData = new FormData();
        var farmId = document.getElementById('farm_id').value;
        var categoryId = categorySelect.value;
        var description = '';
        var totalAmount = parseFloat(document.getElementById('total').textContent);
        var currentReading = 0;

        if (categoryId === '1') { // Electricity
            var previous = parseFloat(previousInput.value);
            currentReading = parseFloat(currentInput.value);
            var kwh = parseFloat(kwhInput.value);
            description = 'Electricity';
            formData.append('previous', previous);
            formData.append('current', currentReading);
            formData.append('kwh', kwh);
        } else if (categoryId === '2') { // Water
            var previous = parseFloat(previousInput.value);
            currentReading = parseFloat(currentInput.value);
            var rate = parseFloat(rateInput.value);
            description = 'Water';
            formData.append('previous', previous);
            formData.append('current', currentReading);
            formData.append('rate', rate);
        } else { // Other categories
            description = descriptionInput.value;
        }

        formData.append('farm_id', farmId);
        formData.append('category_id', categoryId);
        formData.append('description', description);
        formData.append('current_rdg', currentReading);
        formData.append('amount', totalAmount);
        formData.append('image', imageInput.files[0]);

        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/expenses/save-expense', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Expense saved successfully:', data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Expense Saved!',
                        text: 'Your expense has been saved successfully.',
                        confirmButtonColor: '#57AA2C',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Reload page after saving expense
                        $('#addModal').modal('hide'); // Hide modal
                    });
                } else {
                    console.error('Failed to save expense:', data.message);
                    if (data.message) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while saving the expense. Please try again later.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            });
    }

    document.getElementById('saveItemButton').addEventListener('click', saveNewItem);
});



    function showDialog(message, type) {
        var dialogClass = type === 'success' ? 'alert-success' : 'alert-danger';
        var dialogHtml = '<div class="alert ' + dialogClass + ' alert-dismissible fade show" role="alert">' +
                            message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';
        $('#dialogBox').html(dialogHtml);
        setTimeout(function() {
            $('#dialogBox').html('');
        }, 5000);
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        function populateExpenseTable(farmId, categoryId = null) {
            $.ajax({
                type: 'GET',
                url: '/expenses/get-expenses-by-category',
                data: {
                    farm_id: farmId,
                    category_id: categoryId
                },
                success: function(response) {
                    if (response.length > 0) {
                        var expenseTableBody = $('#customerTable tbody');
                        expenseTableBody.empty();

                        response.forEach(function(expense) {
                            var imageHtml = expense.image_path ? '<img src="' + expense.image_path + '" alt="Expense Image" style="max-width: 100px;">' : 'No Image';
                            var rowHtml = '<tr data-expense-id="' + expense.id + '">' +
                                            '<td scope="row">' +
                                                '<div class="form-check"></div>' +
                                            '</td>' +
                                            '<td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#' + expense.farm_id + '</a></td>' +
                                            '<td class="description">' + expense.description + '</td>' +
                                            '<td class="amount">' + expense.amount + '</td>' +
                                            '<td class="image">' + imageHtml + '</td>' +
                                        '</tr>';
                            expenseTableBody.append(rowHtml);
                        });
                    } else {
                        console.log('No expenses found for the selected category.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching expenses:', error);
                }
            });
        }

        var categorySelect = document.getElementById('expenseCategory');

        categorySelect.addEventListener('change', function () {
            var categoryId = categorySelect.value;
            var farmId = document.getElementById('farm_id').value;

            populateExpenseTable(farmId, categoryId);
        });

        var initialCategoryId = categorySelect.value;
        var initialFarmId = document.getElementById('farm_id').value;
        populateExpenseTable(initialFarmId, initialCategoryId);
    });
</script>


<!-- Budget JavaScript -->
<script>
    function openAddBudgetModal() {
        $('#addBudgetModal').appendTo('body').modal('show');
    }

    document.getElementById('addBudgetForm').addEventListener('submit', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure you want to add this budget?',
            text: 'Make sure all information is correct before submitting as changes cannot be made later.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4CAF50',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the selected month value
                var month = document.getElementById('budgetMonth').value;
                // Create an object to hold form data
                var formData = {
                    farm_id: $('#farm_id').val(),
                    allotted_budget: $('#budgetAmount').val(),
                    month: month // Include the selected month
                };

                // Send an AJAX request
                $.ajax({
                    url: '/expenses/add-budget',
                    type: 'POST',
                    data: formData, // Send the form data object
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            console.log('Budget added successfully:', data);
                            updateUI(data); 
                            $('#addBudgetModal').modal('hide');
                            reloadDashboardData();
                        } else {
                            console.error('Failed to add budget:', data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                console.log('Budget addition canceled.');
            }
        });
    });


    function updateUI(data) {
        document.getElementById('allottedBudget').innerText = data.allotted_budget;
    }

    function reloadDashboardData() {
        var farmId = $('#farm_id').val();
        if (farmId !== '') {
            $.ajax({
                url: '/expenses/get-dashboard-data',
                type: 'GET',
                data: { farm_id: farmId },
                success: function (response) {
                    $('#allottedBudget').text(response.allottedBudget);
                    $('.counter-value[data-target="{{ $balance }}"]').text(response.balance);
                    $('.counter-value[data-target="{{ $totalExpenses }}"]').text(response.totalExpenses);
                },
                error: function () {
                    alert('Error fetching dashboard data.');
                }
            });
        }
    }

    $(document).ready(function () {
        reloadDashboardData();
    });

    $(document).ready(function() {
        $('#filterForm').submit(function(event) {
            event.preventDefault();

            var month = $('#budgetMonth').val();
            var year = $('#budgetYear').val();

            if (!month || !year) {
                alert('Please select both month and year.');
                return;
            }

            // Convert month string to its numerical value
            var monthNumber = getMonthNumber(month);

            $.ajax({
                type: 'GET',
                url: '/expenses/get-dashboard-data',
                data: {
                    farm_id: $('#farm_id').val(),
                    month: monthNumber, // Send the numerical month value
                    year: year
                },
                success: function(response) {
                    if (response.success) {
                        $('#allottedBudget').text(response.allottedBudget);
                        $('#balance').text(response.balance);
                        $('#totalExpenses').text(response.totalExpenses);
                    } else {
                        alert(response.message); // Display the error message from the server
                        $('#allottedBudget').text('0');
                        $('#balance').text('0');
                        $('#totalExpenses').text('0');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Error fetching budget data. Please try again.');
                }
            });
        });
    });

    // Function to convert month string to numerical value
    function getMonthNumber(monthString) {
        var months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        return months.indexOf(monthString) + 1;
    }

</script>