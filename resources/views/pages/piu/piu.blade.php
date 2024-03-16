@include('templates.header')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        
        <div class="col-12">
                     <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Plant Information</h4>

                    </div>
        </div>
            <!-- start page title -->
            <div class="row">

           
           @foreach($piu as $plant_info)
            <div class="col-sm-6 col-xl-3" style="padding-top: 6px; padding-left: 12px; padding-right: 12px;">
                            <!-- Simple card -->
                            <div class="card" >
                                <img class="card-img-top img-fluid mb-2" src="/assets/images/talong.jpg" alt="Card image cap">
                                <div class="card-body" >
                                    <h4 class="card-title mb-2 text-center ">{{ $plant_info->plant_name}}</h4><br>
                                    
                                    <div class="text-end">
                                    <a href="{{ url('piu/show', $plant_info->id) }}" class="btn btn-success add-btn d-flex justify-content-center align-items-center" >Read more</a>
                                   
                                    </div>
                                </div>
                            </div><!-- end card -->
                        </div>
                        @endforeach
             


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