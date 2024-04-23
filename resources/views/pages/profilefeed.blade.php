<!DOCTYPE html>

<html>

@include('templates.header')

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.7.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>

<body>

    @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="sweetAlert">
        <script>
            // I-wrap ang code sa isang function para madaling tawagin
            function showSweetAlert() {
                swal({
                    title: "Success",
                    text: "{{ Session::get('message') }}",
                    icon: "success",
                    button: "OK"
                });
            }

            // I-check kung ang page ay nasa cache o hindi
            if (performance.navigation.type !== 2) {
                // Ang performance.navigation.type === 2 ay nangangahulugang ang page ay nahiram mula sa cache
                showSweetAlert();
            }
        </script>
    </div>
    @endif


    <div class="main-content" style="margin-top: 40px;">

        <div class="profile-flex" style="display: flex; flex-direction:column; align-items:center; row-gap:10px;">

            @if($userPhotos)

            @if($userPhotos->cover_photo)
            <img style="background-color:#FFFFFF; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);  object-fit: cover;  border-radius: 0 0 10px 10px; width: 1080px; height:400px;" src="{{ asset('storage/cover_photos/' . $userPhotos->cover_photo) }}" alt="Cover Photo">
            @else
            <img src="{{ asset('assets/images/plantifeedpics/comment.png') }}" alt="Default Cover Photo">
            @endif
            <div style="display:flex; align-items:center; flex-direction:column; width:1080px; padding:20px; background-color:#FFFFFF;   box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 10px; ">
                @if($userPhotos->profile_photo)

                <img style="width: 160px; height:160px;" src="{{ asset('storage/profile_photos/' . $userPhotos->profile_photo) }}" alt="Profile Photo">
                @else
                <img src="{{ asset('assets/images/plantifeedpics/comment.png') }}" alt="Default Profile Photo">
                @endif


                @else

                <img style="border-radius: 0 0 10px 10px; width: 1080px; height:400px; background-color: whitesmoke; ">
                <div style="display:flex; align-items:center; flex-direction:column; width:1080px; padding:20px; background-color:#FFFFFF;   box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 10px; ">
                    <img style="width: 160px; height: 160px; border-radius: 50%; border: 1px solid; object-fit: cover;" src="{{ asset('assets/images/plantifeedpics/profile-icon.png') }}" alt="Default Profile Photo">

                    @endif

                    <h2 style="font-size: 25px; font-weight:bold;">Central for Urban Agriculture and Innovation</h2>

                    @if(empty($userBio))
                    <p>No bio yet</p>
                    @else
                    <p style="text-align:center;">{{ $userBio }}</p>
                    @endif

                    <button style="width: 150px; font-weight:bold;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
                        Edit Profile
                    </button>
                </div>

                <div style="display: grid; grid-template-columns:530px 530px; column-gap:20px;">
                    <div style="padding:40px; background-color:#FFFFFF; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 10px;">
                        <!-- Personal Information Section -->

                        @if($userPhotos)

                        <div style="display: flex; flex-direction:column; row-gap:20px; ">

                            <p style="font-weight: bold; font-size:18px;">About</p>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/location.png') }}" alt="address">
                                {{ $userAddress ? $userAddress : 'None' }}
                            </span>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/email.png') }}" alt="email">
                                {{ $userEmail ? $userEmail : 'None' }}
                            </span>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/facebook.png') }}" alt="facebook">
                                {{ $userFacebook ? $userFacebook : 'None' }}
                            </span>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/instagram.png') }}" alt="instagram">
                                {{ $userInstagram ? $userInstagram : 'None' }}
                            </span>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/twitter.png') }}" alt="twitter">
                                {{ $userTwitter ? $userTwitter : 'None' }}
                            </span>
                        </div>


                        <!-- Social Media Links -->

                        @else


                        <div style="display: flex; flex-direction:column; row-gap:20px; ">

                            <p style="font-weight: bold; font-size:18px;">About</p>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/location.png') }}" alt="address"> None
                            </span>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/email.png') }}" alt="email"> None
                            </span>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/facebook.png') }}" alt="facebook"> None
                            </span>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/instagram.png') }}" alt="instagram"> None
                            </span>
                            <span>
                                <img style="height: 28px; width:28px;" src="{{ asset('assets/images/plantifeedpics/twitter.png') }}" alt="twitter"> None
                            </span>
                        </div>

                        @endif
                    </div>

                    <div>
                        @if($posts->isEmpty() && $questions->isEmpty())
                        <div style="padding:40px; background-color:#FFFFFF; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 10px;">
                            <p style="color: grey;">No posts and questions available.</p>
                        </div>
                        @else
                        <div class="grid-card" style=" display: flex; flex-direction:column; width: 100%; row-gap:20px;">
                            <div>

                                @foreach ($questions as $question)
                                <div class="dropdown" style=" box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);   display: grid; background-color:white; margin-bottom:20px; padding:30px; border-radius:13px; ">

                                    <div style="display: flex; justify-content:space-between;">
                                        <p style="margin: 0;">
                                            <strong>{{ $user->firstname }} {{ $user->lastname }}</strong> <span style="color: grey;"></span>
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
                                @endif
                            </div>
                        </div>


                        <div class="grid-card" style=" display: flex; flex-direction:column; width: 100%; row-gap:20px;">
                            <div>


                                @foreach($posts as $post)
                                <div style="margin-bottom:20px;  display:grid; background-color:white; padding:30px; border-radius:13px; position: relative; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);">

                                    <div style="display: flex; justify-content:space-between;">

                                        <p> <strong>{{ $user->firstname }} {{ $user->lastname }}</strong>
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
                        </div>
                    </div>


                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: 600px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Profile Photo Form -->
                            <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if($userPhotos)

                                @if($userPhotos->cover_photo)
                                <img style="object-fit:cover; background-color:#FFFFFF; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);  width: 100%; height:300px; " src="{{ asset('storage/cover_photos/' . $userPhotos->cover_photo) }}" alt="Cover Photo">
                                @else
                                <img src="{{ asset('assets/images/plantifeedpics/comment.png') }}" alt="Default Cover Photo">
                                @endif

                                @if($userPhotos->profile_photo)
                                <div style="display: flex; justify-content: center;">
                                    <img style="width: 120px; height:120px;" src="{{ asset('storage/profile_photos/' . $userPhotos->profile_photo) }}" alt="Profile Photo">
                                    @else

                                    <img src="{{ asset('assets/images/plantifeedpics/comment.png') }}" alt="Default Profile Photo">
                                    @endif
                                </div>


                                @else
                                <img style="width: 100%; height:300px; background-color: whitesmoke; border-radius:10px;">
                                <div style="display: flex; justify-content: center;">
                                    <img style="width: 120px; height: 120px; border-radius: 50%; border: 1px solid; object-fit: cover;" src="{{ asset('assets/images/plantifeedpics/profile-icon.png') }}" alt="Default Profile Photo">
                                </div>
                                @endif

                                <h3 style=" margin-top:10px; text-align:center; font-size: 22px;">Central for Urban Agriculture and Innovation</h3>

                                <div class="form-group">
                                    <label for="profile_photo">Profile Photo:</label>
                                    <input required type="file" class="form-control-file" id="profile_photo" name="profile_photo">
                                </div>

                                <div class="form-group">
                                    <label for="cover_photo">Cover Photo:</label>
                                    <input required type="file" class="form-control-file" id="cover_photo" name="cover_photo">
                                </div>
                                <div class="form-group">
                                    <label for="bio">Bio:</label>
                                    <textarea required placeholder="Welcome to the Official Page of Center for Urban Agriculture and Innovation of Quezon City University" style="resize: none;" class="form-control" id="bio" name="bio"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input required placeholder="673 Quirino Highway, San Bartolome Novaliches, Quezon City" type="text" class="form-control" id="address" name="address">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input required placeholder="example@gmail.com" type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook:</label>
                                    <input required placeholder="www.facebook.com" type="text" class="form-control" id="facebook" name="facebook">
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Instagram:</label>
                                    <input required placeholder="www.instagram.com" type="text" class="form-control" id="instagram"" name=" instagram"">
                                </div>

                                <div class="form-group">
                                    <label for="twitter">Twitter:</label>
                                    <input required placeholder="www.twitter.com" type="text" class="form-control" id="twitter" name="twitter">
                                </div>
                                <div style="display: flex;  justify-content:flex-end;">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



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




</body>

</html>



@include('templates.footer')