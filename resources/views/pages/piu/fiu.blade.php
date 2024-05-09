@include('templates.header')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        
        <div class="col-12">
                     <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Plant Fertilizer Information</h4>

                    </div>
        </div>

 <div class="card-body border border-dashed border-end-0 border-start-0" style="padding-bottom: 20px;">
    <form>
        <div class="row g-3">
            <div class="col-xxl-5 col-sm-6">
                <div class="search-box">
                    <input type="text" id="searchInput" class="form-control search" placeholder="Search for fertilizer or something...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
        </div>
        <!--end row-->
    </form>
</div>

<!-- start page title -->
<div id="cardContainer" class="row row-cols-1 row-cols-sm-2 row-cols-xl-4">
    @foreach($fer as $fers)
    <div class="col-sm-6 col-xl-3" style="padding: 6px;">
        <!-- Simple card -->
        <div class="card" style="width: 100%; height: 100%;">
            <img class="card-img-top img-fluid mb-2" src="/images/{{ $fers->fer_image}}" alt="Card image cap" style="object-fit: cover; height: 200px;">
            <div class="card-body">
                <h4 class="card-title mb-2 text-center">{{ $fers->fer_name}}</h4><br>
                <div class="text-end">
                    <a href="{{ url('piu/showfiu', $fers->id) }}" class="btn btn-success add-btn d-flex justify-content-center align-items-center">Read more</a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function() {
    // Function to handle search input
    $('#searchInput').on('keyup', function() {
        var searchText = $(this).val().toLowerCase(); // Get the search text
        var resultCount = 0; // Initialize result count

        // Loop through each card
        $('.card').each(function() {
            var cardTitle = $(this).find('.card-title').text().toLowerCase(); // Get card title
            // Check if card title contains search text
            if (cardTitle.includes(searchText)) {
                $(this).closest('.col-sm-6').show(); // Show the parent container
                resultCount++; // Increment result count
            } else {
                $(this).closest('.col-sm-6').hide(); // Hide the parent container
            }
        });

        // Display message if no results found
        if (resultCount === 0) {
            $('#noFarmsMessageContainer').show(); // Show message container
        } else {
            $('#noFarmsMessageContainer').hide(); // Hide message container
        }

        // Hide message if search input is empty
        if (searchText === "") {
            $('#noFarmsMessageContainer').hide(); // Hide message container
            $('.col-sm-6').show(); // Show all items
        }
    });
});

</script>
@include('templates.footer')