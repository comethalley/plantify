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
                        <h4 class="mb-sm-0">Inventory</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                <li class="breadcrumb-item active">Fertilizer</li>
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
                                    <h5 class="card-title mb-0">Fertilizer list</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#uomShowModal"><i class="ri-add-line align-bottom me-1"></i> Add Fertilizer</button>
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
                                            <input type="text" class="form-control search" placeholder="Search for order ID, customer, order status or something...">
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
                                    <table class="table table-nowrap align-middle" id="fertilizerTable">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">
                                                <th scope="col" style="width: 25px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="id">ID</th>
                                                <th class="sort" data-sort="customer_name">Fertilizer Name</th>
                                                <th class="sort" data-sort="customer_name">Image</th>
                                                <th class="sort" data-sort="city">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all" id="fertilizer-table">

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
                            <!--Create UOM Modal-->
                            <div class="modal fade" id="uomShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Fertilizer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" id="id-field" />

                                            <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Enter Fertilizer Name</label>
                                                <input type="text" name="measurementname" id="fertilizer-name" class="form-control" placeholder="Ex. Bone Meal" required />
                                            </div>

                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Upload Fertilizer Image</label>
                                                <input type="file" name="measurementname" id="fertilizer-image" class="form-control" placeholder="Ex. Per Pack" accept=".jpeg, .jpg, .png" required />
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success" id="add-fertilizer-btn">Add</button>
                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Create UOM Modal-->

                            <!--Edit UOM Modal-->
                            <div class="modal fade" id="uomEditShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Fertilizer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" id="id-field" />

                                            <input type="hidden" id="edit-fertilizer-id" class="form-control" placeholder="ID" readonly />

                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Enter Fertilizer Name</label>
                                                <input type="text" name="measurementname" id="edit-fertilizer-name" class="form-control" placeholder="Ex. Bone Meal" required />
                                            </div>

                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Fertilizer Image</label> <br>
                                                <img src="" alt="" id="fertilizer-photo" style="width:150px;height:150px;">
                                            </div>

                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Upload Fertilizer Image</label>
                                                <input type="file" name="measurementname" id="edit-fertilizer-image" class="form-control" placeholder="Ex. Per Pack" accept=".jpeg, .jpg, .png" required />
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success" id="edit-fertilizer-btn">Edit</button>
                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Edit UOM Modal-->

                            <!--Archive UOM Modal -->
                            <div class="modal fade" id="uomArchiveShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <!-- <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="farm-name">&nbsp;</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div> -->
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mt-4 text-center">
                                                    <input type="hidden" id="archive-fertilizerID" class="form-control" placeholder="ID" />
                                                    <h4>You are about to archive <span id="archive-uom-name"></span> fertilizer?</h4>
                                                    <p class="text-muted fs-15 mb-4">Are you sure you want to proceed ?</p>
                                                    <div class="hstack gap-2 justify-content-center remove">
                                                        <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                        <button type="button" class="btn btn-danger" id="archive-fertilizer-btn">Yes, Archive It</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Archive UOM Modal-->
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
    console.log("Hello uom js is here");
    $(document).ready(function() {
        getFertilizer();

        function getFertilizer() {
            $.ajax({
                url: "/get-fertilizer",
                method: "GET",
                success: function(data) {
                    console.log(data);
                    // $("#uom-table").html(data)
                    populateFertilizerTable(data);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error, xhr);
                },
            });
        }

        function populateFertilizerTable(data) {
            var tableBody = $("#fertilizerTable tbody");
            tableBody.empty();

            $.each(data.fertilizers, function(index, uom) {
                var row =
                    "<tr> <th scope='row'><div class='form-check'><input class='form-check-input' type='checkbox' name='checkAll' value='option1'></div></th>" +
                    "<td class='id'># " +
                    uom.id +
                    "</td>" +
                    "<td class='customer_name'>" +
                    uom.fertilizer_name +
                    "</td>" +
                    "<td class='customer_name'><img src='" +
                    "{{ asset('') }}" +
                    "images/" +
                    uom.image +
                    "' alt='Fertilizer Image' style='width: 100px;'></td>" + // Adjust width as needed
                    "<td><ul class='list-inline gap-2 mb-0'><li class='list-inline-item edit' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Edit'><a href='' class='text-primary d-inline-block edit_uom_btn' data-uom-id='" +
                    uom.id +
                    "' data-uom-name='" +
                    uom.fertilizer_name +
                    "'data-uom-image='" +
                    uom.image +
                    "'><i class='ri-pencil-fill fs-16'></i></a></li><li class='list-inline-item' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Remove'><a class='text-danger d-inline-block archive_uom_btn' href='' data-uom-id='" +
                    uom.id +
                    "' data-uom-name='" +
                    uom.fertilizer_name +
                    "'><i class='ri-delete-bin-5-fill fs-16'></i></a></li></ul></td>" +
                    "</tr>";

                tableBody.append(row);
            });
        }





        function updateUOM() {
            var unitID = $("#edit-fertilizer-id").val();
            var editfertilizerName = $("#edit-fertilizer-name").val();
            var editfertilizerImage = $("#edit-fertilizer-image")[0].files[0];

            var formData = new FormData(); // Create FormData object
            formData.append("fertilizerName", editfertilizerName);
            formData.append("fertilizerImage", editfertilizerImage);


            $.ajax({
                url: "/edit-fertilizer/" + unitID,
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: formData, // Use formData instead of a plain object
                processData: false, // Prevent jQuery from processing the data
                contentType: false,
                success: function(data) {
                    $("#uomEditShowModal").modal("hide");
                    Swal.fire({
                        title: "Successfully Updated",
                        icon: "success",
                    });
                    console.log(data);
                    getFertilizer();
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = JSON.parse(xhr.responseText);
                        console.error("Validation Error:", errors);
                    } else {
                        console.error("Error:", error);
                    }
                },
            });
        }

        function archiveUOM() {
            var unitID = $("#archive-fertilizerID").val();
            // var unitName =  $('#edit-unit-name').val()

            $.ajax({
                url: "/archive-fertilizer/" + unitID,
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(data) {
                    $("#uomArchiveShowModal").modal("hide");
                    Swal.fire({
                        title: "Successfully Archived",
                        icon: "success",
                    });
                    console.log(data);
                    getFertilizer();
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = JSON.parse(xhr.responseText);
                        console.error("Validation Error:", errors);
                    } else {
                        console.error("Error:", error);
                    }
                },
            });
        }

        $("#add-fertilizer-btn").on("click", function() {
            console.log("add-fertilizer-btn is clicked");
            var fertilizerName = $("#fertilizer-name").val();
            var fertilizerImage = $("#fertilizer-image")[0].files[0]; // Get the image file

            var formData = new FormData(); // Create FormData object
            formData.append("fertilizerName", fertilizerName);
            formData.append("fertilizerImage", fertilizerImage);

            $.ajax({
                url: "/add-fertilizer",
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: formData, // Use formData instead of a plain object
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting contentType
                success: function(data) {
                    $("#uomShowModal").modal("hide");
                    Swal.fire({
                        title: "Successfully Added",
                        icon: "success",
                    });
                    console.log(data);
                    getFertilizer();
                    $("#uomShowModal").modal("hide");
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = JSON.parse(xhr.responseText);
                        console.error("Validation Error:", errors);
                    } else {
                        console.error("Error:", error);
                    }
                },
            });
        });


        $("#edit-fertilizer-btn").on("click", function() {
            updateUOM();
        });

        $("#archive-fertilizer-btn").on("click", function() {
            archiveUOM();
        });

        $(document).on("click", ".edit_uom_btn", function(event) {
            event.preventDefault();

            var uomID = $(this).data("uom-id");
            var uomName = $(this).data("uom-name");
            var uomImage = $(this).data("uom-image");

            var imagePath = "{{ asset('') }}images/" + uomImage
            //alert(uomImage)

            console.log("Uom ID is " + uomID);
            $("#edit-fertilizer-id").val(uomID);
            $("#edit-fertilizer-name").val(uomName);
            $("#fertilizer-photo").attr("src", imagePath);

            $("#uomEditShowModal").modal("show");
        });

        $(document).on("click", ".archive_uom_btn", function(event) {
            event.preventDefault();

            var uomID = $(this).data("uom-id");
            var uomName = $(this).data("uom-name");

            console.log("Uom ID is " + uomID);
            $("#archive-fertilizerID").val(uomID);
            $("#archive-uom-name").text(uomName);

            $("#uomArchiveShowModal").modal("show");
        });
    });
</script>

@include('templates.footer')