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
    background-color: #f0ffff; /* Light gray */
    color: #007bff; /* Blue */
}

.badge-missing {
    background-color: #FE8484; /* Light gray */
    color: #800000; /* Blue */
}
.badge-inprogress {
    background-color: #f0f0f0; /* Light gray */
    color: #28a745; /* Green */
}

.badge-pending {
    background-color: #ffffe0; /* Light gray */
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">List Viewed</a></li>
                                <li class="breadcrumb-item active">Kanban Board</li>
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
                                        <h5 class="card-title mb-0">My Task</h5>
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
                                                <!-- <a href="{{ route('tasks.monitoring') }}"   class="btn btn-success waves-effect waves-light mb-4" class="col-xl-3 col-lg-4 col-sm-6"><i class="las la-arrow-left"></i></div></a> -->
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
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
                                <div>

                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">


                                                    
                                                    <th>ID</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Due Date</th>
                                                <th>Priority</th>
                                                <th>Assignee</th>
                                                <th>Status</th>
                                                   
                                                </tr>
                                            </thead>
                                            @if($tasks == "")
                                             <p>No tasks assigned to you.</p>
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
                                                        <td>
                                                            <span class="priority priority-<?php echo strtolower($task->priority); ?>"><?php echo $task->priority; ?></span>
                                                        </td>
                                                        <td class="user_id">
                                                            @if ($task->user)
                                                                {{ $task->user->firstname }} {{ $task->user->lastname }}
                                                            @else
                                                                
                                                            @endif
                                                        </td>
                                                        <td>
                                                        <span class="badge badge-<?php echo strtolower($task->status); ?>"><?php echo $task->status; ?></span>
                                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                  

                                            </tbody>
                                            </table>
                @endif
                                    </div>
                                </div>

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

<!-- 
            <div class="container">
                <br><table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                            </tr>
                        </thead>
                        <tbody>

                
                @if($tasks == "")
                    <p>No tasks assigned to you.</p>
                @else
                    
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->due_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div> -->
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

