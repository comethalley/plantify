@include('templates.header')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Task List</h4>
                                    <form method="POST" action="{{ route('tasks.save') }}">
                                        @csrf
                                        
                                        <button type="submit">Add Task</button>
                                    </form>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" scope="col">Crops</th>
                                                        <th width="40%" scope="col">Assigned To</th>
                                                        <th width="20%" scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($tasks as $task)
                                                    <tr>
                                                        <th scope="row"><a href="/plantcalendar" class="fw-medium"></a>{{ $task->crops }}</th>
                                                        <th></a>{{ $task->user_id }}</th>
                                                        <td><a href='taskshow' class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <!-- end page title -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>





   <!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.querySelector('#addTaskButton');

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
            location.reload(); // Refresh the page to display the updated task list
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>   