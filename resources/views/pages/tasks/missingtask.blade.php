<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.header')
</head>
<body>
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
                                                <th>Priority</th>
                                                <th>Assignee</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($tasks->isEmpty())
                                                <tr>
                                                    <td colspan="5">No missing tasks found.</td>
                                                </tr>
                                            @else
                                                @foreach($tasks as $task)
                                                    <tr>
                                                        <td>#{{ $task->id }}</td>
                                                        <td>{{ $task->title }}</td>
                                                        <td>{{ $task->description }}</td>
                                                        <td>{{ $task->due_date }}</td>
                                                        <td class="user_id">
                                                            @if ($task->user)
                                                                {{ $task->user->firstname }} {{ $task->user->lastname }}
                                                            @else
                                                                
                                                            @endif
                                                        </td> 
                                                        <td>{{ $task->priority }}</td>
                                                        <td>{{ $task->status }}</td>
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
