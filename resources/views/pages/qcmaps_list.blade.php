@include('templates.header')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

    </style>
</head>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">District 5, Quezon City Metro Manila Farm List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Farm List</a></li>

                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">District 5, Quezon City Metro Manila Farm List</h4>


                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form>

                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body pt-0">
                            <div>

                                <div class="table-responsive table-card mb-1">
                                    <table id="alternative-pagination" class="table table-nowrap align-middle">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">
                                                <th scope="col">

                                                </th>
                                                <th data-sort="amount" width="37%">Farm Name:</th>
                                                <th data-sort="payment" width="37%">Complete Address:</th>
                                                <th data-sort="customer_name" width="10%">Latitude:</th>
                                                <th data-sort="date" width="10%">Longitude:</th>


                                                @if(auth()->user()->role_id == 1)
                                                {{-- Display only for role_id 1 (Admin) --}}
                                                <th data-sort="payment" width="6%">Action:</th>
                                                @elseif(auth()->user()->role_id == 2)
                                                {{-- Display only for role_id 2 (Admin) --}}
                                                <th data-sort="payment" width="6%">Action:</th>
                                                @elseif(auth()->user()->role_id == 3)
                                                {{-- Display for role_id 3 (Farm Leader) --}}
                                                <th hidden data-sort="payment" width="6%">Action:</th>
                                                @elseif(auth()->user()->role_id == 4)
                                                {{-- Display for role_id 4 (Farmers) --}}
                                                <th hidden data-sort="payment" width="6%">Action:</th>
                                                @elseif(auth()->user()->role_id == 5)
                                                {{-- Display for role_id 5 (Public Users) --}}
                                                <th hidden data-sort="payment" width="6%">Action:</th>
                                                @endif

                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($farm_locations as $event)

                                            <tr>
                                                <th scope="row">

                                                </th>
                                                <td class="date">{{ $event->location_name }}</td>
                                                <td class="amount">{{ $event->address }}</td>
                                                <td class="customer_name">{{ $event->latitude }} </td>
                                                <td class="customer_name">{{ $event->longitude }}</td>

                                                @if(auth()->user()->role_id == 1)
                                                {{-- Display only for role_id 1 (Admin) --}}
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                            <a class="text-danger d-inline-block archive_btn" href="" data-location-id="{{ $event->id }}">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                @elseif(auth()->user()->role_id == 2)
                                                {{-- Display only for role_id 2 (Admin) --}}
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                            <a class="text-danger d-inline-block archive_btn" href="" data-location-id="{{ $event->id }}">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                @elseif(auth()->user()->role_id == 3)
                                                {{-- Display for role_id 3 (Farm Leader) --}}
                                                <td hidden>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                            <a class="text-danger d-inline-block archive_btn" href="" data-location-id="{{ $event->id }}">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                @elseif(auth()->user()->role_id == 4)
                                                {{-- Display for role_id 4 (Farmers) --}}
                                                <td hidden>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                            <a class="text-danger d-inline-block archive_btn" href="" data-location-id="{{ $event->id }}">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                @elseif(auth()->user()->role_id == 5)
                                                {{-- Display for role_id 5 (Public Users) --}}
                                                <td hidden>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                            <a class="text-danger d-inline-block archive_btn" href="" data-location-id="{{ $event->id }}">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- end main content-->
    <div class="modal fade" id="addFarmLocationModal" tabindex="-1" role="dialog" aria-labelledby="addFarmLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFarmLocationModalLabel">Add Farm Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your form fields here (e.g., latitude, longitude, location name) -->
                    <form id="addFarmLocationForm">
                        <!-- Example: Latitude -->
                        <div class="form-group">
                            <label for="latitude">Latitude:</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" required>
                        </div>

                        <!-- Example: Longitude -->
                        <div class="form-group">
                            <label for="longitude">Longitude:</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" required>
                        </div>

                        <!-- Example: Location Name -->
                        <div class="form-group">
                            <label for="locationName">Farm Name:</label>
                            <input type="text" class="form-control" id="locationName" name="locationName" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Exact Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Add Location</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END layout-wrapper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.archive_btn').on('click', function(event) {
        event.preventDefault();
        var locationId = $(this).data('location-id');
        var locationName = $(this).closest('tr').find('.date').text(); // Get the location name from the table row
        console.log('Location ID to delete:', locationId);

        // Display confirmation dialog before deletion
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone. Farm Name "' + locationName + '" will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the deletion if confirmed
                // Send AJAX request to delete farm location
                $.ajax({
                    url: '/deleteLocation/' + locationId,
                    method: 'DELETE',
                    success: function(response) {
                        console.log('Farm Location deleted successfully:', response);
                        // Display success notification after deletion
                        Swal.fire({
                            title: 'Success!',
                            text: 'Farm Name "' + locationName + '" deleted successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500 // Close the alert after 1.5 seconds
                        });
                        setTimeout(function() {
                            location.reload(); // Reload the page after 2 seconds
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting farm location:', error);
                    }
                });
            }
        });
    });


    $('#addFarmLocationForm').submit(function(e) {
        e.preventDefault();

        // Get form values
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var locationName = $('#locationName').val();
        var address = $('#address').val();

        // Make an AJAX request to store the farm location in the backend
        $.ajax({
            url: '/farm_locations',
            method: 'POST',
            data: {
                latitude: latitude,
                longitude: longitude,
                location_name: locationName,
                address: address,
            },
            success: function(data) {
                // Assuming your Laravel controller returns a JSON response with a success message
                console.log(data.message);
                Swal.fire({
                    title: "Farm Location added Successfully",
                    icon: "success"
                });
                if (data.latitude && data.longitude) {
                    L.marker([parseFloat(data.latitude), parseFloat(data.longitude)], {
                            icon: redIcon
                        })
                        .addTo(map)
                        .bindPopup(data.location_name);
                }
                setTimeout(function() {
                    location.reload(); // Reload the page after 2 seconds
                }, 2000);
            },
            error: function(error) {
                Swal.fire({
                    title: "Error",
                    text: "Error Adding Farm Location. Please try again.",
                    icon: "error"
                });
            }
        });

        // Close the modal
        $('#addFarmLocationModal').modal('hide');
    });
    $(document).ready(function() {
        $('#addFarmLocationForm').submit(function(e) {
            e.preventDefault();
            // Your AJAX form submission code goes here
        });

        $('#addFarmLocationModal').on('show.bs.modal', function(e) {
            console.log('Modal is shown');
        });

        $('#addFarmLocationModal').on('hidden.bs.modal', function(e) {
            console.log('Modal is hidden');
        });
    });
</script>


@include('templates.footer')