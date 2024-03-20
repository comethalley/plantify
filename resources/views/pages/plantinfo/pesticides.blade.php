@include('templates.header')


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
                                <li class="breadcrumb-item active">Suppliers</li> -->
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
                                    <h5 class="card-title mb-0">Pesticides</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add New Plant</button>
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

                                                <th class="sort" data-sort="">#</th>
                                                <th class="sort" data-sort="">Name</th>
                                                <th class="sort" data-sort="">Image</th>
                                                <th class="sort" data-sort="">Information</th>
                                                <th class="sort" data-sort="">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">

                                            @foreach($pesticides as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->pes_name }}</td>
                                                <td><img src="/images/{{ $item->pes_image }}" alt="" width="200px" height="200px"></td>
                                                <td>{{ $item->pes_information }}</td>
                                               
                                            
                                                



                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                            <a href="" class="text-primary d-inline-block supplier_btn" data-bs-target="#viewModal" data-bs-toggle="modal" data-supplier-id="">
                                                                <i class="ri-eye-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                            <a href="" class="text-primary d-inline-block edit-item-btn" data-plantinfo-id="{{$item->id}}">
                                                                <i class="ri-pencil-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                            <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder" data-plantinfo-id="{{$item->id}}">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                        
                                                    </ul>
                                                </td>




                                        </tbody>
                                        @endforeach
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


                            <!--Add Pesticides Modal-->

                            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Pesticides</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Name</label>
                                                    <input type="text" name="pes_name" id="pes_name" class="form-control" placeholder="Pesticide Name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <div>
                                                        <label for="formFile" class="form-label">Upload</label>
                                                        <input class="form-control" type="file" id="pes_image">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Information</label>
                                                    <textarea type="textarea" name="pes_information" id="pes_information" class="form-control" placeholder="Plant Information" required> </textarea>
                                                </div>





                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success add-pesticide">Add Pesticide</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Update modal -->


                            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Plant Information</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ url('plantinfo/') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="hidden" id="plantID" class="form-control" placeholder="ID" />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Plant Name</label>
                                                    <input type="text" name="plant_name" id="edit_plant_name" class="form-control" placeholder="Plant Name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Planting Date</label>
                                                    <input type="text" name="supplier-name" id="edit_plant_date" class="form-control" placeholder="Plant Name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Information</label>
                                                    <textarea type="textarea" name="description" id="edit_information" class="form-control" placeholder="Plant Information" required> </textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Plant Image</label>
                                                    <input type="text" name="address" id="edit_plant_image" class="form-control" placeholder="Image" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Companion</label>
                                                    <input type="text" name="address" id="edit_companion" class="form-control" placeholder="Companion" required />
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-success" id="plantinfo-update">Save</button>
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
                                                    <form method="POST" action="" style="display:inline">
                                                        <input type="hidden" id="archiveID">
                                                        <button type="button" class="btn btn-danger" id="plantinfo-archive">Yes, Delete It</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
                            <!-- Modal -->
                            <div class="modal fade flip" id="viewModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-body p-5 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                            <div class="mt-4 text-center">
                                                <h4>You are about to delete a order ?</h4>
                                                <p class="text-muted fs-15 mb-4">Deleting your order will remove all of your information from our database.</p>
                                                <div class="hstack gap-2 justify-content-center remove">
                                                    <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                    <form method="POST" action="" style="display:inline">
                                                        <input type="hidden" id="archiveID">
                                                        <button type="button" class="btn btn-danger" id="plantinfo-archive">Yes, Delete It</button>
                                                    </form>
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