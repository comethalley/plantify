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
                                    <!-- <div class="flex-shrink-0">
                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="Add Contact">

                                            Button trigger modal
                                            <button type="button" class="btn btn-soft-success btn-sm">
                                                <i class="ri-add-line align-bottom"></i>
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="search-box">
                                    <input type="text" class="form-control bg-light border-light" id="searchInput" placeholder="Search here...">
                                    <i class="ri-search-2-line search-icon"></i>
                                </div>

                                <ul class="list-unstyled chat-list chat-user-list" id="listUser">
                                    <!-- User list items will be dynamically added here -->
                                </ul>
                            </div> <!-- .p-4 -->

                            <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab">
                                        Chats
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab">
                                        Contacts
                                    </a>
                                </li> -->
                            </ul>

                            <div class="tab-content text-muted">
                                <div class="tab-pane active" id="chats" role="tabpanel">
                                    <div class="chat-room-list pt-3" data-simplebar>
                                        <div class="d-flex align-items-center px-4 mb-2">
                                            <div class="flex-grow-1">
                                                <h4 class="mb-0 fs-11 text-muted text-uppercase">Direct Messages</h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <!-- <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="New Message">
        
                                                    Button trigger modal
                                                    <button type="button" class="btn btn-soft-success btn-sm shadow-none">
                                                        <i class="ri-add-line align-bottom"></i>
                                                    </button>
                                                </div> -->
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








        
                                        <div class="d-flex align-items-center px-4 mt-4 pt-2 mb-2">
                                            <div class="flex-grow-1">
                                                <h4 class="mb-0 fs-11 text-muted text-uppercase">Group Chats</h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <!-- <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="Create group">
                                                    Button trigger modal
                                                    <button type="button" class="btn btn-soft-success btn-sm">
                                                        <i class="ri-add-line align-bottom"></i>
                                                    </button>
                                                </div> -->
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
                        <div class="user-chat w-100 overflow-hidden" style="background-image: url('{{ asset('assets/images/chat_bg.png') }}'); background-size: cover; position: relative;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                <p style="font-size: 27px;">Select a chat or start a new conversation</p>
                            </div>
                        </div>
                            <div class="chat-content d-lg-flex">
                                <!-- start chat conversation section -->
                                <div class="w-100 overflow-hidden position-relative">
                                    <!-- conversation user -->
                                    <div class="position-relative">
                                        

                                        <div class="position-relative" id="users-chat">
                                            
                                            <!-- end chat user head -->
                                            <div class="chat-conversation p-3 p-lg-4 " id="chat-conversation" data-simplebar>
                                                
                                                <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                                    
                                                </ul>
                                                <!-- end chat-conversation-list -->
                                            </div>
                                            <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show " id="copyClipBoard" role="alert">
                                                Message copied
                                            </div>
                                        </div>

                                        
                                        <!-- end chat user head -->
                                            
                                        </div>

                                        <!-- end chat-conversation -->

                                    

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
        </div>    
        <!-- end main content-->


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
    // Attach click event to channel buttons
    $('.channel-button').on('click', function () {
        var groupId = $(this).data('group-id');

        // Get the CSRF token value
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Assuming you have an API or route to mark messages as read for group chat
        $.ajax({
            url: '/mark-group-messages-as-read/' + groupId,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                // Update the UI to remove or update the badge
                $('#unreadBadge_' + groupId).remove();
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
            $('#listUser').empty();
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
        $('#listUser').empty();

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
            $('#listUser').append(userItem);
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













