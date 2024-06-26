<!-- Your HTML structure -->
<div id="planting-events-container">
    <!-- Content will be dynamically updated here -->
    @foreach ($createplantings as $event)
        <div class="card">
            <div class="card bg-light mb-3">
                <div class="card-header @if($event->status === 'Harvested') bg-success @elseif($event->status === 'Withered') bg-danger @elseif($event->status === 'Planted') bg-primary  @endif">
                    <h5 class="text-white"><strong>Plant Name: </strong> {{ $event->title }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Seed Weight (g): </strong>{{ $event->seed }}</p>
                    <p class="card-text"><strong>Planting Type: </strong>{{ $event->type }}</p>
                    <p class="card-text"><strong>Area Used: </strong>{{ $event->area }}</p>
                    <p class="card-text"><strong>Estimated Harvest (kg): </strong>{{ $event->harvested }}</p>
                    <p class="card-text"><strong>Estimated Withered (kg): </strong>{{ $event->destroyed }}</p>
                    <p class="card-text"><strong>Planting Date: </strong>{{ $event->start }}</p>
                    <p class="card-text"><strong>Harvesting Date: </strong> {{ $event->end }}</p>
                    <p class="card-text">
                        <strong>Status: </strong>
                        <span class="@if($event->status === 'Harvested') bg-success @elseif($event->status === 'Withered') bg-danger @elseif($event->status === 'Planted') bg-primary @endif text-white p-1 rounded">
                            {{ $event->status }}
                        </span>
                    </p>
                    
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your JavaScript code for real-time updates -->
<script>
    // Function to fetch and update events
    // Function to fetch and update events
function fetchAndUpdateEvents() {
    $.ajax({
        url: '/plantcalendarget', // Replace with the actual endpoint URL
        method: 'GET',
        dataType: 'json', // Specify data type as JSON
        success: function (data) {
            var html = formatEvents(data.reverse()); // Reverse the order of events
            $('#planting-events-container').html(html);
        },
        error: function (error) {
            console.error('Error fetching events:', error);
        }
    });
}

// Function to convert JSON data to HTML
function formatEvents(data) {
    // Implement logic to convert JSON data to HTML
    // Example: Loop through data and create HTML elements
    var html = '';
    for (var i = 0; i < data.length; i++) {
        html += '<div class="card">';
        html += '<div class="card bg-light mb-3">';
        html += '<div class="card-header ' + getEventBackgroundClass(data[i].status) + '">';
        html += '<h5 class="text-white"><strong>Plant Name: </strong>' + data[i].title + '</h5>';
        html += '</div>';
        html += '<div class="card-body">';
        html += '<p class="card-text"><strong>' + getSeedLabel(data[i].type) + ': </strong>' + data[i].seed + '</p>';
        html += '<p class="card-text"><strong>Planting Type: </strong>' + data[i].type + '</p>';
        html += '<p class="card-text"><strong>Area Used: </strong>' + data[i].area + '</p>';
        html += '<p class="card-text"><strong>Estimated Harvest (kg): </strong>' + data[i].harvested + '</p>';
        html += '<p class="card-text"><strong>Estimated Withered (kg) </strong>' + data[i].destroyed + '</p>';
        html += '<p class="card-text"><strong>Planting Date: </strong>' + data[i].start + '</p>';
        html += '<p class="card-text"><strong>Harvesting Date: </strong>' + data[i].end + '</p>';
        html += '<p class="card-text">';
        html += '<strong>Status: </strong>';
        html += '<span class="' + getEventBackgroundClass(data[i].status) + ' text-white p-1 rounded">';
        html += data[i].status;
        html += '</span>';
        html += '</p>';

        html += '</div>';
        html += '</div>';
        html += '</div>';
    }
    return html;
}

// Function to get background class based on event status
function getEventBackgroundClass(status) {
    if (status === 'Harvested') {
        return 'bg-success';
    } else if (status === 'Withered') {
        return 'bg-danger';
    } else if (status === 'Planted') {
        return 'bg-primary';
    } else {
        return '';
    }
}

// Function to get seed label based on event type
function getSeedLabel(type) {
    if (type === 'Seeds') {
        return 'Seed Weight (g)';
    } else {
        return 'Seed Quantity (pcs)';
    }
}

    // Fetch and update events every 10 seconds
    setInterval(fetchAndUpdateEvents, 1000);
</script>
