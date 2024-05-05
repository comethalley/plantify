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
                                    <h5 class="card-title mb-0">Plant Information</h5>
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
                                                <th class="sort" data-sort="">Plant Name</th>
                                                <th class="sort" data-sort="">Image  </th>
                                                <th class="sort" data-sort="">Season</th>
                                                <!-- <th class="sort" data-sort="">Information</th> -->
                                                <th class="sort" data-sort="">Companion</th>
                                                <th class="sort" data-sort="">Days of Harvest</th>
                                                <th class="sort" data-sort="">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">

                                            @foreach($plantinfo as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->plant_name }}</td>
                                                <td width="200px" height="100px"><img src="/images/{{ $item->image }}" > </td>
                                                <td>{{ $item->seasons }}</td>
                                                <!-- <td>{!! $item->information !!}</td> -->
                                                <td>{{ $item->companion }}</td>
                                                <td>{{ $item->days_harvest }}</td>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <!-- <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                            <a href="" class="text-primary d-inline-block supplier_btn" data-bs-target="#viewModal" data-bs-toggle="modal" data-supplier-id="">
                                                                <i class="ri-eye-fill fs-16"></i>
                                                            </a>
                                                        </li> -->
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
                                                        <!-- <a href="{{ url('/plantinfo/' . $item->id) }}" title="View Plant"><button class="btn btn-info btn-sm" data-bs-target="#EditModal"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/plantinfo/' . $item->id . '/edit') }}" title="Edit Plant"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/plantinfo' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Plant" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form> -->
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


                            <!--Add Plantinfo Modal-->

                            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Plant Information</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="text" id="orderId" class="form-control" placeholder="ID" readonly hidden />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Plant Name</label>
                                                    <input type="text" name="plant_name" id="plant_name" class="form-control" placeholder="Plant Name" required />
                                                </div>

                                                <!-- <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Season</label>
                                                    <input type="date" name="planting_date" id="planting_date" class="form-control" required />
                                                </div> -->
                                                <div class="mb-3">
                                                    <!-- <label for="customername-field" class="form-label">Season</label> -->
                                                    <div class="form-group">
                                                        <label for="mode">Season</label>
                                                        <select class="form-select" id="seasons">
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May </option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                            <option value="All Season">All Season</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div>
                                                        <label for="formFile" class="form-label">Upload</label>
                                                        <input class="form-control" type="file" id="image">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Information</label>
                                                    <!-- <input type="text" name="information" id="information" class="form-control" placeholder="Plant Information" required /> -->
                                                    <div id="editor">

                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Companion</label>
                                                    <input type="text" name="companion" id="companion" class="form-control" placeholder="Companion" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Days of Harvest</label>
                                                    <input type="number" name="day_harvest" id="day_harvest" class="form-control" placeholder="No. of Days" required />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-success add-plant">Add Plant</button>
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!-- Update modal -->


                            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Plant Information</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ url('plantinfo/') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <input type="hidden" id="plantID" class="form-control" placeholder="ID" />

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Plant Name</label>
                                                    <input type="text" name="plant_name" id="edit_plant_name" class="form-control" placeholder="Plant Name" required />
                                                </div>

                                                <div class="mb-3">
                                                <label for="mode">Season</label>            
                                                        <select class="form-select" id="edit_seasons">
                                                        <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May </option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                            <option value="All Season">All Season</option>
                                                        </select>
                                                        
                                                </div>
                                                <div class="mb-3">
                                                <label for="customername-field" class="form-label">Information</label>
                                                    <!-- <input type="text" name="information" id="edit_information" class="form-control" placeholder="Plant Information" required /> -->
                                                    <div id="edit-editor">

                                                    
                                                </div>
                                                </div>      
                                                <div class="mb-3">
                                                          
                                                          <img src=""  alt="" srcset="" id="edit_image_preview" width="200px" height="200px" >
                                                          <label for="formFile" class="form-label"></label>
                                                        <input class="form-control" type="file" id="edit_image" name="edit_image">
                                                </div>
                                                $('#edit_image').on('change', function() {
                                                    var file = this.files[0];
                                                    var reader = new FileReader();
                                                    reader.onload = function(e) {
                                                        $('#edit_image_preview').attr('src', e.target.result);
                                                    };
                                                    reader.readAsDataURL(file);
                                                });

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Companion</label>
                                                    <input type="text" name="address" id="edit_companion" class="form-control" placeholder="Companion" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Days to Harvest</label>
                                                    <input type="number" name="address" id="edit_days_harvest" class="form-control" placeholder="No. of Days" required />
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

<script>
    $(document).ready(function(){
    $("#").click(function(){
        $('.modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $("#").modal("hide")
        $("#").modal("show")
    });
});

 
$("#create").click(function(){
    $('#showModal').modal('hide');
    Swal.fire({
        title: "Successfully added",
        text: "Are you ready for the next level?", <br>
        icon: "success",
        showConfirmButton: false // Remove the OK button
    });
});

</script>


<!-- END layout-wrapper -->
<!-- 
<div class="main-content">
    <div class="row" style="margin:100px;">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Plant Info</h2>
                </div>
                <div class="card-body">
                    <a href="{{ url('/plantinfo/create') }}" class="btn btn-success btn-sm" title="Add New Student">
                        Add New
                    </a>
                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plant Name</th>
                                    <th>Info</th>
                                    <th>Companion</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plantinfo as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->plant_name }}</td>
                                    <td>{{ $item->information }}</td>
                                    <td>{{ $item->companion }}</td>

                                    <td>
                                        <a href="{{ url('/plantinfo/' . $item->id) }}" title="View Plant"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/plantinfo/' . $item->id . '/edit') }}" title="Edit Plant"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/plantinfo' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Plant" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> -->
<script>
    $('#edit_image').on('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#edit_image_preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
</script>

@include('templates.footer')