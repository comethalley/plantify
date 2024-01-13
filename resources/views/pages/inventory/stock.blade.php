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
                                <li class="breadcrumb-item active">Stocks</li>
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
                                    <h5 class="card-title mb-0">Stocks List</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#receiveModal"><i class="ri-add-line align-bottom me-1"></i> Receiving</button>
                                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#usingModal"><i class="ri-add-line align-bottom me-1"></i> Planting</button>
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
                                    <table class="table table-nowrap align-middle" id="orderTable">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">
                                                <th scope="col" style="width: 25px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="id">ID</th>
                                                <th class="sort" data-sort="customer_name">Code</th>
                                                <th class="sort" data-sort="date">Seed Name</th>
                                                <th class="sort" data-sort="amount">Supplier</th>
                                                <th class="sort" data-sort="payment">Available</th>
                                                <th class="sort" data-sort="payment">Used</th>
                                                <th class="sort" data-sort="payment">Total</th>
                                                <th class="sort" data-sort="city">Logs</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($stocks as $per_stocks)

                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td class="id">#{{ $per_stocks->stocksID }}</td>
                                                <td class="customer_name">{{ $per_stocks->qr_code }}</td>
                                                <td class="date">{{ $per_stocks->seedName }}</td>
                                                <td class="amount">{{ $per_stocks->supplier_name }}</td>
                                                <td class="payment text-success">
                                                    {{ $per_stocks->available }}
                                                </td>
                                                <td class="payment text-danger">
                                                    -&nbsp;{{ $per_stocks->used }}
                                                </td>
                                                <td class="payment">{{ $per_stocks->total }}</td>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info waves-effect waves-light w-xs logs-btn" data-bs-toggle="modal" data-bs-target="#logModal" data-logs-id="{{ $per_stocks->stocksID }}">Logs</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class=" noresult" style="display: none">
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
                            <!--Receiving Modal-->
                            <div class="modal fade" id="receiveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Receiving Scanner</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <video id="preview" style="width: 100%;"></video>
                                                <center>
                                                    <p class="lead text-danger" id="received-qr"></p>
                                                </center><br>
                                                <div class="mb-3">
                                                    <label for="multiple-receive" class="form-label">Multiple Items</label>
                                                    <input type="text" id="multiple-receive" class="form-control" value="1" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" id="receive-scan">Scan</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Receiving Modal-->

                            <!--Using Modal-->
                            <div class="modal fade" id="usingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Planting Scanner</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <video id="using-preview" style="width: 100%;"></video>
                                                <center>
                                                    <p class="lead text-danger" id="used-qr"></p>
                                                </center><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="multiple-used" class="form-label">Multiple Items</label>
                                                            <input type="text" id="multiple-used" class="form-control" value="1" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mode">Mode</label>
                                                            <select class="form-select" id="mode">
                                                                <option value="1">Per pack/box</option>
                                                                <option value="2">Per pieces</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" id="using-scan">Scan</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Using Modal-->

                            <!--Logs Modal-->
                            <div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Logs</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12" id="log-table"></div>
                                                </div>
                                            </div>
                                            <!-- <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" id="receive-scan">Scan</button>
                                                </div>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Log Modal-->

                            <!--Login Modal-->
                            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="/add-supplier">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="text" class="form-control" id="logs-id" placeholder="Enter your email">
                                                <h5 class="mb-3">Please Input Your Credentials</h5>
                                                <div class="mb-2">
                                                    <input type="email" class="form-control" id="logs-email" placeholder="Enter your email">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="password" class="form-control" id="logs-password" placeholder="Enter your password">
                                                </div>
                                                <button type="button" class="btn btn-primary w-100" id="void-btn">Submit</button>
                                            </div>
                                            <!-- <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" id="receive-scan">Scan</button>
                                                </div>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End of Login Modal-->

                            <!--View Supplier Modal-->
                            <!--  -->
                            <!--End Supplier Modal-->

                            <!-- Modal -->
                            <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-5 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                            <div class="mt-4 text-center">
                                                <h4>You are about to delete a order ?</h4>
                                                <p class="text-muted fs-15 mb-4">Deleting your order will remove all of your information from our database.</p>
                                                <div class="hstack gap-2 justify-content-center remove">
                                                    <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                    <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                                </div>
                                            </div>
                                        </div>
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


@include('templates.footer')