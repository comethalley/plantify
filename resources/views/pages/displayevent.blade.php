           <!----> @foreach ($events as $event)   
           <div id="planting-events-container">
                         <div class="card border-success pe-2 me-n1 mb-3 simplebar-scrollable-y" style="max-width: 18rem;" id="refresh">
                             <div class="card-header fw-bold bg-soft-danger">Title: {{ $event->title}}</div>
                                <div class="card-body">
                                    <h6 class="card-text">{{ date('F j, Y', strtotime($event->start)) }} to {{ date('F j, Y', strtotime($event->end)) }}</h6>
                                    <p class="card-text">Location: {{ $event->location}}</p>
                                    <p class="card-text">Description: {{ $event->description}}</p>
                                  
                                </div>
                             </div>
                     </div>@endforeach