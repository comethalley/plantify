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
                                <li class="breadcrumb-item active">Suppliers</li>
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
                                    <h5 class="card-title mb-0">Supplier List</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Supplier</button>
                                        <button type="button" class="btn btn-primary download-btn"><i class="ri-download-2-line"></i> Download</button>
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
                            <div id="supplier-tbl">


                            </div>
                            <!--Create Supplier Modal-->
                            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Supplier Name</label>
                                                    <input type="text" name="supplier-name" id="supplier-name" class="form-control" placeholder="Enter name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Description</label>
                                                    <input type="text" name="description" id="supplier-description" class="form-control" placeholder="Enter Description" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Address</label>
                                                    <input type="text" name="address" id="supplier-address" class="form-control" placeholder="Enter Address" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Contact</label>
                                                    <input type="text" name="contact" id="supplier-contact" class="form-control" placeholder="Enter Contact" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Email</label>
                                                    <input type="email" name="email" id="supplier-email" class="form-control" placeholder="Enter Email" required />
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" id="add-supplier">Add Supplier</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Create Supplier Modal-->

                            <!--Edit Supplier Modal-->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="farm-name">&nbsp;</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="edit-supplier-id" />

                                                <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Supplier Name</label>
                                                    <input type="text" name="supplier-name" id="edit-supplier-name" class="form-control" placeholder="Enter name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Description</label>
                                                    <input type="text" name="description" id="edit-supplier-description" class="form-control" placeholder="Enter Description" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Address</label>
                                                    <input type="text" name="address" id="edit-supplier-address" class="form-control" placeholder="Enter Address" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Contact</label>
                                                    <input type="text" name="contact" id="edit-supplier-contact" class="form-control" placeholder="Enter Contact" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Email</label>
                                                    <input type="email" name="email" id="edit-supplier-email" class="form-control" placeholder="Enter Email" required />
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" id="edit-supplier">Edit Supplier</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Edit Supplier Modal-->

                            <!--Archive Supplier Modal-->
                            <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <input type="hidden" id="archive-supplierID" class="form-control" placeholder="ID" />
                                                    <lord-icon src="https://cdn.lordicon.com/drxwpfop.json" trigger="hover" style="width:100px;height:100px">
                                                    </lord-icon>
                                                    <h4>You are about to archive <span id="archive-supplier-name"></span>?</h4>
                                                    <p class="text-muted fs-15 mb-4">Are you sure you want to proceed ?</p>
                                                    <div class="hstack gap-2 justify-content-center remove">
                                                        <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                        <button type="button" class="btn btn-danger" id="delete-record">Yes, Archive It</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Archive Supplier Modal-->

                            <!--View Supplier Modal-->
                            <div class="modal fade modal-xl" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="farm-name"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>

                                        <form method="post" action="/add-supplier">

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="fs-15" id="supplier_name">
                                                        </h5>
                                                        <p class="text-muted" id="supplier_description"></p>
                                                    </div>
                                                </div>
                                                <h5 class="fs-15">
                                                    Add Seeds from this Supplier
                                                </h5>
                                                <div class="row">
                                                    <input type="hidden" name="supplier-id" id="supplier-id" class="form-control" readonly />
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <input type="file" name="image" id="image" class="form-control" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <select class="form-select" id="seed">
                                                                <option selected="" value="0">Choose Seed</option>
                                                                @foreach($seeds as $per_seeds)
                                                                <option value="{{ $per_seeds->id }}">{{ $per_seeds->plant_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-lg-3">
                                                        <div class="input-group">
                                                            <select class="form-select" id="uom">
                                                                <option selected="" value="0">Unit of Measurement</option>
                                                                @foreach($uom as $per_uom)
                                                                <option value="{{ $per_uom->id }}">{{ $per_uom->description }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            <input type="text" name="qty" id="qty" class="form-control" placeholder="Enter Qty" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <button type="button" class="btn btn-success add-btn" id="seed-btn"><i class="ri-add-line align-bottom me-1"></i></button>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="id-field" />
                                                <div class="row">
                                                    <div class="col-md-12" id="supplier-seed">

                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End View Supplier Modal-->

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



@include('templates.footer')