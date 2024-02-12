@include('templates.header')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        <a href="/piu"   class="btn btn-success waves-effect waves-light mb-4" class="col-xl-3 col-lg-4 col-sm-6"><i class="las la-arrow-left"></i></div></a>
            <!-- start page title -->
                  <div class="row">
                  
                          <div class="col-xxl-6">
                                    <div class="card">
                                        <div class="row g-0 px-4 py-3">
                                            <div class="col-md-4">
                                                <img class="rounded-start img-fluid h-100 object-fit-cover" src="/assets/images/talong.jpg" alt="Card image">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-header">
                                                <h4 class="card-title mb-0 fw-bold">{{$piu->plant_name}}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text mb-2 fw-bold">Plant Information: {{$piu->information}}</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card -->
                                </div>
                        
                              
                                <div class="col-xxl-6">
                                    <div class="card">
                                        <div class="row g-0 px-4 py-3">
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-2 fw-bold">About Plant</h5>
                                                   
                                                </div>
                                                <div class="card-footer">
                                                     <p class="card-text mb-0 fw-bold">Another Information</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <img class="rounded-end img-fluid h-200 object-fit-cover" src="/assets/images/talong.jpg" alt="Card image">                                            </div>
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