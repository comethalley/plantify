@include('templates.header')

<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top:100px; ">
    <div class="main-content" style="display: flex; flex-direction: column; width: 58%; padding:20px; row-gap:5px;">
        @if (!empty($searchTerm))
        <div>
            <p style=" margin:0; font-family: Poppins, sans-serif; font-weight:bold; background-color:white; padding:20px;">Results for : {{ $searchTerm }}</p>
        </div>
        @endif
        @if (isset($questions) && count($questions) > 0)

        <div>
            @foreach ($questions as $question)
            <div class="dropdown" style=" box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);   display: grid; background-color:white; margin-bottom:20px; padding:30px;  ">

                <div style="display: flex; justify-content:space-between;">
                    <p style="margin: 0;">
                        <strong>{{ $question->firstname }} {{ $question->lastname }}</strong> <span style="color: grey;"></span>
                        <br> <span style="color: grey;">{{ date('h:i:s A', strtotime($question->created_at)) }}</span>
                    </p>



                    <img src="/assets/images/plantifeedpics/edit.png" alt="Image" class="toggle-image" style="height:20px; width: 20px; cursor: pointer; margin-left: 10px;" onclick="toggleDropdown(this)">


                    <div class="dropdown-content" style=" display: none; position: absolute; background-color: white; width: 82,66px; box-shadow: 0px -8px 16px 0px rgba(0,0,0,0.2); z-index: 1; left: 97%;">

                        @if(Auth::check() && Auth::user()->id == $question->user_id)

                        <button onclick="openEditModal('{{ $question->id }}')" style="width:100%; background-color:white; border:none; color:black; text-align:center; text-decoration:none; display:inline-block; font-size:13px; padding:20px; cursor:pointer;" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='white'">
                            <div style="display: flex; ">

                                <img src="/assets/images/plantifeedpics/edits.png" alt="Edit" style="height:20px; width:20px; margin-right:15px;">
                                <p>Edit</p>

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

                        <button class="delete-question" data-question-id="{{ $question->id }}" style="background-color:white; border:none; color:black; text-align:center; text-decoration:none; display:inline-block; font-size:13px; padding:20px; cursor:pointer;" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='white'">
                            <div style="display: flex;">
                                <img src="/assets/images/plantifeedpics/delete.png" alt="Delete" style="height:23px; width:23px; margin-right:15px;">
                                Delete
                            </div>
                        </button>



                        @else

                        <button onclick="openReportModalQuestion('{{ $question->id }}')" style="display:flex; align-items:center; padding: 10px 20px; background-color: white; color: black; border: none;  cursor: pointer; " onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='white'">
                            <img src=" /assets/images/plantifeedpics/report.png" alt="Report" style="height: 20px; width: 20px; margin-right: 10px;">
                            Report
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
                        <img src="assets/images/plantifeedpics/like.png" alt="like" id="likeIcon{{ $question->id }}" style="padding:10px;" onmouseover="this.style.backgroundColor='lightgray';this.style.borderRadius='25px';" onmouseout="this.style.backgroundColor='transparent'; this.style.borderRadius='25px';">
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





                    <button type="button" onclick="openCommentModal('{{ $question->question }}', '{{ $question->language }}')" style="display: flex; align-items:center; padding: 10px 20px; background-color: white; color: black; border: none; border-radius: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='lightgray';" onmouseout="this.style.backgroundColor='white';">
                        <img src="assets/images/plantifeedpics/comment.png" alt="Comment" style="height: 20px; width: 20px; margin-right: 10px;">
                        Comment
                    </button>

                </div>



                <div id="commentModal" style=" display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%;  background-color: rgba(0,0,0,0.4);">
                    <div class="modal-content" style="height:600px; overflow:scroll; background-color: #fefefe; margin: 5% auto; padding: 20px; border: 1px solid #888; width: 630px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <span style="margin-left:215px; color: black; font-size: 22px; font-weight: bold; cursor: pointer;">{{ $question->firstname }} 's Post</span>
                            </div>
                            <span onclick="closeCommentModal()" style="color: #aaa; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
                        </div>

                        <img src="/assets/images/plantifeedpics/line.png" alt="line-img" style="width:560px; margin-top:10px; ">
                        <div style="display:flex; margin-top:20px; margin-bottom:20px;">

                            <p style="margin:0; font-weight:bold; "> {{ $question->firstname }} {{ $question->lastname }}-
                                <br> {{ date('h:i:s A', strtotime($question->created_at)) }}
                            </p>
                            <span class="language-text"></span>
                        </div>

                        <span class="question-text"></span>






                        <form method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                            @csrf
                            <textarea required style="width:100%; resize:none; outline: none; border-radius:20px; padding:10px; border:none; background-color:#F0F0F0;" name="content" placeholder="Enter your comment"></textarea> <br>


                            <div style=" margin-top:20px; display: flex; justify-content:space-between; column-gap:20px; align-items:center;">
                                <input required style=" border-radius:20px; padding: 9px; color:white; width:100%; background-color:#57aa2c; text-align:center; " type="file" name="image">
                                <button style=" border-radius:20px; width:100%; border: none; background-color: #57aa2c; color: white; padding: 11px;" type="submit">Submit</button>
                            </div>

                        </form>


                    </div>
                </div>


            </div>
            @endforeach
        </div>

        <div>

            @foreach($posts as $post)
            <div style="margin-bottom:20px;  display:grid; background-color:white; padding:30px; border-radius:13px; position: relative; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);">

                <div style="display: flex; justify-content:space-between;">

                    <p> <strong>{{ $post->firstname }} {{ $post->lastname }}</strong>
                        <br>
                        <span style="color: grey;">{{ date('h:i:s A', strtotime($post->created_at)) }}</span>
                    </p>



                    <img src="/assets/images/plantifeedpics/edit.png" alt="Image" class="toggle-image" style="height:20px; width: 20px; cursor: pointer; margin-left: 10px;" onclick="toggleDropdownPost(this)">
                    <div class="dropdown-content-pusy" style=" display: none; position: absolute; background-color: #f9f9f9; width: 110px; box-shadow: 0px -8px 16px 0px rgba(0,0,0,0.2); z-index: 1; left: 97%;">

                        @if(Auth::check() && Auth::user()->id == $post->user_id)


                        <button onclick="openPostEditModal('{{ $post->id }}')" style="width:100%; background-color:white; border:none; color:black; text-align:center; text-decoration:none; display:inline-block; font-size:13px; padding:20px; cursor:pointer;" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='white'">
                            <div style="display: flex;">
                                <img src="/assets/images/plantifeedpics/edits.png" alt="Edit" style="height:20px; width:20px; margin-right:15px;">
                                <p>Edit</p>
                            </div>
                        </button>

                        <div id="postEditModal{{ $post->id }}" style="display:none; position:fixed; z-index:1; left:50px; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.4);">
                            <!-- Modal content -->
                            <div style="margin-top:10%; margin-left:30%; background-color:#fefefe; padding:20px; border:1px solid #888; width:40%;">
                                <form id="editPostForm{{ $post->id }}" action="{{ route('editPost', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <p style="text-align:center; font-weight:bold; font-size:20px;">Edit Post</p>

                                    <textarea required placeholder="What's on your mind?" id="editPostInput{{ $post->id }}" name="post" style="font-size:15px; resize:none; width: 100%; border:none; outline:none;" rows="8"></textarea>

                                    <!-- Display error message if there's a validation error for 'post' field -->
                                    @error('post')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <input type="file" name="image"> <!-- Additional input field for image -->

                                    <div style="display: flex;">
                                        <button type="button" onclick="closePostEditModal('{{ $post->id }}')" style="background-color:#F6F6F6; border:none; color:black; padding:10px 20px; text-align:center; text-decoration:none; display:inline-block; font-size:13px; margin:4px 2px; cursor:pointer; width:100%;" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='#F6F6F6'">
                                            Close
                                        </button>

                                        <button type="submit" style="width:100%; background-color:#364574; border:none; color:white; padding:10px 20px; text-align:center; text-decoration:none; display:inline-block; font-size:13px; margin:4px 2px; cursor:pointer;" onmouseover="this.style.backgroundColor='#364574'" onmouseout="this.style.backgroundColor='#405189'">Save</button>
                                    </div>
                                </form>


                            </div>
                        </div>


                        <script>
                            function openPostEditModal(postId) {
                                document.getElementById('postEditModal' + postId).style.display = 'block';
                            }

                            function closePostEditModal(postId) {
                                document.getElementById('postEditModal' + postId).style.display = 'none';
                            }

                            function savePostEdit(postId) {
                                var form = document.getElementById('editPostForm' + postId);
                                var formData = new FormData(form);

                                fetch('/edit-post/' + postId, {
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
                                        swal("Error", "There was an error updating the question", "error");
                                    });
                            }
                        </script>


                        <br>

                        <button style="background-color: white; border: none; color: black; text-align: center; text-decoration: none; display: inline-block; font-size: 13px; padding: 20px; cursor: pointer;" class="delete-post" data-post-id="{{ $post->id }}" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='white'">
                            <img src=" /assets/images/plantifeedpics/delete.png" alt="Delete Post" style="width: 20px; height: 20px; vertical-align: middle; margin-right: 5px;">
                            Delete
                        </button>


                        @else

                        <button onclick="openReportModal('{{ $post->id }}')" style="display:flex; align-items:center; padding: 10px 20px; background-color: white; color: black; border: none; border-radius: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor='white'">

                            <img src=" /assets/images/plantifeedpics/report.png" alt="Report" style="height: 20px; width: 20px; margin-right: 10px;">
                            Report
                        </button>

                        <div id="reportModal{{ $post->id }}" style="display: none; position: fixed; z-index: 1; left: 70px; top: 20px; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4);">

                            <!-- Report Modal content -->
                            <div style="background-color: #fefefe; margin: 5% auto; padding: 40px; border: 1px solid #888; width: 44%;">
                                <button onclick="closeReportModalPost('{{ $post->id }}')" style="color: #aaa; border: none; padding: 0; background-color: transparent; float: right; font-size: 28px; font-weight: bold; cursor: pointer;" onmouseover="this.style.color='#000';" onmouseout="this.style.color='#aaa';">&times;</button>


                                <div class="report-container" style="display: flex; flex-direction: column;">
                                    <p style="font-weight: bold; font-size:18px;">Report Content</p>

                                    <form action="{{ route('reports.store') }}" method="post" style="display: flex; flex-direction: column; align-items: flex-start;">
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
                            function openReportModal(postId) {
                                var modalId = "reportModal" + postId;
                                var modal = document.getElementById(modalId);
                                modal.style.display = "block";
                            }

                            function closeReportModalPost(postId) {
                                var modalId = "reportModal" + postId;
                                var modal = document.getElementById(modalId);
                                modal.style.display = "none";
                            }
                        </script>


                        @endif

                    </div>
                </div>

                <div id="postModal" class="modal" style="display: none;">
                    <div class="modal-content" style="background-color: #fefefe; margin: 5% auto; padding: 20px; border: 1px solid #888; width: 600px;">
                        <span class="modal-close" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;" onclick="closePostModal()">&times;</span>
                        <h2 id="postTitle"></h2>
                        <p id="postContent"></p>
                        {{ $post->firstname }} {{ $post->lastname }}
                        <br> {{ date('h:i:s A', strtotime($post->created_at)) }}
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">

                        <form method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                            @csrf
                            <textarea required style="width:100%; resize:none; outline: none; border-radius:20px; padding:10px; border:none; background-color:#F0F0F0;" name="content" placeholder="Enter your comment"></textarea> <br>


                            <div style=" margin-top:20px; display: flex; justify-content:space-between; column-gap:20px; align-items:center;">
                                <input required style=" border-radius:20px; padding: 9px; color:white; width:100%; background-color:#57aa2c; text-align:center; " type="file" name="image">
                                <button style=" border-radius:20px; width:100%; border: none; background-color: #57aa2c; color: white; padding: 11px;" type="submit">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>

                <div id="postModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span class="modal-close" onclick="closePostModal()">&times;</span>
                        <h2 id="postTitle"></h2>
                        <p id="postContent"></p>
                    </div>
                </div>




                <div>
                    <p style="margin-top: 20px; margin-bottom:2px;">{{ $post->createpost }}</p>
                </div>

                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                <img src="/assets/images/plantifeedpics/line-2.png" style="width: 100%; margin-top:15px;">





                <div style="margin-top: 10px; display:flex; justify-content:space-evenly;">

                    <button onclick="togglePostLike('{{ $post->id }}')" style="border: none; background-color: transparent; cursor: pointer;">
                        <img src="assets/images/plantifeedpics/like.png" alt="like" id="postLikeIcon{{ $post->id }}" style="padding: 10px;" onmouseover="this.style.backgroundColor='lightgray';this.style.borderRadius='25px';" onmouseout="this.style.backgroundColor='transparent'; this.style.borderRadius='25px';">
                        <span id="postLikeCount{{ $post->id }}">0</span>
                    </button>



                    <script>
                        // Initialize like status and counters for each post
                        var postLikeStatus = {};
                        var postLikeCounters = {};

                        function togglePostLike(postId) {
                            // Initialize like counter and status for the current post if not already set
                            if (!postLikeCounters[postId]) {
                                postLikeCounters[postId] = 0;
                                postLikeStatus[postId] = false;
                            }

                            // Increment or decrement like counter and toggle like status for the current post
                            if (!postLikeStatus[postId]) {
                                postLikeCounters[postId]++;
                                postLikeStatus[postId] = true;
                            } else {
                                postLikeCounters[postId]--;
                                postLikeStatus[postId] = false;
                            }

                            // Update like count display for the current post
                            document.getElementById('postLikeCount' + postId).innerText = postLikeCounters[postId];

                            // Add 'liked' class to trigger animation for the current post
                            document.getElementById('postLikeIcon' + postId).classList.add('liked');

                            // Remove 'liked' class after animation ends for the current post
                            setTimeout(function() {
                                document.getElementById('postLikeIcon' + postId).classList.remove('liked');
                            }, 500);

                            // You can include AJAX request here to send like status to the server
                        }
                    </script>


                    <button onclick="openPostModal('{{ $post->selection }}', '{{ $post->selectiontwo }}', '{{ $post->createpost }}')" style="display: flex; align-items:center; padding: 10px 20px; background-color: white; color: black; border: none; border-radius: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='lightgray';" onmouseout="this.style.backgroundColor='white';">
                        <img src="/assets/images/plantifeedpics/comment.png"" alt=" Comment" style="height: 20px; width: 20px; margin-right: 10px;">
                        Comment
                    </button>



                </div>

                <!-- <p>{{ $post->firstname }} {{ $post->lastname }}</p> -->
            </div>


            @endforeach
        </div>
        @elseif (isset($recommendations) && count($recommendations) > 0)
        {{ $recommendation }}
        @else
        <p>No recommendations found.</p>
        @endif

    </div>
