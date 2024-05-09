@include('templates.header')
<div class="main-content">
<<<<<<< HEAD
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
                                                <th width="40%" scope="col">Assigned To</th>
                                                <th width="20%" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $task)
                                            <tr>
                                                <td><a href="/plantcalendar" class="fw-medium">{{ $task->crops }}</a></td>
                                                <td>{{ $task->firstname }} {{ $task->lastname }}</td>
                                                <td><a href="{{ route('tasks.view', ['id' => $task->task_id]) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
=======

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Kanban Board</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks</a></li>
                            <li class="breadcrumb-item active">Kanban Board</li>
                        </ol>
>>>>>>> b0f65fb81cb0bcaf4f61663f4c2a4cbb3238e97e
                    </div>

                </div>
            </div>
<<<<<<< HEAD
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
            location.reload(); // Refresh the page to display the updated task list
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

</script>   
=======
        </div>
        <!-- end page title -->

        <div class="tasks-board mb-3" id="kanbanboard">
            <div class="tasks-list">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <h6 class="fs-14 text-uppercase fw-semibold mb-0">Unassigned <small class="badge bg-success align-bottom ms-1 totaltask-badge">2</small></h6>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-medium text-muted fs-12">Priority<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Priority</a>
                                <a class="dropdown-item" href="#">Date Added</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-simplebar class="tasks-wrapper px-3 mx-n3">
                    <div id="unassigned-task" class="tasks">
                        <div class="card tasks-box">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                     <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="apps-tasks-details.html" class="d-block">Profile Page Structure</a></h6>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted">Profile Page means a web page accessible to the public or to guests.</p>
                                <div class="mb-3">
                                    <div class="d-flex mb-1">
                                        <div class="flex-grow-1">
                                            <h6 class="text-muted mb-0"><span class="text-secondary">15%</span> of 100%</h6>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span class="text-muted">03 Jan, 2022</span>
                                        </div>
                                    </div>
                                    <div class="progress rounded-3 progress-sm">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="badge bg-primary-subtle text-primary">Admin</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="avatar-group">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                                <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-top-dashed">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h6 class="text-muted mb-0">#VL2436</h6>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="link-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-eye-line align-bottom"></i> 04</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-question-answer-line align-bottom"></i> 19</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-attachment-2 align-bottom"></i> 02</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                        <div class="card tasks-box">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    <div class="flex-grow-1">
                                   <h6 class="fs-15 mb-0 text-truncate task-title"><a href="apps-tasks-details.html" class="d-block">Velzon - Admin Layout Design</a></h6>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink12" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink12">
                                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted">The dashboard is the front page of the Administration UI.</p>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="badge bg-primary-subtle text-primary">Layout</span>
                                        <span class="badge bg-primary-subtle text-primary">Admin</span>
                                        <span class="badge bg-primary-subtle text-primary">Dashboard</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="avatar-group">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Michael">
                                                <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                                <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Anna">
                                                <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-footer border-top-dashed">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <span class="text-muted"><i class="ri-time-line align-bottom"></i> 07 Jan, 2022</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="link-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-eye-line align-bottom"></i> 14</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-question-answer-line align-bottom"></i> 32</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-attachment-2 align-bottom"></i> 05</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <!--end tasks-->
                </div>
            </div>
            <!--end tasks-list-->
            <div class="tasks-list">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <h6 class="fs-14 text-uppercase fw-semibold mb-0">To Do <small class="badge bg-secondary align-bottom ms-1 totaltask-badge">2</small></h6>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-medium text-muted fs-12">Priority<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Priority</a>
                                <a class="dropdown-item" href="#">Date Added</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-simplebar class="tasks-wrapper px-3 mx-n3">
                    <div id="todo-task" class="tasks">
                        <div class="card tasks-box">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    <div class="flex-grow-1">
                                        <h6 class="fs-15 mb-0 text-truncate task-title"><a href="apps-tasks-details.html" class="d-block">Admin Layout Design</a></h6>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink3">
                                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted">Landing page template with clean, minimal and modern design.</p>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="badge bg-primary-subtle text-primary">Design</span>
                                        <span class="badge bg-primary-subtle text-primary">Website</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="avatar-group">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tonya">
                                                <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Frank">
                                                <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Herbert">
                                                <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-footer border-top-dashed">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <span class="text-muted"><i class="ri-time-line align-bottom"></i> 07 Jan, 2022</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="link-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-eye-line align-bottom"></i> 13</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-question-answer-line align-bottom"></i> 52</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-attachment-2 align-bottom"></i> 17</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end card-->
                        <div class="card tasks-box">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    <div class="flex-grow-1">
                                    <h6 class="fs-15 mb-0 text-truncate task-title"><a href="apps-tasks-details.html" class="d-block">Marketing & Sales</a></h6>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink4" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink4">
                                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted">Sales and marketing are two business functions within an organization.</p>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="badge bg-primary-subtle text-primary">Marketing</span>
                                        <span class="badge bg-primary-subtle text-primary">Business</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="avatar-group">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Donald">
                                                <img src="assets/images/users/avatar-9.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Thomas">
                                                <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-footer border-top-dashed">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <span class="text-muted"><i class="ri-time-line align-bottom"></i> 27 Dec, 2021</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="link-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-eye-line align-bottom"></i> 24</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-question-answer-line align-bottom"></i> 10</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-attachment-2 align-bottom"></i> 10</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                </div>
            </div>
            <!--end tasks-list-->
            <div class="tasks-list">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <h6 class="fs-14 text-uppercase fw-semibold mb-0">Inprogress <small class="badge bg-warning align-bottom ms-1 totaltask-badge">2</small></h6>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-medium text-muted fs-12">Priority<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Priority</a>
                                <a class="dropdown-item" href="#">Date Added</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-simplebar class="tasks-wrapper px-3 mx-n3">
                    <div id="inprogress-task" class="tasks">
                        <div class="card tasks-box">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    <a href="javascript:void(0)" class="text-muted fw-medium fs-14 flex-grow-1">#VL2457</a>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink5" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink5">
                                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <h6 class="fs-15 text-truncate task-title"><a href="apps-tasks-details.html" class="text-body d-block">Brand Logo Design</a></h6>
                                <p class="text-muted">BrandCrowd's brand logo maker allows you to generate and customize stand-out brand logos in minutes.</p>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="badge bg-primary-subtle text-primary">Logo</span>
                                        <span class="badge bg-primary-subtle text-primary">Design</span>
                                        <span class="badge bg-primary-subtle text-primary">UI/UX</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="avatar-group">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Michael">
                                                <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                                <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-top-dashed">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <span class="text-muted"><i class="ri-time-line align-bottom"></i> 22 Dec, 2021</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="link-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-eye-line align-bottom"></i> 24</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-question-answer-line align-bottom"></i> 10</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-attachment-2 align-bottom"></i> 10</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end card-->
                        <div class="card tasks-box">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    <a href="javascript:void(0)" class="text-muted fw-medium fs-14 flex-grow-1">#VL2743</a>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink6" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink6">
                                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <h6 class="fs-15 text-truncate task-title"><a href="apps-tasks-details.html" class="d-block">Change Old App Icon</a></h6>
                                <p class="text-muted">Change app icons on Android: How do you change the look of your apps.</p>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="badge bg-primary-subtle text-primary">Design</span>
                                        <span class="badge bg-primary-subtle text-primary">Website</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="avatar-group">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tonya">
                                                <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Donald">
                                                <img src="assets/images/users/avatar-9.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-top-dashed">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <span class="text-muted"><i class="ri-time-line align-bottom"></i> 24 Oct, 2021</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="link-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-eye-line align-bottom"></i> 64</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-question-answer-line align-bottom"></i> 35</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" class="text-muted"><i class="ri-attachment-2 align-bottom"></i> 23</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                </div>
            </div>
            <!--end tasks-list-->
        </div>
        <!--end task-board-->

        <div class="modal fade" id="addmemberModal" tabindex="-1" aria-labelledby="addmemberModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-0">
                    <div class="modal-header p-3 bg-warning-subtle">
                        <h5 class="modal-title" id="addmemberModalLabel">Add Member</h5>
                        <button type="button" class="btn-close" id="btn-close-member" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label for="submissionidInput" class="form-label">Submission ID</label>
                                    <input type="number" class="form-control" id="submissionidInput" placeholder="Submission ID">
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <label for="profileimgInput" class="form-label">Profile Images</label>
                                    <input class="form-control" type="file" id="profileimgInput">
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <label for="firstnameInput" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstnameInput" placeholder="Enter firstname">
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <label for="lastnameInput" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastnameInput" placeholder="Enter lastname">
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <label for="designationInput" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="designationInput" placeholder="Designation">
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <label for="titleInput" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="titleInput" placeholder="Title">
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <label for="numberInput" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="numberInput" placeholder="Phone number">
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <label for="joiningdateInput" class="form-label">Joining Date</label>
                                    <input type="text" class="form-control" id="joiningdateInput" data-provider="flatpickr" placeholder="Select date">
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <label for="emailInput" class="form-label">Email ID</label>
                                    <input type="email" class="form-control" id="emailInput" placeholder="Email">
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i class="ri-close-line align-bottom me-1"></i> Close</button>
                        <button type="button" class="btn btn-success" id="addMember">Add Member</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end add member modal-->

        <div class="modal fade" id="createboardModal" tabindex="-1" aria-labelledby="createboardModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header p-3 bg-info-subtle">
                        <h5 class="modal-title" id="createboardModalLabel">Add Board</h5>
                        <button type="button" class="btn-close" id="addBoardBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="boardName" class="form-label">Board Name</label>
                                    <input type="text" class="form-control" id="boardName" placeholder="Enter board name">
                                </div>
                                <div class="mt-4">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" id="addNewBoard">Add Board</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end add board modal-->

        <div class="modal fade" id="creatertaskModal" tabindex="-1" aria-labelledby="creatertaskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header p-3 bg-info-subtle">
                        <h5 class="modal-title" id="creatertaskModalLabel">Create New Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#">
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label for="projectName" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" id="projectName" placeholder="Enter project name">
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <label for="sub-tasks" class="form-label">Task Title</label>
                                    <input type="text" class="form-control" id="sub-tasks" placeholder="Task title">
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <label for="task-description" class="form-label">Task Description</label>
                                    <textarea class="form-control" id="task-description" rows="3" placeholder="Task description"></textarea>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <label for="formFile" class="form-label">Tasks Images</label>
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <label for="tasks-progress" class="form-label">Add Team Member</label>
                                    <div data-simplebar style="height: 95px;">
                                        <ul class="list-unstyled vstack gap-2 mb-0">
                                            <li>
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="anna-adame">
                                                    <label class="form-check-label d-flex align-items-center" for="anna-adame">
                                                        <span class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xxs rounded-circle" />
                                                        </span>
                                                        <span class="flex-grow-1 ms-2">
                                                            Anna Adame
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="frank-hook">
                                                    <label class="form-check-label d-flex align-items-center" for="frank-hook">
                                                        <span class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xxs rounded-circle" />
                                                        </span>
                                                        <span class="flex-grow-1 ms-2">
                                                            Frank Hook
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="alexis-clarke">
                                                    <label class="form-check-label d-flex align-items-center" for="alexis-clarke">
                                                        <span class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xxs rounded-circle" />
                                                        </span>
                                                        <span class="flex-grow-1 ms-2">
                                                            Alexis Clarke
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="herbert-stokes">
                                                    <label class="form-check-label d-flex align-items-center" for="herbert-stokes">
                                                        <span class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xxs rounded-circle" />
                                                        </span>
                                                        <span class="flex-grow-1 ms-2">
                                                            Herbert Stokes
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="michael-morris">
                                                    <label class="form-check-label d-flex align-items-center" for="michael-morris">
                                                        <span class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xxs rounded-circle" />
                                                        </span>
                                                        <span class="flex-grow-1 ms-2">
                                                            Michael Morris
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="nancy-martino">
                                                    <label class="form-check-label d-flex align-items-center" for="nancy-martino">
                                                        <span class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-xxs rounded-circle" />
                                                        </span>
                                                        <span class="flex-grow-1 ms-2">
                                                            Nancy Martino
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="thomas-taylor">
                                                    <label class="form-check-label d-flex align-items-center" for="thomas-taylor">
                                                        <span class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xxs rounded-circle" />
                                                        </span>
                                                        <span class="flex-grow-1 ms-2">
                                                            Thomas Taylor
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="tonya-noble">
                                                    <label class="form-check-label d-flex align-items-center" for="tonya-noble">
                                                        <span class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xxs rounded-circle" />
                                                        </span>
                                                        <span class="flex-grow-1 ms-2">
                                                            Tonya Noble
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <label for="due-date" class="form-label">Due Date</label>
                                    <input type="text" class="form-control" id="due-date" data-provider="flatpickr" placeholder="Select date">
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <label for="categories" class="form-label">Tags</label>
                                    <input type="text" class="form-control" id="categories" placeholder="Enter tag">
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <label for="tasks-progress" class="form-label">Tasks Progress</label>
                                    <input type="text" class="form-control" maxlength="3" id="tasks-progress" placeholder="Enter progress">
                                </div>
                                <!--end col-->
                                <div class="mt-4">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success">Add Task</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end add board modal-->

        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="delete-btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this tasks ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal -->

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
</div><!-- end main content-->
>>>>>>> b0f65fb81cb0bcaf4f61663f4c2a4cbb3238e97e
