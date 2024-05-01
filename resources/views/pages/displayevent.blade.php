           <!----> @foreach ($events as $event)   
           <div id="planting-events-container">
                         <div class="card border-success pe-2 me-n1 mb-3 simplebar-scrollable-y" style="max-width: 18rem;" id="refresh">
                             <div class="card-header fw-bold bg-soft-danger">Title: {{ $event->title}}</div>
                                <div class="card-body">
                                <h5>{{ $event->title }}</h5>
                        <p><strong>Date:</strong> {{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}</p>
                        <p><strong>Time:</strong> {{ date('g:i A', strtotime($event->starttime)) }} to {{ date('g:i A', strtotime($event->endtime)) }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                        <p><strong>Description:</strong>{{ $event->description }}</p>
                                  
                                </div>
                             </div>
                     </div>@endforeach