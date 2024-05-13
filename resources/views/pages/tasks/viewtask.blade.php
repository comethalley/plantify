@include('templates.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start page title -->
            <div class="container">
                <header class="my-4">
                    <a href="/tasks" class="btn btn-primary">
                        <i class="ri-arrow-left-line"></i> Back to Tasks
                    </a>
                </header>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($days as $day)
                                <div class="col-md-3 mb-3">
                                    <div class="card day-card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Day {{ $day }}</h5>
                                            <button class="btn btn-outline-primary btn-day" data-bs-toggle="modal" data-bs-target="#dayModal{{$day}}">
                                                View Tasks
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->
        </div>
        <!-- Container-fluid -->
    </div>
    <!-- End page-content -->
</div>

<!-- Modals -->
@foreach ($days as $day)
    <div class="modal fade" id="dayModal{{$day}}" tabindex="-1" role="dialog" aria-labelledby="dayModalLabel{{$day}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dayModalLabel{{$day}}">Tasks for Day {{ $day }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="farmerSelect{{$day}}" class="form-label">Select Farmer</label>
                        <select class="form-select" id="farmerSelect{{$day}}">
                            <option selected disabled>Select Farmer</option>
                            @foreach ($farmers as $farmer)
                                <option value="{{ $farmer->id }}">{{ $farmer->firstname }} {{ $farmer->lastname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="form-label">Task</label>
                    <ul class="list-group">
                        @foreach ($tasks as $task)
                            @if ($task->day_number == $day)
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col">{{ $task->taskType->name }}</div>
                                        <div class="col-auto">
                                            <input type="time" class="form-control" id="startTime{{$task->id}}" value="{{ $task->start }}">
                                        </div>
                                        <div class="col-auto">
                                            <input type="time" class="form-control" id="endTime{{$task->id}}" value="{{ $task->end }}">
                                        </div>
                                        <div class="col">{{ $task->farmer->firstname }} {{ $task->farmer->lastname }}</div>
                                        <div class="col-auto">
                                            <input type="checkbox" class="form-check-input task-checkbox" data-task-id="{{ $task->id }}" @if($task->status == 1) checked disabled @endif>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save-tasks" id="saveBtn{{$day}}">Save</button>
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
        $('.task-checkbox').each(function() {
            if ($(this).is(':checked')) {
                var taskId = $(this).data('task-id');
                var startTime = $('#startTime' + taskId).val();
                var endTime = $('#endTime' + taskId).val();
                // Send AJAX request to update start and end times
                $.ajax({
                    url: '/update-task-time/' + taskId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        start: startTime,
                        end: endTime
                    },
                    success: function(response) {
                        // Optionally display a success message
                        console.log('Time updated successfully');
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
});


    document.addEventListener('DOMContentLoaded', function() {
    // Iterate over each day modal
    @foreach($days as $day)
        const saveBtn{{$day}} = document.querySelector('#saveBtn{{$day}}');
        const farmerSelect{{$day}} = document.querySelector('#farmerSelect{{$day}}');

        // Add click event listener to the save button
        saveBtn{{$day}}.addEventListener('click', function() {
            // Get the selected farmer ID
            const selectedFarmerId = farmerSelect{{$day}}.value;

            // Send AJAX request to update the assigned farmer for this day
            fetch('/update-task-farmer/{{$id}}/{{$day}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    farmer_id: selectedFarmerId
                })
            })
            .then(response => {
                if (response.ok) {
                    // Task updated successfully
                    // You can show a success message or perform any additional actions
                    window.location.reload();
                    console.log('Task updated successfully');
                } else {
                    // Handle error response
                    console.error('Failed to update task');
                }
            })
            .catch(error => {
                // Handle fetch error
                console.error('Error:', error);
            });
        });
    @endforeach
});



    
</script>