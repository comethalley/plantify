@include('templates.header')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        
        <div class="col-12">
                     <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Plant Fertilizer Information</h4>

                    </div>
        </div>
            <!-- start page title -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4">
    @foreach($fer as $fer)
    <div class="col-sm-6 col-xl-3" style="padding: 6px;">
        <!-- Simple card -->
        <div class="card" style="width: 100%; height: 100%;">
            <img class="card-img-top img-fluid mb-2" src="/images/{{ $fer->fer_image}}" alt="Card image cap" style="object-fit: cover; height: 200px;">
            <div class="card-body">
                <h4 class="card-title mb-2 text-center">{{ $fer->fer_name}}</h4><br>
                <div class="text-end">
                    <a href="{{ url('piu/showfiu', $fer->id) }}" class="btn btn-success add-btn d-flex justify-content-center align-items-center">Read more</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
                    </div>  
              </div>   
         </div>

   <!-- last -->

    <!--MORE-->
    
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