@include('templates.header')
<!-- <form action="/generate-qr" method="post">
    @csrf
    <label for="">Enter Supplier Name</label>
    <input type="text" name="supplier">
    <label for="">Enter Seed</label>
    <input type="text" name="seed">
    <label for="">Enter Unit Of Measurement</label>
    <input type="text" name="uom">
    <label for="">Enter # of Seeds per Pack</label>
    <input type="text" name="qty">
    <label for="">Enter ID:</label>
    <input type="text" name="qr-code">

    <button type="submit">Submit</button>
</form> -->

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
                                     <!-- Vertical Variation -->
                                     
                                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" data-bs-auto-close="inside" aria-expanded="false">
                                        All
                                    </button class="btn btn-primary dropdown-toggle">
                                     <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                     <li><a class="dropdown-item" href="javascript:void(0);">All</a></li>   
                                     <li><a class="dropdown-item" href="javascript:void(0);">New</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Inprogress</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Pending</a></li>
                                    </ul>
                                 </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form>
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-6">
                                        <div class="search-box">
                                            <!-- <input type="text" class="form-control search" placeholder="Search for order ID, customer, order status or something...">
                                            <i class="ri-search-line search-icon"></i> -->
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
                                                <th class="sort" data_sort="user_id">Assignee</th>
                                                <th class="sort" data_sort="due_date">Due Date</th>
                                               <th class="sort" data_sort="priority">Priority</th>
                                               <th class="sort" data_sort="status">Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($tasks as $task)
                <tr class ="task-row {{ strtolower(str_replace(' ', '-', $task->status)) }}">
                     <td class ='id'>#{{ $task->id }}</td>
                    <td class ='title'>{{ $task->title }}</td>
                    <td class ='description'>{{ $task->description }}</td>
                    <td class ='user_id'>{{ $task->user_id }}</td>
                    <td class ='due_date'>{{ $task->due_date }}</td>
                    <td class ='priority'>{{ $task->priority }}</td>
                    <td class ='status'>{{ $task->status }}</td>
                    <td>        <!-- <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                          <a href="{{ route('tasks.edit', $task->id) }}"  class="text-primary d-inline-block edit-item-btn" >
                                 <i class="ri-pencil-fill fs-16"></i>
                            </a>
                             </li>
                             <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                           <a href="{ route('tasks.destroy', $task->id) }}" class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" data-plantinfo-id="">
                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li> -->
                        <!-- Assuming this is inside your table -->
    <a href="#" class="btn btn-primary btn-sm task-edit"
       data-task-id="{{$task->id}}"
       data-task-title="{{$task->title}}"
       data-task-description="{{$task->description}}"
       data-task-priority="{{$task->priority}}"
       data-task-due_date="{{$task->due_date}}"
       data-task-user_id="{{$task->user_id}}"
       data-task-status="{{$task->status}}">
        <i class="ri-pencil-fill fs-16"></i>
    </a>


                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                                <i class="ri-delete-bin-5-fill fs-16"></i>
                            </button>
                        </form>
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
                            <label for="due_date" class="form-label">Date</label>
                            <input type="date" name="due_date" id="due_date" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-control" id="priority" name="priority" required>
                                <option value="Low">Low</option>
                                <option value="Mid">Mid</option>
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
                                <option value="{{$per_user->id}}">{{$per_user->firstname}} {{$per_user->lastname}}</option>
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

<!------Edit Modal--->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
                        
        <div class="modal-body">
        <input type="hidden" id="task_id" name="task_id" value="">

                    <!-- Hidden input for ID -->

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ $task->description }}" required />
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">Date</label>
                            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}" required />
                        </div>
                        <div class="col-md-6">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-control" id="priority" name="priority" required>
                                  <option value="low" @if($task->priority == 'low') selected @endif>Low</option>
                                  <option value="medium" @if($task->priority == 'medium') selected @endif>Medium</option>
                                  <option value="high" @if($task->priority == 'high') selected @endif>High</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="1" name="status" required>
                                <option value="New" @if($task->status == 'New') selected @endif>New</option>
                                <option value="Inprogress" @if($task->status == 'Inprogress') selected @endif>Inprogress</option>
                                <option value="Pending" @if($task->status == 'Pending') selected @endif>Pending</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Assigned To</label>
                            <select name="user_id" class="form-control" value="{{ $task->user_id }}" required>
                                @foreach ($users as $per_user)
                                <option value="{{$per_user->id}}">{{$per_user->firstname}} {{$per_user->lastname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="display: block;">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="edit-btn">Update Task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


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
<!-- END layout-wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </form>

                            <!--Create Modal-->
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

<script>$(document).ready(function () {
    $('.dropdown-item').click(function () {
        var status = $(this).text();

        
        if (status.toLowerCase() === 'all') {
            $('.task-row').show();
        } else {
            
            $('.task-row').hide();

            
            $('.task-row.' + status.toLowerCase().replace(' ', '-')).show();
        }

        $.ajax({
            url: '/tasks/filterByStatus',
            type: 'GET',
            data: { status: status },
            success: function (data) {
                
                console.log(status);

                
                $('#dropdownMenuClickableOutside').text(status);

                
                if (data.tasks.length === 0) {
                    $('#tableContainer').html('<p>No farms found.</p>');
                } else {
                    
                    $('#tableContainer').html(data.tasks);
                }
            },
            error: function (error) {
                console.log(error);
            }
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

        // Populate modal fields with task information
        $('#editTaskModal #id').val(taskID);
        $('#editTaskModal #title').val(title);
        $('#editTaskModal #description').val(description);
        $('#editTaskModal #priority').val(priority);
        $('#editTaskModal #due_date').val(due_date);
        $('#editTaskModal #user_id').val(user_id);
        $('#editTaskModal #status').val(status);

        // Show the edit task modal
        $('#editTaskModal').modal('show');
    });
});



    
});
    </script>
<!-- END layout-wrappe