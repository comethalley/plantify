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
                                <div class="flex-shrink-0">
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="Add Contact">
                                        <button type="button" class="btn btn-soft-success btn-sm">
                                            <i class="ri-add-line align-bottom"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="search-box">
                                <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                                <i class="ri-search-2-line search-icon"></i>
                            </div>
                        </div> <!-- .p-4 -->
    
                        <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab">
                                    Chats
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab">
                                    Contacts
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
                                        <div class="flex-shrink-0">
                                            <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="New Message">
                                                <button type="button" class="btn btn-soft-success btn-sm shadow-none">
                                                    <i class="ri-add-line align-bottom"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="chat-message-list">
                                        <ul class="list-unstyled chat-list chat-user-list" id="userList">
                                            @forelse($users as $user)
                                                <button type="button" class="btn member-button" data-member-id="{{ $user->id }}" data-thread-id="{{ $user->thread_id }}" >
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
                                            @empty
                                                <p>No other users found.</p>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
    
                                <div class="d-flex align-items-center px-4 mt-4 pt-2 mb-2">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-0 fs-11 text-muted text-uppercase">Channels</h4>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="Create group">
                                            <button type="button" class="btn btn-soft-success btn-sm">
                                                <i class="ri-add-line align-bottom"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="chat-message-list">
                                    <ul class="list-unstyled chat-list chat-user-list mb-0" id="channelList">
                                        @forelse($groups as $group)
                                            @if(auth()->user()->role_id == 2 && $group->group_name == 'Admin and Farm Leaders')
                                                {{-- Display only for role_id 2 (Admin and Farm Leaders) --}}
                                                <button type="button" class="btn channel-button" data-group-id="{{ $group->id }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">{{ $group->group_name }}</h6>
                                                        </div>
                                                    </div>
                                                </button>
                                            @elseif(auth()->user()->role_id == 3)
                                                {{-- Display for role_id 3 (both Admin and Farm Leaders, Farm Leader and Farmers) --}}
                                                <button type="button" class="btn channel-button" data-group-id="{{ $group->id }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">{{ $group->group_name }}</h6>
                                                        </div>
                                                    </div>
                                                </button>
                                            @elseif(auth()->user()->role_id == 4 && $group->group_name == 'Farm Leader and Farmers')
                                                {{-- Display only for role_id 4 (Farm Leader and Farmers) --}}
                                                <button type="button" class="btn channel-button" data-group-id="{{ $group->id }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">{{ $group->group_name }}</h6>
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
                    <div class="user-chat w-100 overflow-hidden">
                        <div class="chat-content d-lg-flex" style="background-image: url('{{ asset('assets/images/chat_bg.png') }}'); background-size: cover; ">
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
                                                            <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                    <img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="">
                                                                    <!-- <span class="user-status"></span> -->
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
                                                        <li class="list-inline-item m-0">
                                                            <div class="dropdown">
                                                                <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="search" class="icon-sm"></i>
                                                                </button>
                                                                <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                    <div class="p-2">
                                                                        <div class="search-box">
                                                                            <input type="text" class="form-control bg-light border-light" placeholder="Search here..." onkeyup="searchMessages()" id="searchMessage">
                                                                            <i class="ri-search-2-line search-icon"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                            <button type="button" class="btn btn-ghost-secondary btn-icon" data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">
                                                                <i data-feather="info" class="icon-sm"></i>
                                                            </button>
                                                        </li>

                                                        <li class="list-inline-item m-0">
                                                            <div class="dropdown">
                                                                <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="more-vertical" class="icon-sm"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item d-block d-lg-none user-profile-show" href="#"><i class="ri-user-2-fill align-bottom text-muted me-2"></i> View Profile</a>
                                                                    <a class="dropdown-item" href="#"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i> Archive</a>
                                                                    <a class="dropdown-item" href="#"><i class="ri-mic-off-line align-bottom text-muted me-2"></i> Muted</a>
                                                                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i> Delete</a>
                                                                </div>
                                                            </div>
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
                                                                        <p class="mb-0 ctext-content" onclick="toggleDropdown(this)">{{ $message->content }}</p>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" onclick="deleteMessage(this)">Delete</a>
                                                                            <a class="dropdown-item" href="#" onclick="replyToMessage(this)">Reply</a>
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
                                                            <button type="button" class="btn btn-link text-decoration-none emoji-btn" id="emoji-btn">
                                                                <i class="bx bx-smile align-middle"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="chat-input-feedback">
                                                        Please Enter a Message
                                                    </div>
                                                    <input type="text" class="form-control chat-input bg-light border-light" id="chat-input" placeholder="Type your message..." autocomplete="off">
                                                </div>
                                                <div class="col-auto">
                                                    <div class="chat-input-links ms-2">
                                                        <div class="links-list-item">
                                                            <button type="button" class="btn btn-success chat-send waves-effect waves-light" id="send-btn">
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
        // Get the group ID from the data attribute
        var groupId = $(this).data('group-id');

        // Redirect to the group details page
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

    // Check if there is a selected group in sessionStorage and update the top bar
    var selectedGroupName = sessionStorage.getItem('selectedGroupName');
    if (selectedGroupName) {
        updateChatHead(selectedGroupName);
    }
});

function updateChatHead(groupName) {
    // Update the chat head with the selected group's name
    $('.username').text(groupName);
}



document.getElementById("chatinput-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    var messageInput = document.getElementById("chat-input");
    var message = messageInput.value.trim(); // Get the message text and remove leading/trailing whitespace

    if (message !== "") {
        // Replace 'currentGroupId' with the actual ID of the current group
        var currentThreadId = '{{ $groupThread->id }}';

        // Send an AJAX request to create a new group message
        $.ajax({
            url: '{{ route("store.group.message", ["groupId" => ":groupId"]) }}'.replace(':groupId', currentThreadId),
            type: 'POST',
            data: {
                'content': message,
                '_token': '{{ csrf_token() }}',
            },
            success: function (response) {
                // Check if the response indicates success
                if (response.success) {
                    // The rest of your code to append the message to the conversation
                    var groupConversation = document.getElementById("group-conversation");
                    var messageItem = document.createElement("li");
                    messageItem.className = "chat-list right";
                    messageItem.innerHTML = `
                        <div class="conversation-list">
                            <div class="user-chat-content">
                                <div class="ctext-wrap">
                                    <div class="ctext-wrap-content">
                                        <div class="message-dropdown">
                                            <p class="mb-0 ctext-content" onclick="toggleDropdown(this)">${message}</p>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" onclick="deleteMessage(this)">Delete</a>
                                                <a class="dropdown-item" href="#" onclick="replyToMessage(this)">Reply</a>
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
                    groupConversation.appendChild(messageItem);

                    messageInput.value = ""; // Clear the input field
                } else {
                    console.error('Error:', response.error); // Log the error
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
});
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
    // Add code to send a DELETE request to delete the message from the database
    // ...

    // Remove the message from the conversation in the front end
    messageItem.remove();
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

</script>