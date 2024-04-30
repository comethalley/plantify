@include('templates.header')
<style>
.event-card {
    display: flex;
    border-radius: 10px;
    border: 1px solid #ccc;
    overflow: hidden;
    margin: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    height: 130px;
    background-color: #f9f9f9; /* Light gray background color */
}

.event-image {
    flex: 1;
    max-width: 150px;
    overflow: hidden;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.event-details {
    flex: 2;
    padding: 10px;
}

.event-title {
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333; /* Dark text color */
}

.event-date {
    color: #777;
    font-style: italic;
}

/* Add hover effect for a more interactive feel */
.event-card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
    transition: box-shadow 0.3s, transform 0.3s;
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
                       
                       </div>
                       @foreach ($events as $event)
    <a href="{{ route('event.details', ['id' => $event->id]) }}" class="event-card">
        <div class="event-image">
            @if ($event->image)
                <img src="{{ asset('assets/images/event/' . $event->image) }}" alt="Event Image">
            @else
                <img src="https://via.placeholder.com/150" alt="Placeholder Image">
            @endif
        </div>
        <div class="event-details">
            <div class="event-title">{{ $event->title }}</div>
            <div class="event-date">{{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}</div>
            <div class="event-time">{{ date('g:i A', strtotime($event->starttime)) }} to {{ date('g:i A', strtotime($event->endtime)) }}</div>
        </div>
        <button class="btn btn-primary invite-btn" data-link="{{ route('event.attendance.form', ['id' => $event->id]) }}" onclick="redirectToAttendanceForm(event)">Invite</button>
    </a>
@endforeach
    
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