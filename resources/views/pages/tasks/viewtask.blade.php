@include('templates.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="container">
                <header class="my-4">
                    <h1>{{ $task->taskType->day }}</h1>
                </header> 
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">Task Name</div>
                            <div class="col">Start</div>
                            <div class="col">End</div>
                        </div>
                        <ul class="list-group">
                            @foreach($tasks as $task)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">{{ $task->name }}</div>
                                    <div class="col">{{ $task->start }}</div>
                                    <div class="col">{{ $task->end }}</div>
                                </div>
                            </li>
                            @endforeach
                            <!-- Add more tasks here -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@include('templates.footer')