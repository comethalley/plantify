
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

@foreach ($questions as $question)

<div class="dropdown" style=" max-width: 600px; margin: 0 auto; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);   display: grid; background-color:white; margin-bottom:20px; padding:30px; border-radius:13px; ">

    <div style="display: flex; justify-content:space-between;">
        <div style="display: flex; justify-content:space-between;">
           
        @if($profileSettings->profile_image)
                            <img style="width:40px; height:40px; padding: 2px; border: 3px solid #006400;" src="{{ asset('storage/images/' . $profileSettings->profile_image) }}" alt="Profile Image" class="rounded-circle avatar-xl img-thumbnail user-profile-image">
                            @else
                            <div class="avatar-lg">
                                <img style="padding: 2px; border: 3px solid #006400;" src="assets/images/plantifeedpics/profile-default.png" alt="user-img" class="img-thumbnail rounded-circle">
                            </div>

                            @endif
            <p style="margin: 0;">
                <strong>{{ $question->firstname }} {{ $question->lastname }}</strong> <span style="color: grey;"></span>
                <br> <span style="color: grey;">{{ date('h:i:s A', strtotime($question->created_at)) }}</span>
            </p>
        </div>



        <img src="/assets/images/plantifeedpics/edit.png" alt="Image" class="toggle-image" style="height:20px; width: 20px; cursor: pointer; margin-left: 10px;" onclick="toggleDropdown(this)">


        <div class="dropdown-content" style=" display: none; position: absolute; background-color: white; width: 82,66px; box-shadow: 0px -8px 16px 0px rgba(0,0,0,0.2); z-index: 1; left: 97%;">

            @if(Auth::check() && Auth::user()->id == $question->user_id)

            <button onclick="openEditModal('{{ $question->id }}')" style="width:100%; background-color:white; border:none; color:black; text-align:center; text-decoration:none; display:inline-block; font-size:13px; padding:20px; cursor:pointer;" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='white'">
            <div style="display: flex; align-items: center;">
    <img src="/assets/images/plantifeedpics/edits.png" alt="Edit" style="height: 20px; width: 20px; margin-right: 10px;">
    <p style="margin: 0;">Edit</p>
</div>

            </button>

            <div id="questionModal{{ $question->id }}" style="display:none; position:fixed; z-index:1; left:50px; top:0px; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.4);">
                <!-- Modal content -->
                <div style="margin-top:10%; margin-left:30%; background-color:#fefefe; padding:20px; border:1px solid #888; width:40%; ">
                    <form id="editQuestionForm{{ $question->id }}" action="{{ route('editQuestion', ['id' => $question->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p style="text-align:center; font-weight:bold; font-size:20px;">Edit Question</p>

                        <textarea required placeholder="What's on your mind?" id="editQuestionInput{{ $question->id }}" name="question" style="font-size:15px; resize: none; width: 100%; border: none; outline: none;" rows="8"></textarea>

                        @error('question')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div style="display: flex;">
                            <button type="button" onclick="closeEditModal('{{ $question->id }}')" style="background-color:#F6F6F6; border:none; color:black; padding:10px 20px; text-align:center; text-decoration:none; display:inline-block; font-size:13px; margin:4px 2px; cursor:pointer; width:100%;" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='#F6F6F6'">
                                Close
                            </button>

                            <button type="submit" style="width:100%; background-color:#364574; border:none; color:white; padding:10px 20px; text-align:center; text-decoration:none; display:inline-block; font-size:13px; margin:4px 2px; cursor:pointer;" onmouseover="this.style.backgroundColor='#364574'" onmouseout="this.style.backgroundColor='#405189'">Save</button>
                        </div>
                    </form>

                </div>
            </div>
            <script>
                function openEditModal(questionId) {
                    document.getElementById('questionModal' + questionId).style.display = 'block';
                }

                function closeEditModal(questionId) {
                    document.getElementById('questionModal' + questionId).style.display = 'none';
                }

                function saveQuestionEdit(questionId) {
                    var form = document.getElementById('editQuestionForm' + questionId);
                    var formData = new FormData(form);

                    fetch('/edit-question/' + questionId, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data);
                            setTimeout(function() {
                                window.location.reload();
                            }, 500); // Bawasan ang delay sa 0.5 segundo bago mag-refresh
                        })
                        .catch(error => {
                            console.error('There has been a problem with your fetch operation:', error);
                            // swal("Error", "There was an error updating the question", "error");
                            // ^ Tinanggal ko ang bahaging ito na nagpapakita ng SweetAlert
                        });
                }
            </script>

            <br>

            <button class="delete-question" data-question-id="{{ $question->id }}" style="background-color: white; border: none; color: black; text-align: center; text-decoration: none; display: inline-flex; align-items: center; font-size: 13px; padding: 20px; cursor: pointer;" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='white'">
    <i class="fas fa-trash-alt" style="margin-right: 5px;"></i>
    <span>Delete</span>
