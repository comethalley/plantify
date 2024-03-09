@include('templates.header')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tasks</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List Viewed</a></li>
                                <li class="breadcrumb-item active">Kanban Board</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
                                <!--end row-->
                                <!DOCTYPE html>
<html lang="en">

<head>
<script>
    $(document).ready(function() {
        $('#tasksTable').DataTable();
    });
</script>

    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include DataTables -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css"> -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <!-- Other meta tags and CSS links -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
<form>
    <!-- Your content here -->
    <br>
    <br>
    <!-- <div class="container text-center">
        

        <h2>Task List</h2> @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        Rest of your content -->
       
 

        <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Task list</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create</button>
                                        <!-- <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> -->
        
                                     <a href="{{ route('taskshow') }}" class="btn btn-primary bg-gradient
                                     waves-effect waves-light"></i>Show Complete Task</a>
                                     <a href="/missingtasks" class="btn btn-primary bg-gradient
                                     waves-effect waves-light"></i>Missing Task</a>
                                     <a href="/taskassign" class="btn btn-primary bg-gradient
                                     waves-effect waves-light"></i>My Task</a>
                                     <a href="{{ route('archived') }}" class="btn btn-primary bg-gradient
                                     waves-effect waves-light"></i>Show Archived Task</a>
                                     <!-- Vertical Variation -->
                                     <!-- Place the dropdown filter before the table -->
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" aria-expanded="false">
        All                                                               
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableOutside">
        <li><a class="dropdown-item" href="#" onclick="updateTable('All')">All</a></li>
        <li><a class="dropdown-item" href="#" onclick="updateTable('New')">New</a></li>
        <li><a class="dropdown-item" href="#" onclick="updateTable('Inprogress')">Inprogress</a></li>
        <li><a class="dropdown-item" href="#" onclick="updateTable('Pending')">Pending</a></li>
    </ul> 
</div> 

   
                                </div>                  
                            </div>
                        </div>
                     <div class="card-body border border-dashed border-end-0 border-start-0">
                        <table class="table table-nowrap align-middle" id="tasksTable">
     
                            <form>
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-6">
                                        <div class="search-box">
                                            <!-- <input type="text" class="form-control search" placeholder="Search for order ID, customer, order status or something...">
                                            <i class="ri-search-line search-icon"></i>         -->
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>
                        </div>                                                    
                        <div class="card-body pt-0">
                            <div>

                                <div class="table-responsive table-card mb-1">
                                    <table class="table table-nowrap align-middle" id="tasksTable">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">
                                            
                                                    <!-- <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div> -->          
                                                </th>
                                                <th class="sort" data_sort="id">ID</th>
                                                <th class="sort" data_sort="tittle">Title</th>
                                                <th class="sort" data_sort="description">Description</th>
                                                <th class="sort" data_sort="user_id">Assigned To</th>
                                                <th class="sort" data_sort="due_date">Due</th>
                                               <th class="sort" data_sort="priority">Priority</th>
                                               <th class="sort" data_sort="status">Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($tasks as $task)
            <tr class="task-row {{ strtolower(str_replace(' ', '-', $task->status)) }}">
                  <td class="id">#{{ $task->id }}</td>
    <td class="title">{{ $task->title }}</td>
    <td class="description">{{ $task->description }}</td>
    <td class="user_id">
        @if ($task->user)
            {{ $task->user->firstname }} {{ $task->user->lastname }}
        @else
            No User Assigned
        @endif
    </td> 
    <td class="due_date">{{ $task->due_date }}</td>
    <td class="priority">{{ $task->priority }}</td>
    <td class="status">{{ $task->status }}</td>
    <td>
        <!-- Edit task button -->
        <a href="#" class="btn btn-primary btn-sm task-edit"
           data-task-id="{{ $task->id }}"
           data-task-title="{{ $task->title }}"
           data-task-description="{{ $task->description }}"
           data-task-priority="{{ $task->priority }}"
           data-task-due_date="{{ $task->due_date }}"
           data-task-user_id="{{ $task->user_id }}"
           data-task-status="{{ $task->status }}">
            <i class="ri-pencil-fill fs-16"></i>
        </a>

        <!-- Archive task button -->
        @if (!$task->archived)
            <form action="{{ route('tasks.archive', $task->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Archive this task?')">
                    <i class="ri-delete-bin-5-fill fs-16"></i>
                </button>
            </form>
        @endif

        <!-- Complete task button -->
        @if (!$task->completed)
            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm">
                    <i class="ri-checkbox-circle-line fs-16"></i>
                </button>
            </form>
        @endif
    </td>
