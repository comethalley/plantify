    @include('templates.header')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
            
            <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Plant Information</h4>

                        </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                                <form action="{{url('searchpiu')}}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-xxl-5 col-sm-6">
                                        
                                            <!-- <div class="search-box">
                                            <div class="d-flex align-items-center ">
                                                        <input type="text" id="search" name="plant_name" class="form-control me-2" >
                                                        <button  type="submit"  class="btn btn-primary bg-gradient waves-effect waves-light mdi mdi-magnify search-widget-icon"></button>
                                            </div>
                                        </div> -->
                                    </div>
                                    <!--end row-->
                <!-- start page title -->
 <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 row-cols-xxl-4">
    @foreach($piu as $plant_info)
    <div class="col-sm-6 col-xl-3" style="padding: 6px;">
        <!-- Simple card -->
        <div class="card" style="width: 100%; height: 100%;">
            <img class="card-img-top img-fluid mb-2" src="/images/{{$plant_info->image}}" alt="Card image cap" style="object-fit: cover; height: 200px;">
            <div class="card-body">
                <h4 class="card-title mb-0 text-center">{{ $plant_info->plant_name}}</h4><br>
                <!-- <h4 class="card-title mb-2 text-center" style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                    {{ $plant_info->information }}
                </h4><br> -->
                <div class="text-end">
                    <a href="{{ url('piu/show', $plant_info->id) }}" class="btn btn-success add-btn d-flex justify-content-center align-items-center">Read more</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

                        </div>  
                </div>   
            </div>

<@include('templates.footer')

