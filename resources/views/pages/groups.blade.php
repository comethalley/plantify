@include('templates.header')

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
                    </div>

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
                                                    @if($profileSettings)
                                                        <img src="{{ $profileSettings->profile_image ? asset('storage/' . $profileSettings->profile_image) : asset('path_to_default_image') }}" alt="" >
                                                    @else
                                                        <img class="rounded-circle header-profile-user" src="{{asset('assets/images/plantifeedpics/rounded.png')}}" alt="Header Avatar">
                                                    @endif
                                                            @if ($user->unread_message_count > 0)
                                                                <span class="position-absolute topbar-badge fs-10 translate-end badge rounded-pill bg-danger">{{ $user->unread_message_count }}</span>
                                                            @endif
                                                        
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
                            </div>

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
                                                <img class="rounded-circle header-profile-user" src="{{asset('assets/images/plantifeedpics/rounded.png')}}" alt="Header Avatar">
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
                                                <img class="rounded-circle header-profile-user" src="{{asset('assets/images/plantifeedpics/rounded.png')}}" alt="Header Avatar">
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
                                                <img class="rounded-circle header-profile-user" src="{{asset('assets/images/plantifeedpics/rounded.png')}}" alt="Header Avatar">
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
                        </div>

                        <div class="tab-pane" id="contacts" role="tabpanel">
                            <div class="chat-room-list pt-3" data-simplebar>
                                <div class="sort-contact">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start User chat -->
                <div class="user-chat w-100 overflow-hidden user-chat-show">
                    <div class="chat-content d-lg-flex" style="background-image:  url('{{ asset('assets/images/chat_bg.png') }}'); background-size: cover;">
                        <!-- start chat conversation section -->
                        <div class="w-100 overflow-hidden position-relative">
                            <!-- conversation user -->
                            <div class="position-relative">
                                <div class="position-relative" id="users-chat">
                                    <div class="p-3 user-chat-topbar">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4 col-8">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                        <a href="/chat" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample"></a></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end chat user head -->
                                </div>

                                <!-- Your chat conversation section -->
                                <div class="chat-conversation p-3 p-lg-4" id="chat-conversation" data-simplebar>
                                    <ul class="list-unstyled chat-conversation-list" id="group-conversation">
                                        <!-- Messages will be dynamically added here -->
                                    </ul>
                                </div>

                                <!-- end chat-conversation -->
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
            <!-- end chat-wrapper -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>


@include('templates.footer')



<!-- Add this to the end of your chat.blade.php file or include it in your main JavaScript file -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
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
    // Attach click event to group buttons
    $('.channel-button').on('click', function () {
        // Get the group name and ID from the clicked button
        var groupName = $(this).find('.ms-2 h6').text();
        var groupId = $(this).data('group-id');

        // Store the selected group's name and ID in sessionStorage
        sessionStorage.setItem('selectedGroupName', groupName);
        sessionStorage.setItem('selectedGroupId', groupId);

        // Update the chat head with the selected group's name
        updateChatHead(groupName);
    });

    // Check if there is a selected group in sessionStorage and update the chat head
    var selectedGroupName = sessionStorage.getItem('selectedGroupName');
    if (selectedGroupName) {
        updateChatHead(selectedGroupName);
    }
});

