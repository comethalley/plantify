@include('templates.header')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
           
           @foreach($piu as $plant_info)
            <div class="col-sm-6 col-xl-3">
                            <!-- Simple card -->
                            <div class="card">
                                <img class="card-img-top img-fluid" src="/assets/images/talong.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title mb-2 text-center md-5 ">{{ $plant_info->plant_name}}</h4>
                                    
                                    <div class="text-end">
                                    <a href="{{ url('show', $plant_info->id) }}" class="btn btn-success add-btn d-flex justify-content-center align-items-center" >See more</a>
                                    </div>
                                </div>
                            </div><!-- end card -->
                        </div>
                        @endforeach
             


                         </div> 
                    </div>  
              </div>   
         </div>

   <!-- last -->

    <!--MORE-->
    <!-- @foreach($piu as $plant_info)
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                
                                            
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                              

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Plant Name: {{ $plant_info->plant_name}}</label>
                                                    
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Planting Date : {{ $plant_info->planting_date}}</label>
                                                    
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Information : {{ $plant_info->information}}</label>
                                                   

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Companion : {{ $plant_info->companion}} </label>
                                                    
                                                </div>  

                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal" >Ok</button>
                                                    <button type="button" class="btn btn-success" id="edit-btn">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                </div> -->
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- end main content-->

</div>
@include('templates.footer')