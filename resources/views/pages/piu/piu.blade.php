    @include('templates.header')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
            
            <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Plant Information</h4>

                        </div>
            </div>
<div class="card-body border border-dashed border-end-0 border-start-0" style="padding-bottom: 20px;">
    <form>
        <div class="row g-3">
            <div class="col-xxl-5 col-sm-6">
                <div class="search-box">
                    <input type="text" id="searchInput" class="form-control search" placeholder="Search for order ID, customer, order status or something...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
        </div>
        <!--end row-->
    </form>
</div>


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
 
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            
            // Loop through each card
            $('.row-cols-1.row-cols-sm-2.row-cols-xl-4.row-cols-xxl-4').each(function() {
                var $columns = $(this).children('.col-sm-6');
                var found = false;
                
                $columns.each(function() {
                    var $card = $(this).find('.card');
                    var plantName = $card.find('.card-title').text().toLowerCase();
                    
                    // Check if the plant name contains the search text
                    if (plantName.includes(searchText)) {
                        // Move the column containing the matching plant name to the beginning
                        $(this).prependTo($(this).parent());
                        found = true;
                    }
                    
                    // Show or hide the card based on whether it matches the search text
                    if (plantName.includes(searchText)) {
                        $card.show();
                    } else {
                        $card.hide();
                    }
                });
                
                // If no match found, keep the original order and show all cards
                if (!found) {
                    $columns.each(function(index) {
                        $(this).appendTo($(this).parent());
                        $(this).find('.card').show();
                    });
                }
            });
        });
    });




</script>
<@include('templates.footer')

