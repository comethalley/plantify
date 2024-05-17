@include('templates.header')
<style>
.event-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding-left: 10px;
}

.column {
    flex: 0 0 calc(23% - 20px);
   

    /* margin-bottom: 20px;  */
}

.event-card {
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    border: 1px solid #ccc;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    height: 90%;
    background-color: #f9f9f9;
    transition: box-shadow 0.3s, transform 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.event-image {
    width: 45%;
    height: 60%;
    flex: 1;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    overflow: hidden;

    
    
}

.event-image img {
    width: 100%;
    height: 100%;

    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  
}



.event-title {
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
    text-align: center;
}

.event-date {
    color: #777;
    font-style: italic;
}

.event-card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}


</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row mb-2">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Event Attendance</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Event Attendance</a></li>

                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
    <div class="col-lg-12">
        <div class="card" id="orderList">
            <div class="card-header border-0">
                <div class="row align-items-center gy-2">
                    <div class="col-sm">
                        <h5 class="card-title mb-2">Event List</h5>
                    </div>
                    <div class="col-xxl-5 col-sm-6">
                        <div class="search-box">
                            <input type="text" id="searchInput" class="form-control search" placeholder="Search for order ID, customer, order status or something...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <!-- <div class="dropdown d-grid justify-content-end mt-1">
                            <button class="btn btn-success dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter Status
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                <li><a class="dropdown-item filter-option" href="javascript:void(0);" data-status="all">Show All</a></li>
                                <li><a class="dropdown-item filter-option" href="javascript:void(0);" data-status="1">Upcoming Event</a></li>
                                <li><a class="dropdown-item filter-option" href="javascript:void(0);" data-status="2">Ongoing Event</a></li>
                                <li><a class="dropdown-item filter-option" href="javascript:void(0);" data-status="3">Finished Event</a></li>
                            
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    @foreach ($events as $event)
                    <div class="col-md-3 px-4">
                        <a href="{{ route('event.details', ['id' => $event->id]) }}" class="event-card">
                            <div class="event-image align-items-center">
                                @if ($event->image)
                                <img src="../assests/images/event/{{$event->image}}" alt="Event Image">
                                @else
                                <img src="https://via.placeholder.com/150" alt="Placeholder Image">
                                @endif
                            </div>
                            <div class="event-details">
                                <div class="event-title h5 fw-bold"><strong>{{ $event->title }}</strong></div>
                                <div class="event-date small text-muted" data-start="{{ $event->start }}" data-end="{{ $event->end }}">
                                    {{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}
                                </div>
                                <div class="small text-muted">
                                    {{ date('g:i A', strtotime($event->starttime)) }} to {{ date('g:i A', strtotime($event->endtime)) }}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
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
<!-- END layout-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.invite-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var link = this.getAttribute('data-link');
                navigator.clipboard.writeText(link).then(function() {
                    alert('Link copied to clipboard: ' + link);
                }).catch(function() {
                    alert('Failed to copy link to clipboard.');
                });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
    const filterOptions = document.querySelectorAll('.filter-option');
    const eventCards = document.querySelectorAll('.card .col-md-3');

    filterOptions.forEach(option => {
        option.addEventListener('click', function() {
            const status = this.getAttribute('data-status');
            const currentDate = new Date();

            eventCards.forEach(card => {
                const startDate = new Date(card.querySelector('.event-date').getAttribute('data-start'));
                const endDate = new Date(card.querySelector('.event-date').getAttribute('data-end'));

                let cardStatus = '';

                if (currentDate < startDate) {
                    cardStatus = 'Upcoming Event';
                } else if (currentDate >= startDate && currentDate <= endDate) {
                    cardStatus = 'Ongoing Event';
                } else {
                    cardStatus = 'Finished Event';
                }

                if (status === 'all' || status === cardStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

$(document).ready(function() {
    $('#searchInput').on('input', function() {
        var searchText = $(this).val().toLowerCase(); // Get the search text
        $('.event-card').each(function() {
            var eventTitle = $(this).find('.event-title').text().toLowerCase(); // Get the event title
            if (eventTitle.includes(searchText)) {
                $(this).closest('.col-md-3').show(); // Show the closest .col-md-3 container
            } else {
                $(this).closest('.col-md-3').hide(); // Hide the closest .col-md-3 container
            }
        });
    });
});




</script>
@include('templates.footer')