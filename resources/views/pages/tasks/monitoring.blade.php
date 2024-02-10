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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <!-- Other meta tags and CSS links -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<form>
    <!-- Your content here -->
    <br>
    <br>
    <div class="container text-center">
        

        <h2>Task List</h2> @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <!-- Rest of your content -->
       
 




    </div>

    
   
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
        <a href="{{ route('taskshow') }}" class="btn btn-secondary mb-3">Show Completed Tasks</a>
        <a href="/missingtasks" class="btn btn-secondary mb-3">Missing Tasks</a>
        <a href="/taskassign" class="btn btn-secondary mb-3">My Tasks</a>
        <div class="btn-group" style="width: 200px;">
        <button class="btn btn-secondary dropdown-toggle mb-3" type="button" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" data-bs-auto-close="inside" aria-expanded="false">
            All
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuClickableOutside">
            <li><a class="dropdown-item" href="javascript:void(0);">Low</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Mid</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">High</a></li>
        </ul>
    </div>
        <div class="card-body pt-0">

        
        <div>

        <div class="table-responsive table-card mb-1">
        <table class="table table-nowrap align-middle" id="orderTable">
        <thead class="text-muted table-light">
        <tr class="text-uppercase">
        <div class="col-xxl-2 col-sm-3 ms-auto">
        

        <table class="table table-bordered" id="tasksTable">
            <thead class="thead-dark">
                <tr>
                    <th class="sort" data_sort="id">ID</th>
                    <th class="sort" data_sort="tittle">Title</th>
                    <th class="sort" data_sort="description">Description</th>
                    <th class="sort" data_sort="priority">Priority</th>
                    <th class="sort" data_sort="due_date">Due Date</th>
                    <th class="sort" data_sort="user_id">Assignee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                     <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->user_id }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                        @if (!$task->completed)
                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fa fa-check"></i> Complete
                            </button>
                        </form>
                        @endif
                    </td>
             </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </form>

                            <!--Create Modal-->
                            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Name</label>
                                                    <input type="text" name="supplier-name" id="customername-field" class="form-control" placeholder="Enter name" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Deadline</label>

                                                    <input type="date" id="dueDate" name="dueDate" required>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Status</label>
                                                    <input type="text" name="address" id="customername-field" class="form-control" placeholder="Enter Address" required />
                                                </div>

                                                <div class="mb-3">
                                                <label for="user_id">Assign to user:</label>
                                                <select name="user_id">
                                                <option value="">Not assigned</option>
                                                     </div>
                                        
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Add Task</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


@include('templates.footer')