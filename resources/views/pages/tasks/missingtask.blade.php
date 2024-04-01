<!DOCTYPE html>
<html lang="en">
<head>
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
</head>
<body>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Task</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">Kanban Board</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title mb-0">Missing Task</h5>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex gap-1 flex-wrap">
                                        <a href="{{ route('tasks.monitoring') }}" class="btn btn-primary bg-gradient
                                                 waves-effect waves-light"><i class=" ri-arrow-left-line"></i></a>
                                            <!-- Some buttons or actions can go here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border border-dashed border-end-0 border-start-0">
                                <!-- Form or additional content can go here -->
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive table-card mb-1">
                                    <table class="table table-nowrap align-middle">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">
                                                
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Due Date</th>
                                                <th>Assigned To</th>
                                                <th>Priority</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($tasks->isEmpty())
                                                <tr>
                                                    <td colspan="10"><div class="noresult" style="display: flex; justify-content: center; align-items: center; height: 200px;">
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                                            <h5 class="mt-2" style="font-size: 20px;">Sorry! No Result Found</h5>
                                                            <p class="text-muted mb-0" style="font-size: 16px;">We've searched more than 200k+ tasks. We did not find any tasks for your search.</p>
                                                        </div>
                                                    </div>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach($tasks as $task)
                                                    <tr>
                                                        <td>#{{ $task->id }}</td>
                                                        <td>{{ $task->title }}</td>
                                                        <td class="description" style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;" title="{{ $task->description }}">
                                                                         {{ $task->description }}
                                                         </td>
                                    
                                                         <td id="due_date_{{ $task->id }}" class="due_date">
                                                            {{ date('j M, Y - h:i A', strtotime($task->due_date)) }}
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
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div> <!-- end page-content -->             
    </div> <!-- end main-content -->   
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
    <!-- O    ther scripts or CSS links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
