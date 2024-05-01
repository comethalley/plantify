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
            <div class="row">
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
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Event List</h5>
                                </div>
                                
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                        <div class="d-flex justify-content-end"> <!-- Add this container -->
        <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter
        </button>
    </div>
                       </div>

    <div class="card">
        <div class="row">
    @foreach ($events as $event)
        <div class="col-md-3 px-4">
            <a href="{{ route('event.details', ['id' => $event->id]) }}" class="event-card">
                <div class="event-image align-items-center ">
                    @if ($event->image)
                        <img src="../assests/images/event/{{$event->image}}" alt="Event Image">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Placeholder Image">
                    @endif
                </div>
                <div class="event-details">
                    <div class="event-title ">{{ $event->title }}</div>
                    <div class="event-date">{{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}</div>
                    <div class="">{{ date('g:i A', strtotime($event->starttime)) }} to {{ date('g:i A', strtotime($event->endtime)) }}</div>
                </div>
            </a>
        </div>
    @endforeach
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
</script>
@include('templates.footer')