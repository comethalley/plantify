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

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Other meta tags and CSS links -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="card-body pt-0">

        
                            <div>

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
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
             <center><h1>Missing Tasks</h1></center>

        <a href="{{ route('tasks.monitoring') }}" class="btn btn-primary mb ">Back</a>
@if($tasks->isEmpty())
    <p>No missing tasks found.</p>
@else
    <ul>
        @foreach($tasks as $task)
        <td>{{ $task->title }}</td>
        <td>{{ $task->description }}</td>
        <td>{{ $task->priority }}</td>
        <td>{{ $task->user_id }}</td>
        <td>{{ $task->due_date }}</td>
    @endforeach
    </ul>
@endif
        </tbody>
    </table>
</div>  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
@include('templates.footer')