</div>
<script>
    function toggleDropdown(element) {
        var dropdownContent = element.nextElementSibling;
        if (dropdownContent.style.display === "none") {
            dropdownContent.style.display = "block";
        } else {
            dropdownContent.style.display = "none";
        }
    }
</script>

<script>
    function toggleDropdownPost(element) {
        var dropdownContent = element.nextElementSibling;
        if (dropdownContent.style.display === "none") {
            dropdownContent.style.display = "block";
        } else {
            dropdownContent.style.display = "none";
        }
    }
</script>

<script>
    function openCommentModal(question, language) {
        var modal = document.getElementById('commentModal');
        var modalContent = modal.querySelector('.modal-content');
        var questionText = modalContent.querySelector('.question-text');
        var languageText = modalContent.querySelector('.language-text');

        questionText.textContent = question;
        languageText.textContent = language;

        modal.style.display = "block";
    }

    function closeCommentModal() {
        var modal = document.getElementById('commentModal');
        modal.style.display = "none";
    }
</script>


<script>
    function openPostModal(title, language, content) {
        var modal = document.getElementById('postModal');
        var titleElement = document.getElementById('postTitle');
        var contentElement = document.getElementById('postContent');

        titleElement.textContent = title + ' - ' + language;
        contentElement.textContent = content;

        modal.style.display = "block";
    }

    function closePostModal() {
        var modal = document.getElementById('postModal');
        modal.style.display = "none";
    }
</script>

<script>
    $(document).ready(function() {
        $('.delete-question').click(function() {
            var questionId = $(this).data('question-id');

            $.ajax({
                url: '/forum/delete-question/' + questionId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Refresh the page
                    setTimeout(function() {
                        window.location.reload();
                    }, 500); // Delay for 1 second before refreshing
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.delete-post').click(function() {
            var postId = $(this).data('post-id');

            $.ajax({
                url: '/forum/delete-post/' + postId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Refresh the page
                    setTimeout(function() {
                        window.location.reload();
                    }, 500); // Delay for 0.5 seconds before refreshing
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


@include('templates.footer')