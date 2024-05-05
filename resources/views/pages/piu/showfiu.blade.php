@include('templates.header')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        <a href="/piu/fiu"   class="btn btn-success waves-effect waves-light mb-4" class="col-xl-3 col-lg-4 col-sm-6"><i class="ri-arrow-left-line"></i></div></a>
                <!-- start page title -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12"> <!-- Set column to take up full width -->
            <div class="card">
                <div class="card-body" style="width: 100%;"> <!-- Set card body to take up full width -->
                    <h4 class="card-title mb-0 fw-bold" style="font-family: Arial, sans-serif; font-size: 16px;">Fertilizer Name: {{$fer->fer_name}}</h4>
                    <p class="card-text mb-0 fw-bold" style="font-family: Arial, sans-serif; font-size: 16px;">{!!$fer->fer_information!!}</p>
                </div>
            </div>
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