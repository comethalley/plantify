@include('templates.header')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Request List</h5>
                                </div>
                                <!-- <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Order</button>
                                        <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button>
                                        <button class="btn btn-soft-danger" id="remove-actions" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form>
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Search">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->

                                    <!--end col-->

                                    <!--end col-->

                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link All py-3 active" data-bs-toggle="tab" id="All" href="#home1" role="tab" aria-selected="true">
                                            <i class="ri-store-2-fill me-1 align-bottom"></i> All
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3 Delivered" data-bs-toggle="tab" id="Delivered" href="#delivered" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Request List
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3 Delivered" data-bs-toggle="tab" id="Delivered" href="#delivered" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Available List
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3 Pickups" data-bs-toggle="tab" id="Pickups" href="#pickups" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-truck-line me-1 align-bottom"></i> Approval List
                                        </a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" id="Cancelled" href="#cancelled" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-inbox-archive-line me-1 align-bottom"></i> Picking
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-3 Returns" data-bs-toggle="tab" id="Returns" href="#returns" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Returnees
                                        </a>
                                    </li>
                                </ul>

                                <div class="table-responsive table-card mb-1">
                                    <table class="table table-nowrap align-middle" id="orderTable">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">

                                                <th data-sort="id">ID</th>
                                                <th data-sort="customer_name">Supply Type</th>
                                                <th data-sort="customer_name">Supply Name</th>
                                                <th data-sort="product_name">Quantity</th>
                                                <th data-sort="date">Letter</th>
                                                <th data-sort="amount">Requested By</th>
                                                <th data-sort="payment">Farm Name</th>
                                                <th data-sort="payment">Status</th>
                                                <th data-sort="payment">Picking</th>
                                                <th data-sort="city">Set As</th>
                                                <th data-sort="city">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr>

                                                <td class="id"><a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">1</a></td>
                                                <td class="customer_name">Seedlings</td>
                                                <td class="product_name">Tomato</td>
                                                <td class="date">200 pcs</td>
                                                <td class="amount"><button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-eye-line align-bottom me-1"></i> View Letter</button></td>
                                                <td class="payment">Kenneth D. Bonita</td>
                                                <td class="payment">Ken's Urban Farm</td>
                                                <td class="status"><span class="badge bg-primary-subtle text-success text-uppercase">Picked</span></td>
                                                <td class="payment">March 29, 2024</td>
                                                <td>
                                                    <select class="form-select" id="type">
                                                        <option selected="" value="0">Set As</option>
                                                        <option value="Seedlings">Returned</option>
                                                        <option value="Seedlings">Failed to Returned</option>
                                                    </select>


                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="confirm()">Confirm</button>
                                                    <!-- <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal">Set Return Date</button> -->
                                                </td>
                                            </tr>

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
                                    <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0">
                                            <li class="active"><a class="page" href="#" data-i="1" data-page="8">1</a></li>
                                            <li><a class="page" href="#" data-i="2" data-page="8">2</a></li>
                                        </ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Set Return Date</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form class="tablelist-form" autocomplete="off">
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field">



                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">This Item must be returned at</label>
                                                    <input type="date" id="customername-field" class="form-control" placeholder="Enter name" required=""><br>
                                                    <!-- <input type="date" id="customername-field" class="form-control" placeholder="Enter name" required=""><br>
                                                    <input type="date" id="customername-field" class="form-control" placeholder="Enter name" required=""><br> -->
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" id="add-btn">Submit</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

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
            </div>
        </div>
    </div>

    <script>
        function confirm() {
            Swal.fire({
                title: "Successfully Set as Returned",
                icon: "success",
            });
        }
    </script>
    @include('templates.footer')