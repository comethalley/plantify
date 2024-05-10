@include('templates.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title">Task List</h4>
                            <form method="POST" id="addTaskForm">
                                @csrf
                                @if(Auth::user()->role_id != 4) <!-- Check if the logged-in user is not a Farmer -->
                                    <button class="btn btn-primary" type="button" id="addTaskButton">Add Task</button>
                                @endif
                            </form>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th width="40%" scope="col">ID</th>
                                                <th width="40%" scope="col">Crops</th>
                                                <th width="40%" scope="col">Planted Date</th>
                                                <th width="40%" scope="col">Harvested Date</th>
                                                <th width="20%" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $task)
                                            <tr>
                                                
                                                <td><a href="/plantcalendar" class="fw-medium">{{ $task->id }}</a></td>
                                                <td>{{ $task->title }}</td>
                                                <td>{{ $task->start }}</td>
                                                <td>{{ $task->end }}</td>
                                                <td><a href="{{ route('tasks.view', ['id' => $task->id]) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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






   <!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.querySelector('#addTaskButton');
    const addTaskForm = document.querySelector('#addTaskForm'); // Added
    
    addButton.addEventListener('click', function() {
        // Send AJAX request to add a new task
        fetch('/add-task', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (response.ok) {
                // Task added successfully
                return response.json(); // Parse the JSON response
            } else {
                // Handle error with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to add task!',
                    // You can customize the text and appearance of the SweetAlert here
                });
                throw new Error('Failed to add task'); // Propagate error to catch block
            }
        })
        .then(data => {
            // Display a success SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                // You can customize the text and appearance of the SweetAlert here
            });
            // Optionally, perform any additional actions here
            //location.reload(); // Refresh the page to display the updated task list
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

</script>   
