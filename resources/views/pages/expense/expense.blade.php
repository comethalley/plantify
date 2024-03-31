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
            
            <!-- Your existing "Add Budget" button -->
            <div class="d-flex align-items-center">
                @if ($userRoleId != 2)
                <div class="flex-shrink-0 mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBudgetModal">
                        Add Budget
                    </button>
                </div>
                @endif
            </div>

            <!-- Add Budget Modal -->
            @if($userRoleId == 3 && $farm)
            <div class="modal fade" id="addBudgetModal" tabindex="-1" aria-labelledby="addBudgetModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBudgetModalLabel">Add Allotted Budget</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add-budget-form" id="addBudgetForm" action="/expenses/add-budget" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <select class="form-select" id="farm_id" name="farm_id">
                                        @foreach($farm as $per_farm)
                                            <option value="{{ $per_farm->id }}" data-farm-id="{{ $per_farm->id }}">{{ $per_farm->farm_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="budgetAmount" class="form-label">Budget Amount</label>
                                    <input type="number" class="form-control" id="budgetAmount" name="allotted_budget" required>
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
                                                    <span class="counter-value" data-target="{{ $balance ?? '0' }}">
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
                                                    <span class="counter-value" data-target="{{ $totalExpenses }}">
                                                        {{ $totalExpenses }}
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
                                    @endif
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
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
                                                <button type="button" class="btn btn-primary" onclick="saveNewItem()">Save Item</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Expense Modal -->
                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" id="editDialogBox">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="edit-expense-form" id="editExpenseForm" action="{{ url('/expenses/update-expense') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="editCategory" class="form-label">Category</label>
                                                        <select class="form-select" id="editCategory" name="category">
                                                            <option value="">Select Category</option>
                                                            @foreach($farmCategory as $category)
                                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3" id="editDescriptionInput" style="display: none;">
                                                        <label for="editDescription" class="form-label">Description</label>
                                                        <input type="text" class="form-control" id="editDescription" placeholder="Enter description">
                                                    </div>

                                                    <div class="mb-3" id="editPreviousInput" style="display: none;">
                                                        <label for="editPrevious" class="form-label">Previous</label>
                                                        <input type="number" class="form-control" id="editPrevious">
                                                    </div>

                                                    <div class="mb-3" id="editCurrentInput" style="display: none;">
                                                        <label for="editCurrent" class="form-label">Current</label>
                                                        <input type="number" class="form-control" id="editCurrent">
                                                    </div>

                                                    <div class="mb-3" id="editKwhInput" style="display: none;">
                                                        <label for="editKwh" class="form-label">Kilo Watt per Hour</label>
                                                        <input type="number" class="form-control" id="editKwh">
                                                    </div>

                                                    <div class="mb-3" id="editTotalAmount" style="display: none;">
                                                        <label colspan="3" for="editTotal" class="form-label">Total Amount</label>
                                                        <label colspan="2" type="number" class="form-control" id="editTotal"
                                                            style="color: black; font-weight: bold; font-size: 10pt; padding-top: 5px; padding-bottom: 5px;">
                                                            0.00</label>
                                                    </div>

                                                    <div class="mb-3" id="editAmountInput" style="display: none;">
                                                        <label for="editAmount" class="form-label">Amount</label>
                                                        <input type="number" class="form-control" id="editAmount" placeholder="Enter amount">
                                                    </div>

                                                    <!-- Image Upload Input -->
                                                    <div class="mb-3" id="editImageInput" style="display: none;">
                                                        <label for="editImage" class="form-label">Upload Image</label>
                                                        <input type="file" class="form-control" id="editImage" accept="image/*">
                                                    </div>

                                                    <input type="hidden" id="editExpenseId" name="expense_id">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="editExpense()">Save Changes</button>
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
                                                <th class="sort" data-sort="action" style="width: 20%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach($expenses as $expense)
                                                <tr data-expense-id="{{ $expense->id }}">
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
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
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn" onclick="editExpenseModal(this.closest('tr'))">Edit</button>
                                                            </div>
                                                            <div class="remove">
                                                                <button class="btn btn-sm btn-danger remove-item-btn" onclick="removeExpense(this.closest('tr'))">Remove</button>
                                                            </div>
                                                        </div>
                                                    </td>
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
        var totalAmount = document.getElementById('totalAmount');
        var amountInput = document.getElementById('amountInput');
        var imageInput = document.getElementById('imageInput');

        function showInputsForCategory() {
            var selectedCategoryId = categorySelect.value;

            descriptionInput.style.display = 'none';
            previousInput.style.display = 'none';
            currentInput.style.display = 'none';
            kwhInput.style.display = 'none';
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

    function saveNewItem() {
        var categorySelect = document.getElementById('category');
        var descriptionInput = document.getElementById('description');
        var amountInput = document.getElementById('amount');
        var previousInput = document.getElementById('previous');
        var currentInput = document.getElementById('current');
        var kwhInput = document.getElementById('kwh');
        var imageInput = document.getElementById('image');
        var farmId = document.getElementById('farm_id').value; // Get the selected farm_id
        var categoryId = categorySelect.value;
        var description = '';
        var totalAmount = 0;
        var formData = new FormData();

        if (categoryId === '1') { // Electricity
            var previous = parseFloat(previousInput.value);
            var current = parseFloat(currentInput.value);
            var kwh = parseFloat(kwhInput.value);
            totalAmount = (previous - current) * kwh;
            description = 'Electricity';
            formData.append('previous', previous);
            formData.append('current', current);
            formData.append('kwh', kwh);
        } else if (categoryId === '2') { // Water
            var previous = parseFloat(previousInput.value);
            var current = parseFloat(currentInput.value);
            totalAmount = previous + current;
            description = 'Water';
            formData.append('previous', previous);
            formData.append('current', current);
        } else { // Seeds and Others
            description = descriptionInput.value;
            totalAmount = amountInput.value;
        }

        formData.append('farm_id', farmId); // Append the farm_id to the form data
        formData.append('category', categoryId);
        formData.append('description', description);
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
                location.reload();
                appendExpenseToTable(data);
                $('#addModal').modal('hide');
            } else {
                console.error('Failed to save expense:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function calculateTotalAmount() {
        var categorySelect = document.getElementById('category');
        var previousInput = document.getElementById('previous').value;
        var currentInput = document.getElementById('current').value;
        var kWhInput = document.getElementById('kwh').value;

        if (categorySelect.value === '1') { // Electricity
            if (!isNaN(previousInput) && !isNaN(currentInput) && !isNaN(kWhInput)) {
                var difference = parseFloat(previousInput) - parseFloat(currentInput);
                var total = difference * kWhInput;
                document.getElementById('total').textContent = total.toFixed(2);
            } else {
                document.getElementById('total').textContent = 'Invalid input'; 
            }
        } else if (categorySelect.value === '2') { // Water
            if (!isNaN(previousInput) && !isNaN(currentInput)) {
                var total = parseFloat(previousInput) + parseFloat(currentInput);
                document.getElementById('total').textContent = total.toFixed(2);
            } else {
                document.getElementById('total').textContent = 'Invalid input';
            }
        }
    }

    $(document).ready(function() {
        $('#previous, #current, #kwh').on('input', calculateTotalAmount);
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

    // <!-- edit expense -->

    document.addEventListener('DOMContentLoaded', function () {
        
        var editCategorySelect = document.getElementById('editCategory');
        var editDescriptionInput = document.getElementById('editDescriptionInput');
        var editPreviousInput = document.getElementById('editPreviousInput');
        var editCurrentInput = document.getElementById('editCurrentInput');
        var editKwhInput = document.getElementById('editKwhInput');
        var editTotalAmount = document.getElementById('editTotalAmount');
        var editAmountInput = document.getElementById('editAmountInput');
        var editImageInput = document.getElementById('editImageInput');

        function showInputsForEditCategory(selectedCategoryId) {

            editDescriptionInput.style.display = 'none';
            editPreviousInput.style.display = 'none';
            editCurrentInput.style.display = 'none';
            editKwhInput.style.display = 'none';
            editTotalAmount.style.display = 'none';
            editAmountInput.style.display = 'none';
            editImageInput.style.display = 'none';

            if (selectedCategoryId === '1') { // Electricity
                editPreviousInput.style.display = 'block';
                editCurrentInput.style.display = 'block';
                editKwhInput.style.display = 'block';
                editTotalAmount.style.display = 'block';
                editImageInput.style.display = 'block';
            } else if (selectedCategoryId === '2') { // Water
                editPreviousInput.style.display = 'block';
                editCurrentInput.style.display = 'block';
                editTotalAmount.style.display = 'block';
                editImageInput.style.display = 'block';
            } else if (selectedCategoryId === '3' || selectedCategoryId === '4') { // Seeds and Others
                editDescriptionInput.style.display = 'block';
                editAmountInput.style.display = 'block';
                editImageInput.style.display = 'block';
            }
        }

        showInputsForEditCategory(editCategorySelect.value);
        
        editCategorySelect.addEventListener('change', function () {
            showInputsForEditCategory(editCategorySelect.value);
        });
    });

    function editExpenseModal(row) {
    if (confirm('Are you sure you want to edit this expense?')) {
        var expenseId = row.dataset.expenseId;
        var cells = row.cells;
        var categoryId = cells[1].textContent.trim();
        var description = cells[2].textContent.trim();
        var amount = cells[3].textContent.trim();

        // Populate the modal fields with expense data
        document.getElementById('editCategory').value = categoryId;
        document.getElementById('editDescription').value = description;
        document.getElementById('editAmount').value = amount;
        document.getElementById('editExpenseId').value = expenseId;

        $('#editModal').modal('show');
    }
}

// Function to handle editing expense
function editExpense() {
    var editForm = document.getElementById('editExpenseForm');
    var formData = new FormData(editForm);
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/expenses/update-expense', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Expense updated successfully:', data);
            location.reload(); // Optionally, update the expense in the table
            appendExpenseToTable(data);
            $('#editModal').modal('hide');
        } else {
            console.error('Failed to update expense:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

    function calculateEditTotalAmount() {
        var categorySelect = document.getElementById('editCategory');
        var editPreviousInput = parseFloat(document.getElementById('editPrevious').value);
        var editCurrentInput = parseFloat(document.getElementById('editCurrent').value);
        var editKwhInput = parseFloat(document.getElementById('editKwh').value);
        var editTotalElement = document.getElementById('editTotal');

        if (categorySelect.value === '1') {
            if (!isNaN(editPreviousInput) && !isNaN(editCurrentInput) && !isNaN(editKwhInput)) {
                var difference = editPreviousInput - editCurrentInput;
                var total = difference * editKwhInput;
                editTotalElement.textContent = total.toFixed(2);
            } else {
                editTotalElement.textContent = 'Invalid input'; 
            }
        } else if (categorySelect.value === '2') {
            if (!isNaN(editPreviousInput) && !isNaN(editCurrentInput)) {
                var total = editPreviousInput + editCurrentInput;
                editTotalElement.textContent = total.toFixed(2);
            } else {
                editTotalElement.textContent = 'Invalid input';
            }
        }
    }

    $(document).ready(function() {
        $('#editPrevious, #editCurrent, #editKwh').on('input', calculateEditTotalAmount);
    });

    function removeExpense(row) {
        if (confirm('Are you sure you want to remove this expense?')) {
            row.style.display = 'none';
        }
    }
</script>


<!-- Budget JavaScript -->
<script>
    document.getElementById('addBudgetForm').addEventListener('submit', function(event) {
        event.preventDefault();

        if (confirm('Are you sure you want to add this budget?')) {
            var formData = new FormData(this);

            fetch('/expenses/add-budget', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update the UI with the new budget data
                    console.log('Budget added successfully:', data);
                    updateUI(data); // Call function to update UI
                    $('#addBudgetModal').modal('hide');
                } else {
                    console.error('Failed to add budget:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            // User canceled the budget addition
            console.log('Budget addition canceled.');
        }
    });

    function updateUI(data) {
        document.getElementById('allottedBudget').innerText = data.allotted_budget;
    }
    
    $(document).ready(function () {
    $('#farm_id').change(function () {
        var farmId = $(this).val(); // Get the selected farm ID
        if (farmId !== '') {
            // Make AJAX request to fetch data for the selected farm
            $.ajax({
                url: '/expenses/get-dashboard-data',
                type: 'GET',
                data: { farm_id: farmId },
                success: function (response) {
                    // Update the displayed data with the response
                    $('#allottedBudget').text(response.allottedBudget);
                    $('.counter-value[data-target="{{ $balance }}"]').text(response.balance);
                    $('.counter-value[data-target="{{ $totalExpenses }}"]').text(response.totalExpenses);
                },
                error: function () {
                    alert('Error fetching dashboard data.');
                }
            });
        }
    });
});
</script>