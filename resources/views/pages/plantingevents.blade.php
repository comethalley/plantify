<!-- Your HTML structure -->
<div id="planting-events-container">
    <!-- Content will be dynamically updated here -->
    @foreach ($createplantings as $event)
        <div class="card">
            <div class="card bg-light mb-3">
                <div class="card-header @if($event->status === 'Harvested') bg-soft-success @elseif($event->status === 'Destroyed') bg-soft-danger @endif">
                    <h5 class="text-dark"><strong>Seed Name: </strong> {{ $event->title }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Start Date: </strong>{{ $event->start }}</p>
                    <p class="card-text"><strong>End Date: </strong> {{ $event->end }}</p>
                    <p class="card-text">
                        <strong>Status: </strong>
                        <span class="@if($event->status === 'Harvested') bg-soft-success @elseif($event->status === 'Destroyed') bg-soft-danger @endif text-dark p-1 rounded">
                            {{ $event->status }}
                        </span>
                    </p>
                    <p class="card-text"><strong>Description: </strong>{{ $event->description }}</p>
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
    function fetchAndUpdateEvents() {
        $.ajax({
            url: '/plantcalendarget', // Replace with the actual endpoint URL
            method: 'GET',
            dataType: 'json', // Specify data type as JSON
            success: function (data) {
                var html = formatEvents(data); // Assuming formatEvents is a function that converts JSON to HTML
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
            html += '<h5 class="text-dark"><strong>Seed Name: </strong>' + data[i].title + '</h5>';
            html += '</div>';
            html += '<div class="card-body">';
            html += '<p class="card-text"><strong>Start Date: </strong>' + data[i].start + '</p>';
            html += '<p class="card-text"><strong>End Date: </strong>' + data[i].end + '</p>';
            html += '<p class="card-text">';
            html += '<strong>Status: </strong>';
            html += '<span class="' + getEventBackgroundClass(data[i].status) + ' text-dark p-1 rounded">';
            html += data[i].status;
            html += '</span>';
            html += '</p>';
            html += '<p class="card-text"><strong>Description: </strong>' + data[i].description + '</p>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }
        return html;
    }

    // Function to get background class based on event status
    function getEventBackgroundClass(status) {
        if (status === 'Harvested') {
            return 'bg-soft-success';
        } else if (status === 'Destroyed') {
            return 'bg-soft-danger';
        } else {
            return '';
        }
    }

    // Fetch and update events every 10 seconds
    setInterval(fetchAndUpdateEvents, 1000);
</script>