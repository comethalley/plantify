@include('templates.header')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Planting List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Planting List</a></li>

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
                                    <h5 class="card-title mb-0">Planting List</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form>

                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body pt-0">
                            <div>

                                <div class="table-responsive table-card mb-1">
                                    <table id="alternative-pagination" class="table table-nowrap align-middle">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">
                                                <th scope="col" style="width: 25px;"></th>
                                                <th data-sort="customer_name">Plant Name:</th>
                                                <th data-sort="date">Planting Type:</th>
                                                <th data-sort="date"> Seeds Amount:</th>
                                                <th data-sort="amount">Plants Harvested (kg):</th>
                                                <th data-sort="payment">Plants Withered (kg):</th>
                                                <th data-sort="payment">Farm Area:</th>
                                                <th data-sort="city">Area Used:</th>
                                                <th data-sort="city">Status:</th>
                                                <th data-sort="city">Barangay:</th>
                                                <th data-sort="city">Farm:</th>
                                                <th data-sort="payment">Planting Date:</th>
                                                <th data-sort="payment">Harvesting Date:</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($createplantings as $event)
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td class="customer_name">{{ $event->title }} </td>
                                                    <td class="customer_name">{{ $event->type }}</td>
                                                    <td class="customer_name">
                                                        @if ($event->type === 'Seeds')
                                                            {{ $event->seed }} (g)
                                                        @elseif ($event->type === 'Seedlings')
                                                            {{ $event->seed }} (pcs)
                                                        @else
                                                            {{ $event->seed }}
                                                        @endif
                                                    </td>
                                                    <td class="date">{{ $event->harvested }}</td>
                                                    <td class="amount">{{ $event->destroyed }}</td>
                                                    <td class="amount">{{ $event->farm_area }}</td>
                                                    <td class="amount">{{ $event->area }}</td>
                                                    <td class="payment">{{ $event->status }}</td>
                                                    @if(property_exists($event, 'barangay_name') && property_exists($event, 'farm_name'))
                                                        <td>{{ $event->barangay_name }}</td>
                                                        <td>{{ $event->farm_name }}</td>
                                                    @else
                                                        <td>Public Users</td>
                                                        <td>Public Users</td>
                                                    @endif
                                                    <td class="payment">{{ $event->start }}</td>
                                                    <td class="payment">{{ $event->end }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your JavaScript code for real-time updates -->
<script>
    // Function to fetch and update events
    function fetchAndUpdateEvents() {
        $.ajax({
            url: '/plantcalendarget', // Replace with the actual endpoint URL
            method: 'GET',
            dataType: 'json', // Specify data type as JSON
            success: function(data) {
                var html = formatEvents(data.reverse()); // Reverse the order of events
                $('#planting-events-container').html(html);
            },
            error: function(error) {
                console.error('Error fetching events:', error);
            }
        });
    }

    function getEventBackgroundClass(status) {
        if (status === 'Harvested') {
            return 'bg-soft-success';
        } else if (status === 'Destroyed') {
            return 'bg-soft-danger';
        } else if (status === 'Planted') {
            return 'bg-soft-secondary';
        } else {

            return '';
        }
    }
</script>
@include('templates.footer')