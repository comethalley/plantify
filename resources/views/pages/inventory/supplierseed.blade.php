<div class="table-responsive table-card mb-1">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Code</th>
                <th scope="col">Type</th>
                <th scope="col">Seed Name</th>
                <th scope="col">Image</th>
                <th scope="col">Measurement</th>
                <th scope="col">Quantity</th>
                <th scope="col">QR Code</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        @if (count($supplierSeeds) == 0)
        <tbody>
            <tr>
                <td colspan="8" style='text-align:center; vertical-align:middle'>There is no data</td>
            </tr>
        </tbody>
        @else
        <tbody>
            @foreach ($supplierSeeds as $per_Seeds)
            <tr>

                <td>{{$per_Seeds->suppliers_seedsID}}</td>
                <td>{{$per_Seeds->qr_code}}</td>
                <td>{{$per_Seeds->type}}</td>
                <td>{{$per_Seeds->seedName}}</td>
                <td><img src="/images/{{$per_Seeds->image}}" alt="" style="max-width: 100px;max-height:100px;float: none;"></td>
                <td>{{$per_Seeds->umoName}}</td>
                <td><input class="form-control form-control-sm update-qty" type="text" name="quantity" data-supplierseed-id="{{$per_Seeds->suppliers_seedsID}}" id="quantity_{{$per_Seeds->suppliers_seedsID}}" value="{{$per_Seeds->qty}}"> </td>
                <td><a href="{{ route('download.image', ['filename' => $per_Seeds->qr_code . '.png']) }}" id="downloadQrBtn" data-supplier-id="{{$per_Seeds->supplierID}}" target="_blank"><i class="ri-download-2-line"></i>&nbsp;Download</a></td>
                <td>
                    <ul class="list-inline hstack gap-2 mb-0">
                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                            <a class="text-danger d-inline-block archive-supply-btn" data-supply-id="{{$per_Seeds->suppliers_seedsID}}">
                                <i class="ri-delete-bin-5-fill fs-16"></i>
                            </a>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
</div>

<!--Archive Admin Modal -->
<div class="modal fade" id="seedArchiveShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" id="archive-adminID" class="form-control" placeholder="ID" readonly />
                        <h4>You are about to archive a item on this supplier<span id="archive-admin-name"></span></h4>
                        <p class="text-muted fs-15 mb-4">Are you sure you want to proceed ?</p>
                        <div class="hstack gap-2 justify-content-center remove">
                            <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                            <button type="button" class="btn btn-danger" id="archive-seed-btn">Yes, Archive It</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<!--end Archive Admin modal -->

<script>
    $(document).ready(function() {
        $("#downloadQrBtn").on("click", function(event) {
            event.preventDefault();
            console.log("Download initiated...");

            var downloadUrl = $(this).attr('href'); // Get the download URL from the anchor tag
            var supplierID = $(this).data('supplier-id');

            window.location.href = downloadUrl;

            // Optionally, you can still call getSupplierSeeds function if needed
            getSupplierSeeds(supplierID);
        });


        function getSupplierSeeds(supplierId) {

            $.ajax({
                url: "/getSupplierSeeds/" + supplierId,
                method: "GET",
                success: function(data) {
                    // console.log("Supplier data is", data);

                    // $('.modal-title').text(data.name)
                    // $('#supplier_name').text("About " + data.name)
                    // $('#supplier_description').text(data.description)
                    $('#supplier-seed').html(data)
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });
        }

        $('.update-qty').on('change', function() {
            var supplierSeedID = $(this).data('supplierseed-id');
            var qty = $("#quantity_" + supplierSeedID).val();

            console.log("The supplierSeedID is " + supplierSeedID)
            console.log("The quantity is " + qty)

            $.ajax({
                url: "/edit-qty/" + supplierSeedID,
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'qty': qty
                },
                success: function(data) {
                    console.log(data)
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = JSON.parse(xhr.responseText);
                        console.error("Validation Error:", errors);
                    } else {
                        console.error("Error:", error);
                    }
                }
            });
            //getLogs(stockID);
        });

        $("#archive-seed-btn").on("click", function() {
            var adminID = $("#archive-adminID").val();
            // var unitName =  $('#edit-unit-name').val()

            $.ajax({
                url: "/archiveSeed/" + adminID,
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(data) {
                    console.log(data);
                    // getAdmins();
                    getSupplierSeeds(data.supplier)
                    $("#seedArchiveShowModal").modal("hide");
                    Swal.fire({
                        title: "Successfully Archive",
                        // text: "Are you ready for the next level?",
                        icon: "success",
                        showConfirmButton: false, // Remove the OK button
                        timer: 2000,
                    });
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = JSON.parse(xhr.responseText);
                        console.error("Validation Error:", errors);
                        Swal.fire({
                            title: "Validation Error: " + errors,
                            // text: "Are you ready for the next level?",
                            icon: "error",
                            showConfirmButton: false, // Remove the OK button
                            timer: 2000,
                        });
                    } else {
                        console.error("Error:", error);
                    }
                },
            });
        });

        $(document).on("click", ".archive-supply-btn", function(event) {
            event.preventDefault();

            var userID = $(this).data("supply-id");

            console.log("Uom ID is " + userID);
            $("#archive-adminID").val(userID);


            $("#seedArchiveShowModal").modal("show");
        });
    })
</script>