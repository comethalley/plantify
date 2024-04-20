@include('templates.header')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                        <div class="chat-leftsidebar">
                            <div class="px-4 pt-4 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-4">Chats</h5>
                                    </div>
                                </div>
                                <div class="search-box">
                                    <input type="text" class="form-control bg-light border-light" id="searchInput" placeholder="Search here...">
                                    <i class="ri-search-2-line search-icon"></i>
                                </div>
                            </div> <!-- .p-4 -->

                            <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab">
                                        Chats
                                    </a>
                                </li>
                            </ul>
                            

                            <div class="tab-content text-muted">
                                <div class="tab-pane active" id="chats" role="tabpanel">
                                    <div class="chat-room-list pt-3" data-simplebar>
                                        <div class="d-flex align-items-center px-4 mb-2">
                                            <div class="flex-grow-1">
                                                <h4 class="mb-0 fs-11 text-muted text-uppercase">Direct Messages</h4>
                                            </div>
                                        </div>
                                    
                                        <!-- Display the chat list -->
                                        <div class="chat-message-list">
                                            <ul class="list-unstyled chat-list chat-user-list" id="userList">
                                                @forelse($filteredUsers as $user) <!-- Change $users to $filteredUsers -->
                                                    @php
                                                        // Check if the user has any messages
                                                        $hasMessages = $user->messages->isNotEmpty();
                                                    @endphp

                                                    @if($hasMessages)
                                                        <button type="button" class="btn member-button" data-member-id="{{ $user->id }}" data-thread-id="{{ $user->thread_id }}">
                                                            <!-- Your user display content -->
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    @if ($user->unread_message_count > 0)
                                                                        <span class="position-absolute topbar-badge fs-10 translate-end badge rounded-pill bg-danger">{{ $user->unread_message_count }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">{{ $user->firstname }} {{ $user->lastname }}</h6>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    @endif
                                                @empty
                                                    <p>No other users found.</p>
                                                @endforelse
                                            </ul>
                                        </div>

                                        <!-- Display the thread messages -->
                                        <!-- <div class="chat-conversation"> -->
                                            <!-- Loop through $thread messages and display them -->
                                            <!-- @foreach($thread->messages as $message) -->
                                                <!-- Your message display content -->
                                                <!-- <div class="message"> -->
                                                    <!-- Display message content, sender, etc. -->
                                                <!-- </div>
                                            @endforeach
                                        </div> -->







        
                                        <div class="d-flex align-items-center px-4 mt-4 pt-2 mb-2">
                                            <div class="flex-grow-1">
                                                <h4 class="mb-0 fs-11 text-muted text-uppercase">Group Chats</h4>
                                            </div>
                                        </div>
        
                                        <div class="chat-message-list">
                                            <ul class="list-unstyled chat-list chat-user-list mb-0" id="channelList">
                                                @forelse($groups as $group)
                                                @if(auth()->user()->role_id == 2 && $group->group_name == 'Admin and Farm Leaders')
                                                {{-- Display only for role_id 2 (Admin and Farm Leaders) --}}
                                                <button type="button" class="btn channel-button" data-group-id="{{ $group->id }}" data-farm-id="{{ optional($farmLeaders)->id }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">{{ $group->group_name }}</h6>
                                                            @if ($group->unread_message_count > 0)
                                                                <span class="position-absolute topbar-badge fs-10 translate-end badge rounded-pill bg-danger">{{ $group->unread_message_count }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </button>
                                                @elseif(auth()->user()->role_id == 3)
                                                {{-- Display for role_id 3 (both Admin and Farm Leaders, Farm Leader and Farmers) --}}
                                                <button type="button" class="btn channel-button" data-group-id="{{ $group->id }}" data-farm-id="{{ optional($farmLeaders)->id }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">{{ $group->group_name }}</h6>
                                                            @if ($group->unread_message_count > 0)
                                                                <span class="position-absolute topbar-badge fs-10 translate-end badge rounded-pill bg-danger">{{ $group->unread_message_count }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </button>
                                                @elseif(auth()->user()->role_id == 4 && $group->group_name == 'Farm Leader and Farmers')
                                                {{-- Display only for role_id 4 (Farm Leader and Farmers) --}}
                                                <button type="button" class="btn channel-button" data-group-id="{{ $group->id }}" data-farm-id="{{ optional($farmLeaders)->id }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">{{ $group->group_name }}</h6>
                                                            @if ($group->unread_message_count > 0)
                                                                <span class="position-absolute topbar-badge fs-10 translate-end badge rounded-pill bg-danger">{{ $group->unread_message_count }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </button>
                                                @endif
                                                @empty
                                                <p>No groups found.</p>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <!-- End chat-message-list -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="contacts" role="tabpanel">
                                    <div class="chat-room-list pt-3" data-simplebar>
                                        <div class="sort-contact">            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end tab contact -->
                        </div>
                        <!-- end chat leftsidebar -->
                        <!-- Start User chat -->
                        <div class="user-chat w-100 overflow-hidden">

                        <div class="chat-content d-lg-flex" style="background-image: url('{{ asset('storage/images/chat_bg.png') }}'); background-size: cover; ">
                                <!-- start chat conversation section -->
                                <div class="w-100 overflow-hidden position-relative">
                                    <!-- conversation user -->
                                    <div class="position-relative" style="height: 505px">
                                        

                                        <div class="position-relative" id="users-chat">
                                            <div class="p-3 user-chat-topbar">
                                                <div class="row align-items-center">
                                                    <div class="col-sm-4 col-8">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                                <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                        <img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="">
                                                                        @if($user->isOnline)
                                                                            <span class="user-status"></span> <!-- Display online status indicator -->
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 overflow-hidden">
                                                                        <h5  class="text-truncate mb-0 fs-16"><a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample"></a></h5>
                                                                        <p class="text-truncate text-muted fs-14 mb-0 userStatus">
                                                                            <small>
                                                                                @if($user->isOnline)
                                                                                    Online
                                                                                @else
                                                                                    Offline
                                                                                @endif
                                                                            </small>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 col-4">
                                                        <ul class="list-inline user-chat-nav text-end mb-0">
                                                            <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                                <button type="button" class="btn btn-ghost-secondary btn-icon" data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">
                                                                    <i data-feather="info" class="icon-sm"></i>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
    
                                            </div>
                                            <!-- end chat user head -->
                                        </div>

                                        <!-- end chat user head -->
                                            
                                        
                                        <!-- Your chat conversation section -->
                                        <div class="chat-conversation p-3 p-lg-4" id="chat-conversation" data-simplebar>
                                            <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                                @foreach($messages as $message)
                                                    {{-- Check if the message status is true --}}
                                                    @if($message->status)
                                                        {{-- Display the actual message content --}}
                                                        @if($message->text_content)
                                                            {{-- Display text message --}}
                                                            @if($message->sender_id == auth()->user()->id)
                                                                {{-- Sender's message (right) --}}
                                                                <li class="chat-list right">
                                                            @else
                                                                {{-- Reply (left) --}}
                                                                <li class="chat-list left">
                                                            @endif
                                                                <div class="conversation-list">
                                                                    <div class="user-chat-content">
                                                                        <div class="ctext-wrap">
                                                                            <div class="ctext-wrap-content">
                                                                                <div class="message-dropdown">
                                                                                    <p class="mb-0 ctext-content" onclick="toggleDropdown(this)" data-message-id="{{ $message->id }}">{{ $message->text_content }}</p>
                                                                                    <div class="dropdown-menu">
                                                                                        <a class="dropdown-item" onclick="deleteMessage(this)">Delete</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="conversation-name">
                                                                                <br>
                                                                                <small class="text-muted time">{{ $message->created_at->format('H:i') }}</small>
                                                                                <span class="text-success check-message-icon">
                                                                                    <i class="ri-check-double-line align-bottom"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @elseif($message->image_path)
                                                            {{-- Display image message --}}
                                                            @if($message->sender_id == auth()->user()->id)
                                                                {{-- Sender's message (right) --}}
                                                                <li class="chat-list right">
                                                            @else
                                                                {{-- Reply (left) --}}
                                                                <li class="chat-list left">
                                                            @endif
                                                                <div class="conversation-list">
                                                                    <div class="user-chat-content">
                                                                        <div class="ctext-wrap">
                                                                            <div class="ctext-wrap-content">
                                                                                <div class="message-dropdown">
                                                                                    {{-- Display image --}}
                                                                                    <img src="{{ asset('storage/' . $message->image_path) }}"  style="max-width: 400px; max-height: 400px;" class="img-fluid" alt="Image">
                                                                                    <div class="dropdown-menu">
                                                                                        <a class="dropdown-item" onclick="deleteMessage(this)">Delete</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="conversation-name">
                                                                                <br>
                                                                                <small class="text-muted time">{{ $message->created_at->format('H:i') }}</small>
                                                                                <span class="text-success check-message-icon">
                                                                                    <i class="ri-check-double-line align-bottom"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    {{-- If the message status is false, display "You unsent a message" --}}
                                                    @else
                                                        <li class="chat-list right">
                                                            <div class="conversation-list">
                                                                <div class="user-chat-content">
                                                                    <div class="ctext-wrap">
                                                                        <div class="ctext-wrap-content">
                                                                            <div class="message-dropdown">
                                                                                <p class="mb-0 ctext-content">You unsent a message</p>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item" onclick="deleteMessage(this)">Delete</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="conversation-name">
                                                                            <br>
                                                                            <small class="text-muted time">{{ $message->created_at->format('H:i') }}</small>
                                                                            <span class="text-success check-message-icon">
                                                                                <i class="ri-check-double-line align-bottom"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <!-- end chat-conversation-list -->
                                        </div>





                                            <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show " id="copyClipBoardChannel" role="alert">
                                                Message copied
                                            </div>
                                        </div>

                                        <!-- end chat-conversation -->

                                        <div class="chat-input-section p-3 p-lg-4">
                                            <form id="chatinput-form" enctype="multipart/form-data">
                                                <div class="row g-0 align-items-center">
                                                    <div class="col-auto">
                                                        <div class="chat-input-links me-2">
                                                            <div class="links-list-item">
                                                                <!-- File input -->
                                                                <input type="file" class="form-control-file d-none" id="photo-input" accept="image/jpeg,image/png,image/jpg">
                                                                <label for="photo-input">
                                                                    <i class="bx bx-paperclip align-middle"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="chat-input-feedback">
                                                            Please Enter a Message
                                                        </div>
                                                        <!-- Text input for message -->
                                                        <input type="text" class="form-control chat-input bg-light border-light" id="chat-input" placeholder="Type your message..." autocomplete="off">
                                                        <!-- Hidden input for image path -->
                                                        <input type="hidden" id="image-path" name="image_path">
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="chat-input-links ms-2">
                                                            <div class="links-list-item">
                                                                <button type="submit" class="btn btn-success chat-send waves-effect waves-light" id="send-btn">
                                                                    <i class="ri-send-plane-2-fill align-bottom"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="replyCard">
                                            <div class="card mb-0">
                                                <div class="card-body py-3">
                                                    <div class="replymessage-block mb-0 d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <h5 class="conversation-name"></h5>
                                                            <p class="mb-0"></p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <button type="button" id="close_toggle" class="btn btn-sm btn-link mt-n2 me-n3 fs-18">
                                                                <i class="bx bx-x align-middle"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end chat-wrapper -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        <!-- end main content-->









    <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="userProfileCanvasExample">
        <!--end offcanvas-header-->
        <div class="offcanvas-body profile-offcanvas p-0">
            <div class="team-cover">
                <img src="assets/images/small/img-9.jpg" alt="" class="img-fluid" />
            </div>
            <div class="p-1 pb-4 pt-0">
                <div class="team-settings">
                    <div class="row g-0">
                        <div class="col">
                            <div class="btn nav-btn">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <div class="p-3 text-center">
                <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-lg img-thumbnail rounded-circle mx-auto profile-img">
                <div class="mt-3">
                    <h5 class="fs-16 mb-1"><a href="javascript:void(0);" class="link-primary username"></a></h5>
                    @if($user->isOnline)
                        <p class="text-muted"><i class="ri-checkbox-blank-circle-fill me-1 align-bottom text-success"></i>Online</p>
                    @else
                        <p class="text-muted">Offline</p>
                    @endif
                </div>

            </div>

            <div class="border-top border-top-dashed p-3">
                <h5 class="fs-15 mb-3">Personal Details</h5>
                <div class="mb-3">
                    <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Email</p>
                    <h6>{{ $user->email }}</h6>
                </div>
                <div class="mb-3">
                    <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Role</p>
                    <h6>
                        @if ($user->role_id == 1)
                            Super Admin
                        @elseif ($user->role_id == 2)
                            Admin
                        @elseif ($user->role_id == 3)
                            Farm Leader
                        @else ($user->role_id == 4)
                            Farmers
                        @endif
                    </h6>
                </div>
                @if ($filteredUsers->isNotEmpty())
                    @php
                        $chatUser = $filteredUsers->first(); // Assuming you want to show details of the first user in the chat list
                    @endphp

                    @if ($chatUser->farm)
                        <div>
                            <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Farm</p>
                            <h6 class="mb-0">{{ $chatUser->farm->farm_name }}, {{ $chatUser->farm->address }}</h6>
                        </div>
                    @else
                        <div>
                            <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Farm</p>
                            <h6 class="mb-0">No associated farm</h6>
                        </div>
                    @endif
                @endif

            </div>


            <div class="border-top border-top-dashed p-3">
                <h5 class="fs-15 mb-3">Attached Files</h5>

                <div class="vstack gap-2">
                    
                    <!-- Display the Attached Image -->

                    <div class="text-center mt-2">
                        <button type="button" class="btn btn-danger">Load more <i class="ri-arrow-right-fill align-bottom ms-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!--end offcanvas-body-->
    </div>

@include('templates.footer')


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
var currentThreadId = '{{ $thread->id }}';
// When a file is selected, update the text input value with the filename
document.getElementById("photo-input").addEventListener("change", function () {
    var filename = this.files[0].name;
    document.getElementById("chat-input").value = filename;
});

document.getElementById("chatinput-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    var messageInput = document.getElementById("chat-input").value.trim(); // Get the message text
    var photoInput = document.getElementById("photo-input").files[0]; // Get the selected photo

    var formData = new FormData(); // Create FormData object to send both message and photo

    if (messageInput !== "" || photoInput) {
        // If a message is typed, append it to form data
        if (messageInput !== "") {
            formData.append('text_content', messageInput);
        }

        // If an image is selected, append it to form data
        if (photoInput) {
            formData.append('photo', photoInput);
        }

        // Send an AJAX request to create a new message with photo
        $.ajax({
            url: '{{ route("store.message", ["threadId" => $thread->id]) }}',
            type: 'POST',
            data: formData,
            processData: false, // Don't process the data (required for FormData)
            contentType: false, // Don't set content type (required for FormData)
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            success: function (response) {
                // Assuming the response contains the newly created message text
                appendMessageToConversation(messageInput); // Pass the message text to the function
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });

        // Clear the input fields
        document.getElementById("chat-input").value = "";
        document.getElementById("photo-input").value = "";
    }
});



function appendMessageToConversation(message) {
    var usersConversation = document.getElementById("users-conversation");
    var messageItem = document.createElement("li");
    messageItem.className = "chat-list right"; // Assuming the sender is always the current user
    messageItem.innerHTML = `
        <div class="conversation-list">
            <div class="user-chat-content">
                <div class="ctext-wrap">
                    <div class="ctext-wrap-content">
                        <div class="message-dropdown">
                            <p class="mb-0 ctext-content">${message}</p>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="deleteMessage(this)">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="conversation-name">
                        <br>
                        <small class="text-muted time">${getCurrentTime()}</small>
                        <span class="text-success check-message-icon">
                            <i class="ri-check-double-line align-bottom"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>`;
    usersConversation.appendChild(messageItem);
}

function getCurrentTime() {
    var now = new Date();
    var hours = now.getHours().toString().padStart(2, "0");
    var minutes = now.getMinutes().toString().padStart(2, "0");
    return hours + ":" + minutes;
}

function toggleDropdown(element) {
    var dropdownMenu = element.nextElementSibling;
    dropdownMenu.classList.toggle("show");
}

function deleteMessage(element) {
    var messageItem = element.closest(".chat-list");
    var messageId = messageItem.querySelector('.ctext-content').getAttribute('data-message-id');
    
    // Send a DELETE request to delete the message
    $.ajax({
        url: '/delete-message/' + messageId,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            // Check if the response indicates success
            if (response.success) {
                // Update the message content in the conversation area
                var messageContent = messageItem.querySelector('.ctext-content');
                messageContent.textContent = 'You unsent a message';
                // Remove the dropdown menu
                var dropdownMenu = messageItem.querySelector('.dropdown-menu');
                dropdownMenu.remove();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}


function replyToMessage(element) {
    // Add code to handle replying to a message
    // ...
}

function deleteMember(memberId) {
    // Send a DELETE request to delete the member
    $.ajax({
        url: '/delete_member/' + memberId + '/',
        type: 'DELETE',
        headers: {
            'X-CSRFToken': '{{ csrf_token() }}'
        },
        success: function(response) {
            // Remove the member from the active members list in the front end
            $('#activeUserList').find(`[data-member-id="${memberId}"]`).remove();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

$(document).ready(function () {
       // Attach a click event handler to each user button
       $('.member-button').on('click', function () {
           // Get the user ID and thread ID from the data attributes
           var userId = $(this).data('member-id');
           var threadId = $(this).data('thread-id');

           // If there's no thread ID, create a new thread
           if (!threadId) {
               // Get the CSRF token from the meta tag
               var csrfToken = $('meta[name="csrf-token"]').attr('content');

               // Make an AJAX request to create a thread
               $.ajax({
                   type: 'POST',
                   url: '/create-thread/' + userId,
                   dataType: 'json',
                   headers: {
                       'X-CSRF-TOKEN': csrfToken
                   },
                   success: function (response) {
                       // Redirect to the newly created thread
                       window.location.href = '/thread/' + response.thread_id;
                   },
                   error: function (error) {
                       console.error('Error creating thread:', error);
                       // Handle the error as needed
                   }
               });
           } else {
               // Redirect to the existing thread
               window.location.href = '/thread/' + threadId;
           }
       });
   });


   
   $(document).ready(function () {
        // Attach click event to member buttons
        $('.member-button').on('click', function () {
            // Get the member's name and ID from the clicked button
            var memberName = $(this).find('.ms-2 h6').text();
            var memberId = $(this).data('member-id');

            // Store the selected member's name and ID in sessionStorage
            sessionStorage.setItem('selectedMemberName', memberName);
            sessionStorage.setItem('selectedMemberId', memberId);

            // Update the chat head with the selected member's name
            updateChatHead(memberName);
        });

        // Check if there is a selected member in sessionStorage and update the top bar
        var selectedMemberName = sessionStorage.getItem('selectedMemberName');
        if (selectedMemberName) {
            updateChatHead(selectedMemberName);
        }
    });

    function updateChatHead(memberName) {
        // Update the chat head with the selected member's name
        $('.username').text(memberName);
    }



    $(document).ready(function () {
        // Attach click event to member buttons
        $('.member-button').on('click', function () {
            var userId = $(this).data('member-id');

            // Get the CSRF token value
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Assuming you have an API or route to mark messages as read
            $.ajax({
                url: '/mark-messages-as-read/' + userId,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    // Update the UI to remove or update the badge
                    $('#unreadBadge_' + userId).remove();
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });


    $(document).ready(function () {
    // Attach a click event handler to each group button
    $('.channel-button').on('click', function () {
        // Get the group ID and farm ID from the data attributes
        var groupId = $(this).data('group-id');
        var farmId = $(this).data('farm-id'); // Adjust this based on how you get the farm ID in your HTML

        // Redirect to the group details page with both IDs
        window.location.href = '/groups/' + groupId;
    });
});


$(document).ready(function () {
    // Attach a click event handler to each group button
    $('.channel-button').on('click', function () {
        // Get the group ID and group thread ID from the data attributes
        var groupId = $(this).data('group-id');
        var groupThreadId = $(this).data('group-thread-id');

        // Redirect to the group details page with both IDs
        window.location.href = '/groups/' + groupId;
    });
});



$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('#searchInput').on('input', function () {
        var searchTerm = $(this).val().trim();

        // If the search term is empty, clear the user list and return
        if (searchTerm === '') {
            $('#userList').empty();
            return;
        }

        // Make an AJAX request to the server for user search
        $.ajax({
            url: '/search-users',
            method: 'GET',
            data: { term: searchTerm },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                // Update the user list with the search results
                updateSearchResults(response);
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    function updateSearchResults(users) {
        $('#userList').empty();

        users.forEach(function (user) {
            var userItem = '<li>' +
                '<button type="button" class="btn member-button" data-member-id="' + user.id + '" data-thread-id="' + (user.thread_id || '') + '">' +
                '<div class="d-flex align-items-center">' +
                '<div class="avatar-sm"></div>' +
                '<div class="ms-2">' +
                '<h6 class="mb-0">' + user.firstname + ' ' + user.lastname + '</h6>' +
                '</div>' +
                '</div>' +
                '</button>' +
                '</li>';
            $('#userList').append(userItem);
        });
    }

    // Attach a click event handler to dynamically added member buttons
    $(document).on('click', '.member-button', function (event) {
        event.preventDefault(); // Prevent the default behavior of links

        var memberName = $(this).find('.ms-2 h6').text();
        sessionStorage.setItem('selectedMemberName', memberName); // Store the selected member's name

        var userId = $(this).data('member-id');
        var threadId = $(this).data('thread-id');

        if (!threadId) {
            // Create a new thread
            $.ajax({
                type: 'POST',
                url: '/create-thread/' + userId,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    window.location.href = '/thread/' + response.thread_id;
                },
                error: function (error) {
                    console.error('Error creating thread:', error);
                    // Handle the error as needed
                }
            });
        } else {
            // Redirect to the existing thread
            window.location.href = '/thread/' + threadId;
        }
    });

    // Check if there's a stored selected member's name and update the chat head
    var selectedMemberName = sessionStorage.getItem('selectedMemberName');
    if (selectedMemberName) {
        updateChatHead(selectedMemberName);
    }

    function updateChatHead(memberName) {
        // Update the chat head with the selected member's name
        $('.username').text(memberName);
    }
});








</script>