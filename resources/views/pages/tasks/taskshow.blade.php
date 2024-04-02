@include('templates.header')
<style>
        /* Badge styles */
.badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 10px;
    text-transform: uppercase;
}

.badge-new {
    background-color: #f0ffff; /* Light cyan */
    color: #007bff; /* Blue */
}

.badge-missing {
    background-color: #ffe4e1; /* Misty rose */
    color: #800000; /* Dark red */
}

.badge-inprogress {
    background-color: #f0f8ff; /* Alice blue */
    color: #28a745; /* Green */
}

.badge-completed {
    background-color: #f5f5dc; /* Beige */
    color: #6B8E23; /* Olive */
}

.badge-pending {
    background-color: #fff8dc; /* Cornsilk */
    color: #ffc107; /* Yellow */
}

/* Priority styles */
.priority {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: bold;
    text-transform: uppercase;
}

.priority-high {
    background-color: #dc3545; /* Red */
    color: #fff; /* White */
}

.priority-medium {
    background-color: #ffc107; /* Yellow */
    color: #fff; /* Black */
}

.priority-low {
    background-color: #28a745; /* Green */
    color: #fff; /* White */
}


        </style>
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
                                <li class="breadcrumb-item active">Completed Task</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center gy-3">
                            <div class="col-sm">
                                <h5 class="card-title mb-0">Completed Task</h5>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('tasks.monitoring') }}" class="btn btn-primary bg-gradient
                                                 waves-effect waves-light"><i class=" ri-arrow-left-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border border-dashed border-end-0 border-start-0">
                        <form>
                            <div class="row g-3">
                                <div class="col-xl-3 ">
                                    <div class="mt-0">
                                        
                                        <div class="d-flex align-items-center mt-2">
                                            
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                            <!-- Another Calender -->
                            <!-- <div >
                                <label for="exampleInputdate" class="form-label">Input Date</label>
                                <div class="d-flex align-items-center ">
                                    <input type="date" class="form-control me-2" id="exampleInputdate">
                                    <button type="button" class="btn btn-primary bg-gradient
                                     waves-effect waves-light mdi mdi-magnify search-widget-icon"></button>
                                </div> -->
                        </form>
                    </div>
                    
                        <div class="card-body pt-0">
                             <div class="table-responsive table-card mb-1">
                                <table class="table table-nowrap align-middle" id="">
                                    <thead class="text-muted table-light">
                                        <tr class="text-uppercase">
                                        </th>
                                            <th>ID</th>
                                            <th class="sort" data-sort="title">Title  </th>
                                            <th class="sort" data-sort="description">Description</th>
                                            <th class="sort" data-sort="user_id">Assigned To</th>
                                            <th class="sort" data-sort="priority">Priority</th>
                                            <th class="sort">Status</th>
                                            <th class="sort" data-sort="condition">Date Completed</th>
                                            
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                      @foreach ($completedTasks as $task)
                                        <tr>
                                        <td>#{{ $task->id }}</td>
                                         <td>{{ $task->title }}</td>
                                         <td class="description" style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;" title="{{ $task->description }}">
                                        {{ $task->description }}
                                    </td>
                                     <td class="user_id">
                                    @if ($task->user)
                                        {{ $task->user->firstname }} {{ $task->user->lastname }}
                                    @else
                                        
                                    @endif
                                    </td> 
                                    <td>
                                        <span class="priority priority-<?php echo strtolower($task->priority); ?>"><?php echo $task->priority; ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?php echo strtolower($task->status); ?>"><?php echo $task->status; ?></span>
                                    </td>
                                     <td>{{ $task->completed_at }}</td>
                                    </tr>
                                      @endforeach
                                     </tbody>
                                  
                                    </tbody>


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

<!-- <!DOCTYPE html>
<html lang="en">

<head> -->
    <!-- Other meta tags and CSS links -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<center><h1>Completed Tasks</h1></center>
<body>
    
<a href="{{ route('tasks.monitoring') }}" class="btn btn-primary mb-3">Back</a>
<div class="card-body pt-0"> -->

        
<!-- 

<div class="table-responsive table-card mb-1">
        <table class="table table-nowrap align-middle" id="orderTable">
        <thead class="text-muted table-light">
        <tr class="text-uppercase">
        <div class="col-xxl-2 col-sm-3 ms-auto">
       
        <table class="table table-bordered">
            <thead class="thead-dark">

            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Priority</th>
                <th>Assignee</th>
                <th>Completion Date</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($completedTasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->priority }}</td>
                <td>{{ $task->user_id }}</td>
                <td>{{ $task->completed_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table> -->
</div>  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>