function updateChatHead(groupName) {
    // Update the chat head with the selected group's name
    $('.flex-grow-1.overflow-hidden h5').text(groupName);
}




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
            formData.append('content', messageInput);
        }

        // If an image is selected, append it to form data
        if (photoInput) {
            formData.append('image', photoInput);
        }

        // Send an AJAX request to create a new message with photo
        $.ajax({
            url: '{{ route("store.group.message", ["groupId" => $groupThread->id]) }}',
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


$(document).ready(function() {

    fetchMessages()

    Pusher.logToConsole = true;

var pusher = new Pusher('54f1c49cb67ee0620dac', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('group-channel');
channel.bind('group-message', function(message) {
    fetchMessages()
});
    // Function to fetch messages
    function fetchMessages() {
        var groupId = "{{ $groupThread->id }}"; // Get the group thread ID from your view
        $.ajax({
            url: '/fetch-messages/' + groupId,
            type: 'GET',
            success: function(response) {
                // Check if messages were fetched successfully
                if (response.messages) {
                    var messages = response.messages;
                    // Update the conversation area with fetched messages
                    updateConversation(messages);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching messages:', error);
            }
        });
    }

// Function to update conversation area with fetched messages
function updateConversation(messages) {
    var conversationList = $('#group-conversation');
    conversationList.empty(); // Clear existing messages

    // Loop through each message and append it to the conversation area
    messages.forEach(function(message) {
        var messageItem = $('<li class="chat-list"></li>');

        // Conditionally apply CSS class for message alignment
        if (message.sender_id == "{{ auth()->user()->id }}") {
            messageItem.addClass('right'); // Align message to the right for logged-in user
        } else {
            messageItem.addClass('left'); // Align message to the left for other users
        }

        // Construct the message content based on message type
        var messageContent;
        if (message.content) {
            // If message is text
            if (message.status) {
                // If message status is true
                messageContent = $('<div class="conversation-list">' +
                    '<div class="user-chat-content">' +
                    '<div class="ctext-wrap">' +
                    '<div class="ctext-wrap-content">' +
                    '<div class="message-dropdown">' +
                    '<p class="mb-0 ctext-content" onclick="toggleDropdown(this)" data-message-id="' + message.id + '">' + message.content + '</p>' +
                    (message.sender_id == "{{ auth()->user()->id }}" ? // Check if the sender is the authenticated user
                    `<div class="dropdown-menu">` +
                    `<a class="dropdown-item" onclick="deleteMessage(this)">Delete</a>` +
                    `</div>` : '') + // Display delete option only for the authenticated user's messages
                    '</div>' +
                    '</div>' +
                    '<div class="conversation-name">' +
                    '<br>' +
                    '<small class="text-muted time">' + formatTime(message.created_at) + '</small>' +
                    '<span class="text-success check-message-icon">' +
                    '<i class="ri-check-double-line align-bottom"></i>' +
                    '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
            } else {
                // If message status is false
                messageContent = $('<div class="conversation-list">' +
                    '<div class="user-chat-content">' +
                    '<div class="ctext-wrap">' +
                    '<div class="ctext-wrap-content">' +
                    '<div class="message-dropdown">' +
                    '<p class="mb-0 ctext-content">Unsent a message</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="conversation-name">' +
                    '<br>' +
                    '<small class="text-muted time">' + formatTime(message.created_at) + '</small>' +
                    '<span class="text-success check-message-icon">' +
                    '<i class="ri-check-double-line align-bottom"></i>' +
                    '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
            }
            } else if (message.image_path) {
                // If message is image
                messageContent = $('<div class="conversation-list">' +
                    '<div class="user-chat-content">' +
                    '<div class="ctext-wrap">' +
                    '<div class="ctext-wrap-content">' +
                    '<div class="message-dropdown" style="position: relative;">' + // Add position: relative; to make positioning easier
                    '<div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">' + // Dark gray transparent background
                    '<a class="view-image-btn" href="#" data-bs-toggle="modal" data-bs-target="#imageModal">' + // Button to trigger modal
                    '</a>' +
                    '</div>' +
                    '<img src="{{ asset('storage') }}/' + message.image_path + '" style="max-width: 200px; max-height: 200px;" class="img-fluid" alt="Image">' +
                    '<div class="dropdown" style="position: absolute; bottom: 0; right: 0;">' + // Position dropdown at the bottom right corner
                    '<a class="dropdown-toggle" href="#" role="button" id="imageDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">' +
                    '<i class="ri-more-fill"></i>' +
                    '</a>' +
                    '<ul class="dropdown-menu" aria-labelledby="imageDropdownMenuLink">' +
                    '<li><a class="dropdown-item" href="{{ asset('storage') }}/' + message.image_path + '" download=""><i class="ri-download-2-line me-2 text-muted align-bottom"></i>Download</a></li>' +
                    '<li><a class="dropdown-item view-image" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>View</a></li>' +
                    '</ul>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="conversation-name">' +
                    '<br>' +
                    '<small class="text-muted time">' + formatTime(message.created_at) + '</small>' +
                    '<span class="text-success check-message-icon">' +
                    '<i class="ri-check-double-line align-bottom"></i>' +
                    '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');

                // Create modal for viewing image
                var modalContent = '<div class="modal-dialog modal-dialog-centered modal-xl">' +
                    '<div class="modal-content">' +
                    '<div class="modal-body">' +
                    '<img src="{{ asset('storage') }}/' + message.image_path + '" class="img-fluid" alt="Image">' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                // Append modal to body
                $('body').append('<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">' + modalContent + '</div>');

                // Click event listener for "View" button
                messageContent.find('.view-image').click(function(e) {
                    e.preventDefault();
                    $('#imageModal').modal('show'); // Show modal when "View" is clicked
                });
        }

        // Append the message content to the message item
        messageItem.append(messageContent);

        // Append the message item to the conversation list
        conversationList.append(messageItem);
    });

    // Scroll to the bottom of the conversation area
    conversationList[0].scrollIntoView({ behavior: "smooth", block: "end" });
}


});

// Function to format time as HH:MM AM/PM
function formatTime(timestamp) {
    var date = new Date(timestamp);
    var hours = date.getHours();
    var minutes = date.getMinutes().toString().padStart(2, '0');
    var amPM = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12; // Convert to 12-hour format
    var formattedTime = hours + ':' + minutes + ' ' + amPM;

    // Check if the date is in the past
    var currentDate = new Date();
    if (date.toDateString() !== currentDate.toDateString()) {
        // If the date is in the past, display the date
        var day = date.getDate();
        var month = date.toLocaleString('default', { month: 'short' });
        formattedTime = month + ' ' + day + ', ' + formattedTime;
    }

    return formattedTime;
}

// Function to toggle dropdown menu
function toggleDropdown(element) {
    var dropdownMenu = element.nextElementSibling;
    dropdownMenu.classList.toggle("show");
}

function deleteMessage(element) {
    var messageItem = element.closest(".chat-list");
    var messageId = messageItem.querySelector('.ctext-content').getAttribute('data-message-id');
    
    // Send a DELETE request to delete the message
    $.ajax({
        url: '/delete-group-message/' + messageId,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            // Check if the response indicates success
            if (response.success) {
                // Update the message content in the conversation area
                var messageContent = messageItem.querySelector('.ctext-content');
                messageContent.textContent = 'Unsent a message';
                messageContent.style.fontStyle = 'italic';
                // Remove the dropdown menu
                var dropdownMenu = messageItem.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.remove();
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}





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