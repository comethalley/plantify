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
                        <!-- <h4 class="mb-sm-0">Inventory</h4> -->

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                <li class="breadcrumb-item active">Unit of Measurements</li> -->
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
                                    <h5 class="card-title mb-0">Hourly Weather Data For Quezon City</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form>
                                <div class="row g-3">
                                    <div class="col-xl-3 ">                                      
                                    <div class="mt-3">
                                        <label class="form-label mb-0">Search Date</label>
                                        <div class="d-flex align-items-center ">
                                         <input type="text" class="form-control flatpickr-input me-2" data-provider="flatpickr" data-date-format="d M, Y" data-deafult-date="25 12,2021" readonly="readonly">
                                         <button type="button" class="btn btn-primary bg-gradient
                                             waves-effect waves-light mdi mdi-magnify search-widget-icon"></button>
                                        </div>
                                          </div>
                                </div>
                                </div><br>
                                <!--end row-->
                                <!-- Another Calender -->
                                <!-- <div >
                                        <label for="exampleInputdate" class="form-label">Input Date</label>
                                        <div class="d-flex align-items-center ">
                                            <input type="date" class="form-control me-2" id="exampleInputdate">
                                            <button type="button" class="btn btn-primary bg-gradient
                                             waves-effect waves-light mdi mdi-magnify search-widget-icon"></button>
                                        </div> -->
                            </form>
                        </div>
                        <div class="card-body pt-0">
                            <div>

                                <div class="table-responsive table-card mb-1">
                                    <table class="table table-nowrap align-middle" id="uomTable">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">
                                                <th scope="col" style="width: 25px;">
                                                    
                                                </th>
                                                <th class="sort" data-sort="time">Time</th>
                                                <th class="sort" data-sort="temperature">Temperature</th>
                                                <th class="sort" data-sort="windspeed">Wind Speed</th>
                                                <th class="sort" data-sort="humidity">Humidity</th>
                                                <th class="sort" data-sort="uvindex">UV Index</th>
                                                <th class="sort" data-sort="condition">Condition</th>
                                                <th class="sort" data-sort="visibility">Visibility (mi)</th>
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
                            <!--Create Supplier Modal-->
                            <div class="modal fade" id="uomShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Unit of Measurement</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" id="id-field" />

                                            <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Enter Measurement Name</label>
                                                <input type="text" name="measurementname" id="unit-name" class="form-control" placeholder="Ex. Per Pack" required />
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success" id="add-uom-btn">Add</button>
                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                            </div>
                                        </div>
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