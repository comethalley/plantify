<!-- Accounts -->

@include('templates.header')
<!-- <form action="/generate-qr" method="post">
    @csrf
    <label for="">Enter Supplier Name</label>
    <input type="text" name="supplier">
    <label for="">Enter Seed</label>
    <input type="text" name="seed">
    <label for="">Enter Unit Of Measurement</label>
    <input type="text" name="uom">
    <label for="">Enter # of Seeds per Pack</label>
    <input type="text" name="qty">
    <label for="">Enter ID:</label>
    <input type="text" name="qr-code">

    <button type="submit">Submit</button>
</form> -->

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">



            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Users</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">Farm Leader</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Farm Leaders List</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-secondary waves-effect waves-light download-farmleaders"><i class="ri-download-2-line"></i> Download CSV </button>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#farmLeadershowModal"><i class="ri-add-line align-bottom me-1"></i> Invite New Farmer Leader</button>
                                        <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form>
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Search for Account ID, Name, or something...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body pt-0">
                            <div>

                                <div class="table-responsive table-card mb-1">
                                    <table class="table table-nowrap align-middle" id="farmerLeader-tbl">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">

                                                <th data-sort="id">ID</th>
                                                <th data-sort="first_name">First Name</th>
                                                <th data-sort="last_name">Last Name</th>
                                                <th data-sort="payment">Email Address</th>
                                                <!-- <th data-sort="address">Address</th>
                                                <th data-sort="contact">Contact</th> -->
                                                <th data-sort="city">Action</th>



                                            </tr>
                                        </thead>

                                        <tbody class="list form-check-all">

                                        </tbody>

                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- download csv-->

                            <div class="modal fade" id="csv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Invite New Farmer Leader</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <div class="mb-3">
                                                    <!-- Default File Input Example -->
                                                    <div>
                                                        <label for="formFile" class="form-label">Download File</label>
                                                        <input class="form-control" type="file" id="formFile">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-btn btn-secondary waves-effect waves-light">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!--Create Admin Modal-->
                            <div class="modal fade" id="farmLeadershowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Invite New Farm Leaders</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <input type="hidden" id="id-field" />

                                                    <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                                    <!-- <div class="mb-3">
                                                    <label for="customername-field" class="form-label">First Name</label>
                                                    <input type="text" name="supplier-name" id="firstname" class="form-control" placeholder="Enter name" required />
                                                </div> -->

                                                    <!-- <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Last Name</label>
                                                    <input type="text" name="description" id="lastname" class="form-control" placeholder="Enter Description" required />
                                                </div> -->

                                                    <div class="mb-3">
                                                        <label for="customername-field" class="form-label">Email Address</label>
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required />
                                                    </div>

                                                    <div class="mb-3 col-md-6">
                                                        <label for="seed" class="form-label">Barangay</label>
                                                        <select name="barangay_name" id="barangay_name" class="form-select" required>
                                                            <option value="">Select Barangay</option>

                                                            @foreach ($barangays as $option)
                                                            <option value="{{ $option->barangay_name }}">{{ $option->barangay_name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="customername-field" class="form-label">Area (sqm)</label>
                                                        <input type="number" name="area" id="area" class="form-control" placeholder="Enter Area (sqm)" required />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="customername-field" class="form-label">Farm Name</label>
                                                        <input type="text" name="farm_name" id="farm_name" class="form-control" placeholder="Enter Farm Name" required />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="customername-field" class="form-label">Complete Address</label>
                                                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Complete Address" required />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="latitude">Latitude:</label>
                                                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="e.g. 14.745692064170463" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="longitude">Longitude:</label>
                                                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="e.g. 121.05243279106442" required>
                                                    </div>
                                                    <center>
                                                        <div class="">
                                                            <label for="latitude" class="text-muted">Get your Latitude and Longitude in Google Maps</label>
                                                        </div>
                                                    </center>

                                                    <!-- <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Address</label>
                                                    <input type="address" name="address" id="address" class="form-control" placeholder="Enter Address" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Contact</label>
                                                    <input type="contact" name="contact" id="contact" class="form-control" placeholder="Enter Contact" required />
                                                </div> -->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" id="add-farmleader-btn">Invite</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- download csv-->

                            <div class="modal fade" id="csv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Download</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">File</label>
                                                    <input type="text" name="contact" id="customername-field" class="form-control" placeholder="file name" readonly /><br>
                                                    <button type="button" class="btn btn-btn btn-secondary waves-effect waves-light">file</button>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-btn btn-secondary waves-effect waves-light">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!--Edit FarmLeader Modal-->

                            <div class="modal fade" id="editFLModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Farm Leader</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="hidden" id="farmLeaderID" class="form-control" />

                                                <div class="mb-3">
                                                    <label for="edit-firstname" class="form-label">First Name</label>
                                                    <input type="text" name="firstname" id="edit-firstname" class="form-control" placeholder="Enter First Name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit-lastname" class="form-label">Last Name</label>
                                                    <input type="text" name="lastname" id="edit-lastname" class="form-control" placeholder="Enter Last Name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit-email" class="form-label">Email Address</label>
                                                    <input type="email" name="email" id="edit-email" class="form-control" placeholder="Enter Email Address" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="farm" class="form-label">Farm Name</label>
                                                    <input type="text" name="farm" id="farm" class="form-control" placeholder="Enter Farm" required />
                                                </div>

                                                <!-- <div class="mb-3">
                                                    <label for="location" class="form-label">Location</label>
                                                    <input type="text" name="location" id="location" class="form-control" placeholder="Enter Location" required />
                                                </div> -->

                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" id="updateFarmLeader">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <!--End Edit FarmLeader Modal-->

                            <!-- Modal -->
                            <div class="modal fade" id="adminArchiveShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="farm-name">&nbsp;</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">

                                                <div class="mt-4 text-center">
                                                    <input type="hidden" id="archive-adminID" class="form-control" placeholder="ID" readonly />
                                                    <h4>You are about to archive this user: <span id="archive-admin-name"></span></h4>
                                                    <p class="text-muted fs-15 mb-4">Deleting this user will also delete the associated farm, farm location, and farmers on that farm. Are you sure you want to proceed?</p>
                                                    <div class="hstack gap-2 justify-content-center remove">
                                                        <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                        <button type="button" class="btn btn-danger" id="archive-farmleader-btn">Yes, Archive It</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
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

</div>
<!-- END layout-wrapper -->

<script>
    $(document).ready(function() {
        $(".download-farmleaders").click(function() {
            var table = $('#farmerLeader-tbl').clone();

            // Add user's first name, last name, and current date to the table
            var userFirstName = "<?php echo Auth::user()->firstname; ?>";
            var userLastName = "<?php echo Auth::user()->lastname; ?>";
            var currentDate = new Date().toLocaleDateString();
            var userRow = $('<tr><td colspan="6">Prepared by: ' + userFirstName + ' ' + userLastName + '</td></tr>');
            var dateRow = $('<tr><td colspan="6">Date: ' + currentDate + '</td></tr>');
            table.append(userRow); // Append at the bottom
            table.append(dateRow); // Append at the bottom

            exportTableToCSV(table);
        });
    });

    function exportTableToCSV(table) {
        var rows = table.find('tr').get();
        var csvContent = '';

        // Iterate over table rows
        rows.forEach(function(row) {
            var rowData = [];
            $(row).find('td').each(function() {
                rowData.push($(this).text());
            });
            csvContent += rowData.join(',') + '\n';
        });

        var currentDate = new Date().toLocaleDateString();
        var userFirstName = "<?php echo Auth::user()->firstname; ?>";
        var userLastName = "<?php echo Auth::user()->lastname; ?>";

        csvContent += 'Date: ' + currentDate + '\n';
        csvContent += 'Prepared by: ' + userFirstName + ' ' + userLastName + '\n';

        var blob = new Blob([csvContent], {
            type: 'text/csv;charset=utf-8;'
        });

        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month as it's zero-based
        var day = currentDate.getDate().toString().padStart(2, '0');
        var formattedDate = year + '-' + month + '-' + day;

        var filename = 'farmerleaders_' + formattedDate + '.csv';

        if (navigator.msSaveBlob) { // IE 10+
            navigator.msSaveBlob(blob, filename);
        } else {
            var link = document.createElement("a");
            if (link.download !== undefined) { // Feature detection
                var url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('.search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#farmerLeader-tbl tbody tr').filter(function() { // Only target tbody rows
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


@include('templates.footer')




<!-- END OF ACTION -->