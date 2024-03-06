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
                                        <a href="{{ route('tasks.create') }}" class="btn btn-primary bg-gradient" style="background-color: #0ab39c; color: #fff;">
                                         <i class="fas fa-plus"></i> Create
                                        </a>
                                     <a href="{{ route('taskshow') }}" class="btn btn-primary bg-gradient
                                     waves-effect waves-light"></i>Show Complete Task</a>
                                     <a href="/missingtasks" class="btn btn-primary bg-gradient
                                     waves-effect waves-light"></i>Missing Task</a>
                                     <a href="/taskassign" class="btn btn-primary bg-gradient
                                     waves-effect waves-light"></i>My Task</a>
                                     <!-- Vertical Variation -->
                                     <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    All
                                    </button class="btn btn-primary dropdown-toggle">
                                     <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                     <li><a class="dropdown-item" href="javascript:void(0);">Low</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Medium</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">High</a></li>
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
                        <!-- <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                          <a href="{{ route('tasks.edit', $task->id) }}"  class="text-primary d-inline-block edit-item-btn" >
                                 <i class="ri-pencil-fill fs-16"></i>
                            </a>
                             </li>
                             <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                           <a href="{ route('tasks.destroy', $task->id) }}" class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" data-plantinfo-id="">
                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li> -->
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">
                        <i class="ri-pencil-fill fs-16"></i></a>
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
                                  



    <!-- </div>

    
   
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
    </div> -->

    <!-- Modals -->

     <!--Create Modal-->
                            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <div>
                                                          <label for="exampleInputdate" class="form-label">Input Date</label>
                                                         <input type="date" class="form-control" id="exampleInputdate">
                                                </div>
                                                </div>
                                                
                                               
                                                

                                                <div class="mb-3">
                                                <div>
                                                <label for="user_id" class="form-label">Assign to user:</label>
                                                <select name="user_id" class="form-label">
                                                </select>    
                                                     </div>
                                        
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button>
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
<!-- END layout-wrapper -->