</button>





            @else
            
            <style>
    button:hover {
   
        background-color: white; /* Kulay ng background kapag nai-hover */
    }
</style>

<button onclick="openReportModalQuestion('{{ $question->id }}')" style="padding: 20px; display: flex; align-items: center; color: black; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='white'">
    <i class="fas fa-exclamation-triangle" style="margin-right: 5px;"></i>
    <span style="flex: 1; text-align: left;">Report</span>
</button>




            <div id="reportModalQuestion{{ $question->id }}" style="display: none; position: fixed; z-index: 1; left: 70px; top: 20px; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4);">

                <!-- Question Report Modal content -->
                <div style="background-color: #fefefe; margin: 5% auto; padding: 40px; border: 1px solid #888; width: 44%;">
                    <button onclick="closeReportModalQuestion('{{ $question->id }}')" style="color: #aaa; border: none; padding: 0; background-color: transparent; float: right; font-size: 28px; font-weight: bold; cursor: pointer;" onmouseover="this.style.color='#000';" onmouseout="this.style.color='#aaa';">&times;</button>


                    <div class="report-container" style="display: flex; flex-direction: column;">
                        <p style="font-weight: bold; font-size:18px;">Report Content</p>

                        <form action="{{ route('reports.store') }}" method="post" style=" display: flex; flex-direction: column; align-items: flex-start;">
                            @csrf
                            <!-- Radio buttons for reporting options -->
                            <div class="label-container" style="display:flex;">
                                <input required type="radio" id="content-1" name="question_report" value="Spam" style="margin-right:5px; width: 20px; height: 20px;">
                                <label style="font-weight:bold; margin: 0;" for="content-1">Spam</label>
                            </div>
                            <div style="margin-left: 25px;">Selling illegal goods, money scams etc.</div>

                            <div class="label-container" style="display:flex; margin-top: 10px;">
                                <input required type="radio" id="content-2" name="question_report" value="Harmful Activities" style="margin-right:5px; width: 20px; height: 20px;">
                                <label style="font-weight:bold; margin: 0;" for="content-2">Harmful Activities</label>
                            </div>
                            <div style="margin-left:25px;">Glorifying violence including self-harm or intent to seriously harm others.</div>

                            <div class="label-container" style="display:flex; margin-top: 10px;">
                                <input required type="radio" id="content-3" name="question_report" value="Harassment and Bullying" style="margin-right:5px; width: 20px; height: 20px;">
                                <label style="font-weight:bold; margin: 0;" for="content-3">Harassment and Bullying</label>
                            </div>
                            <div style="margin-left:25px;">Harassing or threatening an individual.</div>

                            <div class="label-container" style="display:flex; margin-top: 10px;">
                                <input required type="radio" id="content-4" name="question_report" value="Hate Speech" style="margin-right:5px; width: 20px; height: 20px;">
                                <label style="font-weight:bold; margin: 0;" for="content-4">Hate Speech</label>
                            </div>
                            <div style="margin-left:25px;">Serious attack on a group.</div>

                            <div class="label-container" style="display:flex; margin-top: 10px;">
                                <input required type="radio" id="content-5" name="question_report" value="Sexual Exploitation" style="margin-right:5px; width: 20px; height: 20px;">
                                <label style="font-weight:bold; margin: 0;" for="content-5">Sexual Exploitation</label>
                            </div>
                            <div style="margin-left:25px;">Sexually explicit or suggestive imagery or writing involving minors.</div>

                            <div class="label-container" style="display:flex; margin-top: 10px;">
                                <input required type="radio" id="content-6" name="question_report" value="Abuse" style="margin-right:5px; width: 20px; height: 20px;">
                                <label style="font-weight:bold; margin: 0;" for="content-6">Abuse</label>
                            </div>
                            <div style="margin-left:25px;">Various forms of improper use or exploitation of a situation, person, or thing.</div>

                            <div class="label-container" style="display:flex; margin-top: 10px;">
                                <input required type="radio" id="content-7" name="question_report" value="Plagiarism" style="margin-right:5px; width: 20px; height: 20px;">
                                <label style="font-weight:bold; margin: 0;" for="content-7">Plagiarism</label>
                            </div>
                            <div style="margin-left:25px;">Reusing content without attribution.</div>

                            <div class="label-container" style="display:flex; margin-top: 10px; align-items:center;">
                                <label style="font-weight:bold; margin: 0;" for="content-8">Other</label>
                                <input type="text" id="content-8" name="question_report_other" placeholder="Specify here..." style=" outline:none; border:none; border-bottom: 1px solid ; width: 500px; margin-left:5px;">
                            </div>
                            <div style="margin-left:42px;">Other reason for reporting.</div>

                            <input type="submit" value="Submit" style="border-radius:10px; margin-left: 84%; margin-top:10px; background-color:#F3F6F9; border:none; padding:8px; width:90px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#E6E6E6'" onmouseout="this.style.backgroundColor='#F3F6F9'">


                        </form>

                    </div>
                </div>
            </div>

            <script>
                function openReportModalQuestion(questionId) {
                    var modalId = "reportModalQuestion" + questionId;
                    var modal = document.getElementById(modalId);
                    modal.style.display = "block";
                }

                function closeReportModalQuestion(questionId) {
                    var modalId = "reportModalQuestion" + questionId;
                    var modal = document.getElementById(modalId);
                    modal.style.display = "none";
                }
            </script>




            @endif

        </div>
    </div>


    <p style=" margin-top:20px; margin-bottom:0px;">{{ $question->question }}</p>
    <img src="/assets/images/plantifeedpics/line-2.png" style="width: 100%; margin-top:15px;">

    <div style="margin-top: 10px; display:flex; justify-content:space-evenly;">

        <button onclick="toggleLike('{{ $question->id }}')" style="border: none; background-color:transparent;">
            <img src="assets/images/plantifeedpics/unlike.png" alt="like" id="likeIcon{{ $question->id }}" style="padding:10px;width:50px;height:50px;" onmouseover="this.style.backgroundColor='lightgray';this.style.borderRadius='25px';" onmouseout="this.style.backgroundColor='transparent'; this.style.borderRadius='25px';">
            <span id="likeCount{{ $question->id }}">0</span>
        </button>


        <style>
            /* Define animation keyframes */
            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.2);
                }

                100% {
                    transform: scale(1);
                }
            }

            /* Apply animation to the like icon */
            .liked {
                animation: pulse 0.5s ease-in-out;
            }
        </style>

        <script>
            // Initialize like status and counters for each question
            var likeStatus = {}; // Object to store like status for each question
            var likeCounters = {}; // Object to store like counters for each question

            function toggleLike(questionId) {
                // Initialize like counter and status for the current question if not already set
                if (!likeCounters[questionId]) {
                    likeCounters[questionId] = 0;
                    likeStatus[questionId] = false;
                }

                // Increment or decrement like counter and toggle like status for the current question
                if (!likeStatus[questionId]) {
                    likeCounters[questionId]++;
                    likeStatus[questionId] = true;
                } else {
                    likeCounters[questionId]--;
                    likeStatus[questionId] = false;
                }

                // Update like count display for the current question
                document.getElementById('likeCount' + questionId).innerText = likeCounters[questionId];

                // Add 'liked' class to trigger animation for the current question
                document.getElementById('likeIcon' + questionId).classList.add('liked');

                // Remove 'liked' class after animation ends for the current question
                setTimeout(function() {
                    document.getElementById('likeIcon' + questionId).classList.remove('liked');
                }, 500);

                // You can include AJAX request here to send like status to the server
            }
        </script>





        <button type="button" onclick="showComments('{{ $question->id }}','{{ $question->firstname }}')" style="display: flex; align-items:center; padding: 10px 20px; background-color: white; color: black; border: none; border-radius: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='lightgray';" onmouseout="this.style.backgroundColor='white';">
            <img src="assets/images/plantifeedpics/comment.png" alt="Comment" style="height: 20px; width: 20px; margin-right: 10px;">
            {{ $question->comment_count }}
        </button>

    </div>
