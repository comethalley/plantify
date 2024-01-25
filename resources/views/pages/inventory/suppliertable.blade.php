<div class="table-responsive table-card mb-1">
    <table class="table table-nowrap align-middle" id="orderTable">
        <thead class="text-muted table-light">
            <tr class="text-uppercase">
                <th scope="col" style="width: 25px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                    </div>
                </th>
                <th class="sort" data-sort="id">Supplier ID</th>
                <th class="sort" data-sort="customer_name">Supplier Name</th>
                <th class="sort" data-sort="date">Address</th>
                <th class="sort" data-sort="amount">Contact</th>
                <th class="sort" data-sort="payment">Email</th>
                <th class="sort" data-sort="city">Action</th>
            </tr>
        </thead>
        <tbody class="list form-check-all">
            @foreach ($supplier as $per_supplier)

            <tr>
                <th scope="row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                    </div>
                </th>
                <td class="id">#{{ $per_supplier->id }}</td>
                <td class="customer_name">{{ $per_supplier->name }}</td>
                <td class="date">{{ $per_supplier->address }}</td>
                <td class="amount">{{ $per_supplier->contact }}</td>
                <td class="payment">{{ $per_supplier->email }}</td>
                </td>
                <td>
                    <ul class="list-inline hstack gap-2 mb-0">
                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                            <a href="" class="text-primary d-inline-block supplier_btn" data-supplier-id="{{ $per_supplier->id }}">
                                <i class="ri-eye-fill fs-16"></i>
                            </a>
                        </li>
                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                            <a href="" class="text-primary d-inline-block edit_btn" data-supplier-id="{{ $per_supplier->id }}">
                                <i class="ri-pencil-fill fs-16"></i>
                            </a>
                        </li>
                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                            <a class="text-danger d-inline-block archive_btn" href="" data-supplier-id="{{ $per_supplier->id }}">
                                <i class="ri-delete-bin-5-fill fs-16"></i>
                            </a>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
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

<script>
    $(document).ready(function() {

        function getSupplier(supplierId) {
            console.log("Button is clicked !")
            console.log("Supplier ID is " + supplierId)

            $.ajax({
                url: "/getSupplier/" + supplierId,
                method: "GET",
                success: function(data) {
                    console.log("Supplier data is", data);

                    $('.farm-name').text(data.name)
                    $('#supplier_name').text("About " + data.name)
                    $('#supplier_description').text(data.description)

                    //for edit modal

                    $('#edit-supplier-name').val(data.name)
                    $('#edit-supplier-description').val(data.description)
                    $('#edit-supplier-address').val(data.address)
                    $('#edit-supplier-contact').val(data.contact)
                    $('#edit-supplier-email').val(data.email)

                    //$('#archive-supplierID').val(data.id)
                    $('#archive-supplier-name').text(data.name)
                    getSupplierSeeds(supplierId)
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });
        }

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


        $('.supplier_btn').on('click', function() {
            event.preventDefault();
            var supplierId = $(this).data('supplier-id');
            console.log(supplierId);
            $('#supplier-id').val(supplierId)
            getSupplier(supplierId);
            $("#viewModal").modal('show')
        });

        $('.edit_btn').on('click', function() {
            event.preventDefault();
            var supplierId = $(this).data('supplier-id');
            console.log(supplierId);
            $('#edit-supplier-id').val(supplierId)
            getSupplier(supplierId);
            $("#editModal").modal('show')
        });

        $('.archive_btn').on('click', function() {
            event.preventDefault();
            var supplierId = $(this).data('supplier-id');
            console.log(supplierId);
            $('#archive-supplierID').val(supplierId)
            getSupplier(supplierId);
            $("#archiveModal").modal('show')
        });
    });
</script>