</tr>

@endforeach

            </tbody>
                                        

                                    </table>
                                  


     <!--Create Modal-->
     <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="/tasks/store" method="POST">
                @csrf
                <div class="modal-body">
                <input type="hidden" id="task_id" name="task_id" value="">
                    <!-- Hidden input for ID -->

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" required />
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Description" required />
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="due_date" class="form-label">Date and Time</label>
                        <input type="datetime-local" name="due_date" id="due_date" class="form-control" required />
                    </div>
                        <div class="col-md-6">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-control" id="priority" name="priority" required>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="s" name="status" required>
                                <option value="New">New</option>
                                <option value="Inprogress">Inprogress</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Assigned To</label>
                            <select name="user_id" class="form-control">
                            @foreach ($users as $per_user)
                                <option value="{{$per_user->id}}">{{$per_user->firstname}} {{$per_user->lastname}} -({{ $per_user->tasks_count }} tasks)</option>
                                @endforeach
                    </select>
                        </div>    
                    </div>

                </div>
                <div class="modal-footer" style="display: block;">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Add Task</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="editTaskForm" action="" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <input type="hidden" id="edit-task_id" name="edit-task_id" value="">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="edit-title" class="form-control" value="" required />
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="edit-description" class="form-control" value="{{ isset($task) ? $task->description : '' }}" required />
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">Date and Time</label>
                            <input type="datetime-local" name="due_date" id="edit-due_date" class="form-control" value="{{ isset($task) ? $task->due_date : '' }}" required />
                        </div>
                        <div class="col-md-6">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-control" id="edit-priority" name="priority" required>
                                <option value="low" @if(isset($task) && $task->priority == 'low') selected @endif>Low</option>
                                <option value="medium" @if(isset($task) && $task->priority == 'medium') selected @endif>Medium</option>
                                <option value="high" @if(isset($task) && $task->priority == 'high') selected @endif>High</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="edit-s" name="status" required>
                                <option value="New" @if(isset($task) && $task->status == 'New') selected @endif>New</option>
                                <option value="Inprogress" @if(isset($task) && $task->status == 'Inprogress') selected @endif>Inprogress</option>
                                <option value="Pending" @if(isset($task) && $task->status == 'Pending') selected @endif>Pending</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Assigned To</label>
                            <select name="user_id" class="form-control" required    id="edit-user_id">
                                @foreach ($users as $per_user)
                                <option value="{{$per_user->id}}">{{$per_user->firstname}} {{$per_user->lastname}} - ({{ $per_user->tasks_count }} tasks)</option>
                               
                                @endforeach
                               </select>
                        </div>
                    </div>    

                </div>
                <div class="modal-footer" style="display: block;">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="edit-btn">Update Task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </form>

                                    <!-- <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ route('tasks.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="text" id="title" class="form-control" placeholder="ID" readonly hidden />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Title</label>
                                                    <input type="text" name="supplier-name" id="title" class="form-control" placeholder="Enter name" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Discription</label>
                                                    <input type="text" name="supplier-name" id="description"  rows = "3" class="form-control" placeholder="Enter name" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Priorty</label>
                                                    <select class="form-control" id="priority" name="priority" required>
                                                          <option value="low">Low</option>
                                                          <option value="medium">Medium</option>
                                                          <option value="high">High</option>
                                                     </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Due Date</label>

                                                    <input type="date" id="dueDate" name="dueDate" required>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Status</label>
                                                    <input type="text" name="address" id="customername-field" class="form-control" placeholder="Enter Address" required />
                                                </div>

                                                <div class="mb-3">
                                                <label for="user_id">Assign to user:</label>
                                                <select name="user_id">
                                               
                                                `` </select>    
                                                     </div>
                                        
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">submit</button> -->
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                <!-- </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
                <!--end col-->
            </div>
           <!-- // end row -->


        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- end main content-->

</div>


            <!--end row-->

            </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
          <!-- end main content-->
                    
</div>                  
<script>
// Update table based on the selected filter
    function updateTable(filter) {
        // Get all table rows
        var rows = document.querySelectorAll('#tasksTable tbody tr');

        // Loop through each row and toggle visibility based on the filter
        rows.forEach(function(row) {
            var statusCell = row.querySelector('.status'); // Get the cell containing status
            var status = statusCell.textContent.trim(); // Get the status text

            // Show row if the filter is "All" or if the row's status matches the filter
            if (filter === 'All' || status === filter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function () {
    var dropdownItems = document.querySelectorAll('.dropdown-item');

    dropdownItems.forEach(function (item) {
        item.addEventListener('click', function () {
            var status = this.textContent.trim();
            var taskRows = document.querySelectorAll('.task-row');

            taskRows.forEach(function (row) {
                if (status.toLowerCase() === 'all' || row.classList.contains(status.toLowerCase().replace(' ', '-'))) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });

            // Here you can include your AJAX call to fetch and update tasks based on the selected status
            // Example AJAX call:
            /*
            fetch('/tasks/filterByStatus?status=' + encodeURIComponent(status))
                .then(response => response.json())
                .then(data => {
                    // Update task list based on the response data
                })
                .catch(error => console.error('Error:', error));
            */

            // Update the dropdown button text to show the selected status
            document.getElementById('dropdownMenuClickableOutside').textContent = status;
        });
    });
});



    $(document).ready(function() {
    // Event handler for clicking on the edit button
    $(document).on('click', '.task-edit', function(event) {
        event.preventDefault();
        
        // Retrieve task information from data attributes
        var taskID = $(this).data('task-id');
        var title = $(this).data('task-title');
        var description = $(this).data('task-description');
        var priority = $(this).data('task-priority');
        var due_date = $(this).data('task-due_date');
        var user_id = $(this).data('task-user_id');
        var status = $(this).data('task-status');

        console.log(title)

        // Populate modal fields with task information
        $("#edit-task_id").val(taskID)        
        // $('#id').val(taskID);
        $('#edit-title').val(title);
        $('#edit-description').val(description);
        $('#edit-priority').val(priority);
        $('#edit-due_date').val(due_date);
        $('#edit-user_id').val(user_id);
        $('#edit-s').val(status);

        // Show the edit task modal
        $('#editTaskModal').modal('show');
    });

    $(document).on('click', '#edit-btn', function(event) {
        event.preventDefault();
        
        // Retrieve task information from data attributes

        // Populate modal fields with task information
       var id = $('#edit-task_id').val();
       var title = $('#edit-title').val();
       console.log(title)
       var description = $('#edit-description').val();
       var due_date = $('#edit-due_date').val();
       var priority = $('#edit-priority').val();
       var status = $('#edit-s').val();
       var user_id = $('#edit-user_id').val();
       //var description = $('#description').val();
        // Show the edit task modal
        //$('#editTaskModal').modal('show');

        $.ajax({
            url: "/tasks/" + id,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'title': title,
                'description': description,
                'due_date': due_date,
                'priority': priority,
                'status': status, 
                'user_id': user_id, 
            },
            success: function(data) {
                console.log(data)
                location.reload()
                
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    var errors = JSON.parse(xhr.responseText);
                    console.error("Validation Error:", errors);
                } else {
                    console.error("Error:", error);
                }
            }
        });

        
    });
});




    

    </script>
<!-- END layout-wrappe