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
                        @foreach($tasks->unique('day_number') as $task)
                                <div class="col-md-1 mb-2">
                                    <button class="btn btn-outline-primary btn-day" data-bs-toggle="modal" data-bs-target="#dayModal{{ $task->day_number }}">
                                        Day {{ $task->day_number }}
                                    </button>
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

@foreach($tasks as $task)
    <!-- Modal for each day -->
    <div class="modal fade" id="dayModal{{ $task->day_number }}" tabindex="-1" role="dialog" aria-labelledby="dayModal{{ $task->day_number }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dayModal{{ $task->day_number }}Label">Tasks for Day {{ $task->day_number }}</h5>
                </div>
                <div class="modal-body">
                    <!-- Display tasks for the day here -->
                    <ul class="list-group">
                    @foreach($tasks->where('day_number', $task->day_number) as $dayTask)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">{{ $dayTask->taskType->name}}</div>
                                    <div class="col">{{ $dayTask->start }}</div>
                                    <div class="col">{{ $dayTask->end }}</div>
                                    <div class="col"> @if($user = \App\Models\User::find($dayTask->assigned))
                                        {{ $user->firstname }} {{ $user->lastname }}
                                    @else
                                        Not Assigned
                                    @endif
                                    </div>
                                    <input type="checkbox" class="form-check-input ml-2 task-checkbox" id="taskCheckbox{{ $dayTask->id }}" data-task-id="{{ $dayTask->id }}" @if($dayTask->status == 1) disabled checked @endif>
                                </div>
                            </li>
                    @endforeach
                        <!-- Add more tasks for the day here -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

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