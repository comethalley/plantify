@include('templates.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="container">
                <header class="my-4">
                    <a href="/tasks" class="btn btn-primary">
                        <i class="ri-arrow-left-line"></i>
                    </a>
                </header> 
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($days as $day)
                                <div class="col-md-1 mb-2">
                                    <button class="btn btn-outline-primary btn-day" data-bs-toggle="modal" data-bs-target="#dayModal{{$day}}">
                                        Day {{ $day }}
                                    </button>
                                </div>
                                <!-- Modal for each day -->
                                <div class="modal fade" id="dayModal{{$day}}" tabindex="-1" role="dialog" aria-labelledby="dayModalLabel{{$day}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="dayModalLabel{{$day}}">Tasks for Day {{ $day }}</h5>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Display predefined tasks -->
                                                <ul class="list-group">
                                                    @foreach ($predefinedTasks as $predefinedTask)
                                                    <li class="list-group-item">
                                                        {{ $predefinedTask->name }}
                                                        (Start: {{ $predefinedTask->start }}, End: {{ $predefinedTask->end }})
                                                    </li>
                                                    @endforeach
                                                </ul>

                                                <!-- Display tasks for the day here -->
                                                <ul class="list-group">
                                                    @foreach ($tasks as $task)
                                                        @if ($task->day_number == $day)
                                                            <li class="list-group-item">
                                                                <div class="row">
                                                                    <div class="col">{{ $task->task_type_id }}</div>
                                                                    <div class="col">{{ $task->start }}</div>
                                                                    <div class="col">{{ $task->end }}</div>
                                                                    <div class="col">{{ $task->assigned }}</div>
                                                                    <div class="col">
                                                                        <!-- Display task details -->
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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

<script>
    $(document).ready(function() {
        $('.task-checkbox').change(function() {
            var taskId = $(this).data('task-id');
            $(this).prop('disabled', true); // Disable the checkbox
            // Send AJAX request to update status
            $.ajax({
                url: '/update-task-status/' + taskId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: 1
                },
                success: function(response) {
                    // Optionally display a success message
                    console.log('Status updated successfully');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });

        $('.save-tasks').click(function() {
            // Perform any other actions you need when saving tasks
        });
    });
</script>