@include('templates.header')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        
        <div class="col-12">
                     <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Plant Pesticide Information</h4>

                    </div>
        </div>
            <!-- start page title -->
            <div class="row">
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
                                                <th class="sort" data-sort="">Image</th>
                                                <th class="sort" data-sort="">Season</th>
                                                <th class="sort" data-sort="">Information</th>
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
                                                <td><img src="/images/{{ $item->image }}" alt="" width="200px" height="200px"></td>
                                                <td>{{ $item->seasons }}</td>
                                                <td>{!! $item->information !!}</td>
                                                <td>{{ $item->companion }}</td>
                                                <td>{{ $item->days_harvest }}</td>
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
           
          
             


                         </div> 
                    </div>  
              </div>   
         </div>

            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- end main content-->

</div>
@include('templates.footer')