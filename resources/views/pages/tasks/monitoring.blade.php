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
                                <button class="btn btn-primary" type="button" id="addTaskButton">Add Task</button>
                            </form>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th width="40%" scope="col">Crops</th>
                                                <th width="40%" scope="col">Planted Date</th>
                                                <th width="40%" scope="col">Harvested Date</th>
                                                <th width="20%" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $task)
                                                <tr>
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
    const addTaskButton = document.getElementById('addTaskButton');

    addTaskButton.addEventListener('click', function() {
        // Send AJAX request to add tasks
        fetch("{{ route('addTask') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (response.ok) {
                // Tasks added successfully
                return response.json();
            } else {
                // Handle error
                throw new Error('Failed to add tasks');
            }
        })
        .then(data => {
            // Display success message using SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
            });
        })
        .catch(error => {
            // Display error message
            console.error('Error:', error);
            // Display error message using SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to add tasks. Please try again later.',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
});

</script>

