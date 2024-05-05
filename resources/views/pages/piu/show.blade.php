@include('templates.header')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        <a href="/piu/piu"   class="btn btn-success waves-effect waves-light mb-4" class="col-xl-3 col-lg-4 col-sm-6"><i class="ri-arrow-left-line"></i></div></a>
                <!-- start page title -->
 <div class="container-fluid">
 <div class="row justify-text-center">
    <div class="col-12"> <!-- Set column to take up full width -->
        <div class="card">
            <div class="card-body" style="width: 100%;"> <!-- Set card body to take up full width -->
                <h4 class="card-title mb-4" style="font-size: 20px; font-weight: bold;">{{ $piu->plant_name }}</h4>
                <p class="card-text mb-2" style="font-size: 20px; font-weight: bold;">Plant Information:<br></p>
                {!! $piu->information !!}
            </div>
           
        </div><!-- end card -->
    </div>
</div>






                  

                              
<div class="container-fluid">
    <div class="row">
        <div class="col-12"> <!-- Set column to take up full width -->
            <div class="card">
                <div class="row g-0 px-4 py-3">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title mb-2 fw-bold">Another information</h5>
                        </div>
                        <div class="card-footer">
                            <p class="card-text mb-0 fw-bold">Planting Month Season:  {{$piu->seasons}} </p><br>
                            <p class="card-text mb-0 fw-bold">Companion:  {{$piu->companion}} </p>
                        </div>
                    </div>
                </div><!-- end row -->
            </div><!-- end card -->
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
@include('templates.footer')