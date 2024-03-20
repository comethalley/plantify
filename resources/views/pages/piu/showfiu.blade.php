@include('templates.header')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        <a href="/piu/fiu"   class="btn btn-success waves-effect waves-light mb-4" class="col-xl-3 col-lg-4 col-sm-6"><i class="ri-arrow-left-line"></i></div></a>
                <!-- start page title -->
                  <div class="row">
                  
                                  
                                <div class="col-xxl-6">
                                    <div class="card">
                                        <div class="row g-0 px-4 py-3">
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                <h4 class="card-title mb-0 fw-bold">Fertlizer Name: {{$fer->fer_name}}</h4>
                                             
                                                   
                                                </div>
                                                <div class="card-footer">
                                                <h4 class="card-title mb-0 fw-bold">{!!$fer->fer_information!!}</h4>
                                                </div>
                                            </div>
                                           
                                    </div><!-- end card -->
                                </div>
                        
                              
                                <div class="col-xxl-6">
                                    <div class="card">
                                        <div class="row g-0 px-4 py-3">
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                <h4 class="card-text mb-4 fw-bold">Another Information</h4>
                                                   
                                                </div>
                                                <div class="card-footer">
                                                     
                                                     <p class="card-text mb-4 fw-bold" style="font-family: Arial, sans-serif; font-size: 16px;"></p>
                                                    <p class="card-text mb-4 fw-bold" style="font-family: Arial, sans-serif; font-size: 16px;"></p>

                                                </div>
                                            </div>
                                           
                                    </div><!-- end card -->
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
@include('templates.footer')