</div>
@endforeach

<!--Comment Modal-->
<div class="modal fade bs-example-modal-lg" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">

                <h5 class="modal-title" id="exampleModalScrollableTitle">
                    <span id="userFirstname"></span>'s
                    Post
                </h5>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">


                <div id="comments_body">

                </div>
                <div id="reply_body" style="display:block;">

                </div>


            </div>
            <form action="{{ route('comments.store') }}" id="commentForm" method="POST">
                @csrf
                <div class="modal-footer" style="display: flex;justify-content:space-between;">


                    <input type="hidden" id="forum_id" name="forum_id">
                    <div>
                        <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 30px; height: 30px;">
                    </div>
                    <div style="flex:1;">
                        <input type="text" class="form-control" name="content" id="commentInput">
                    </div>
                    <div>
                        <button id="submitComment" type="submit" class="btn btn-secondary waves-effect waves-light">Comment</button>
                    </div>


                </div><!-- /.modal-content -->
            </form>
            <form action="/reply/store" id="replyForm" method="POST" style="display: none;">
                @csrf
                <h6 style="margin-left: 20px;margin-top:10px;">Reply to <span id="replyTo"></span>'s Comment</h6>
                <div class="modal-footer" style="display: flex;justify-content:space-between;">

                    <input type="hidden" id="comment_id" name="comment_id">
                    <div>
                        <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 30px; height: 30px;">
                    </div>
                    <div style="flex:1;">
                        <input type="text" class="form-control" name="content" id="replyInput">
                    </div>
                    <div>
                        <button id="submitReply" type="submit" class="btn btn-secondary waves-effect waves-light">Reply</button>
                    </div>


                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('54f1c49cb67ee0620dac', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('comment-channel');
        channel.bind('comment-event', function(data) {
            //alert(JSON.stringify(data));
            getComments(data.id)
        });

        var replychannel = pusher.subscribe('reply-channel');
        replychannel.bind('reply-event', function(data) {
            //alert(JSON.stringify(data));
            getReply(data.id)
        });

        function showComments(id, username) {
            $('#userFirstname').text(username)
            $('#forum_id').val(id)
            getComments(id)
            $('#exampleModalScrollable').modal('show')
            $('#comment-section').hide()
            $('#commentForm').show()
            $('#reply_body').hide()
            $('#replyForm').hide()
        }

        function backComment(id, username) {

            $('#comment-section').show()
            $('#commentForm').show()
            $('#reply_body').hide()
            $('#replyForm').hide()
        }

        function getComments(id) {

            $.ajax({
                url: '/getComment/' + id, // Example URL for demonstration
                method: 'GET',
                success: function(response) {
                    // Handle success response
                    //$('#post').html(response)
                    $('#comments_body').html(response)

                },
                error: function(xhr, status, error) {
                    // Handle error response
                    $('#post').html('Error occurred: ' + error);
                }
            });
        }

        $('#submitComment').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Serialize form data
            var formData = $('#commentForm').serialize();

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: $('#commentForm').attr('action'),
                data: formData,
                success: function(response) {

                    console.log(response);
                    $('#commentInput').val('');

                },
                error: function(xhr, status, error) {

                    console.error(xhr.responseText);
                }
            });
        });

        function showReply(id, name) {
            $('#comment-section').hide()
            getReply(id)
            $('#reply_body').show()
            $('#commentForm').hide()
            $('#replyTo').text(name)
            $('#comment_id').val(id)
            $('#replyForm').show()
        }

        function getReply(id) {
            //alert('you clicked the reply button')

            $.ajax({
                url: '/getReply/' + id, // Example URL for demonstration
                method: 'GET',
                success: function(response) {
                    // Handle success response
                    //$('#post').html(response)
                    // $('#comment-section').hide()
                    $('#reply_body').html(response)
                    //$('#reply_body').show()
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    $('#reply_body').html('Error occurred: ' + error);
                }
            });
        }

        $('#submitReply').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Serialize form data
            var formData = $('#replyForm').serialize();

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: $('#replyForm').attr('action'),
                data: formData,
                success: function(response) {

                    console.log(response);
                    $('#replyInput').val('');

                },
                error: function(xhr, status, error) {

                    console.error(xhr.responseText);
                }
            });
        });
    </script>