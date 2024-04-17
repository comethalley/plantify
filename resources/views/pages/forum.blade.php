@include('templates.header')

<head>
    <link rel="shortcut icon" href="{{ asset('assets/images/plantifeedpics/bg-velzon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>

    <div class="main-content">
        <div class="page-content" style="padding-bottom: 20px;">
            <form id="searchForm" method="GET" action="{{ route('pages.search_results') }}">
                <div class="mb-0" style="display: flex; justify-content: center;">
                    <input required type="text" id="searchInput" name="searchTerm" class="form-control form-control-lg bg-white border-white" placeholder="Search here.." style="font-size: 13px; width: 600px; border-radius:20px;  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1); ">
                </div>
            </form>

            <div class="search-container" style="display: flex; justify-content:center;">
                <div id="searchResults" style="width:600px; display: flex; justify-content:center; flex-direction:column; margin-top:5px;"></div>

            </div>


        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');
            const searchResults = document.getElementById('searchResults');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.trim();
                if (searchTerm.length === 0) {
                    searchResults.innerHTML = ''; // Clear search results if input is empty
                    return;
                }
                fetch(`/search?searchTerm=${encodeURIComponent(searchTerm)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.length === 0) {
                            searchResults.innerHTML = '<div style="margin-top:7px; font-weight:bold; font-size:14px;  text-align:center;" class="notFound">No results found.</div>';
                        } else {
                            let html = '';
                            data.forEach(item => {
                                html += `<div style="border-radius:13px;  max-width: 600px; margin:0; padding:10px; font-family: Poppins, sans-serif; font-size: 13px; cursor: pointer;" class="searchResultItem" onmouseover="this.style.backgroundColor='lightgray'" onmouseout="this.style.backgroundColor=''">${item}</div>`;
                            });
                            searchResults.innerHTML = html;
                            // Add event listener to clickable search results
                            document.querySelectorAll('.searchResultItem').forEach(item => {
                                item.addEventListener('click', function() {
                                    const searchTerm = item.innerText.trim();
                                    window.location.href = "{{ route('pages.search_results') }}" + "?searchTerm=" + encodeURIComponent(searchTerm);
                                });
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                    });
            });

            // Prevent default form submission
            searchForm.addEventListener('submit', function(event) {
                event.preventDefault();
            });
        });
    </script>


    <div style="display:flex;justify-content:center;">
        <div class="main-content">
            <div class=" page-content" style="padding:0;">
                <div class="row" style="width: 600px; margin-left:1px; border-radius:20px;">
                    <div class=" card" style="border-radius:13px;  margin-bottom:20px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1); ">
                        <div class="card-body">
                            <div class="mt-0 " style="display: flex;">
                                <div style="display: inline-flex; align-items: center; ">
                                    <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 40px; height: 40px; margin-right: 8px;">
                                    <button type="button" class="btn btn-primary" style="width: 507px; border:0;border-radius:20px; text-align:left;background-color:#E6E6E6; color:black;" data-bs-toggle="modal" data-bs-target="#myModal">Ask and share your story!</button>
                                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width: 600px; height:500px;">
                                                <div class="modal-header">

                                                    <h5 class="modal-title" id="myModalLabel">Add Question</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>

                                                </div>

                                                <img src="/assets/images/plantifeedpics/line.png" alt="line-img" style="width:570px; margin-left:15px; margin-top:10px;">

                                                <div class="modal-body">
                                                    <div style="background-color: #E1E1E1; padding:20px; border-radius:10px;">
                                                        <h5 class="fs-15" style="margin-bottom: 20px;">
                                                            Tips on getting good answers quickly
                                                        </h5>
                                                        <p class="text-muted">• Make sure your question has not been asked already </p>
                                                        <p class="text-muted">• Keep your question short and to the point</p>
                                                        <p class="text-muted">• Double-check grammar and spelling</p>
                                                    </div>



                                                    <div style="margin-top:20px;">
                                                        <form action="{{ route('forum.store') }}" method="POST">
                                                            <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 40px; height: 40px; margin-left: 5px;">
                                                            @csrf
                                                            <div class="dropdown" style="position: relative; display: inline-block; width:100px; border-radius:30px;">
                                                                <select name="language" id="language" style="border-radius:30px;padding:4px; outline: none;">
                                                                    <option value="Public">Public</option>
                                                                    <option value="Limited">Limited</option>
                                                                </select>
                                                            </div>
                                                            <!-- <label for="askquestions">Questions:</label> -->
                                                            <input style="margin-top:30px; width:100%; display: block; outline: none;  border-right: none; border-top: none;border-left: none; border-bottom: 1px solid black; " required type="text" name="askquestions" id="askquestions" placeholder="Start your questions with 'What', 'Why', 'How', etc." required>

                                                            <div style="display: flex; justify-content:flex-end; margin-top:70px;">
                                                                <button class="btn btn-light" style="margin-right:10px; border-radius:10px; border:none;" type="button" c data-bs-dismiss="modal">Cancel</button>
                                                                <button class="btn btn-light" style="border-radius:10px; border:none;" type="submit">Add Question</button>
                                                            </div>
                                                        </form>
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

                                                        @if (Session::has('validationmessage'))
                                                        <script>
                                                            swal("Warning", "{{ Session::get('validationmessage') }}", 'warning', {
                                                                button: true,
                                                                button: "OK",
                                                                dangerMode: true,
                                                            });
                                                        </script>
                                                        @endif


                                                        <!-- @if (Session::has('validationmessage'))
                                                        <script>
                                                            swal("Warning", "{{ Session::get('validationmessage') }}", 'warning', {
                                                                button: true,
                                                                button: "OK",
                                                                dangerMode: true,
                                                            });
                                                        </script>
                                                        @endif -->



                                                    </div>
                                                </div>


                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                </div>
                            </div>



                            <div class="mt-2" style="display: flex; justify-content:space-evenly;">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="width: 150px; border:none;">
                                    <img src="/assets/images/plantifeedpics/asked.png" alt="ask" style="width:20px; height:20px;">
                                    Ask
                                </button>

                                <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="width: 600px; height:500px;">
                                            <div class="modal-header" style="text-align: center;">
                                                <h5 style="text-align: center;" class="modal-title" id="myModalLabel">Add Question</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                            </div>
                                            <div class="modal-body">
                                                <div style="display: flex; align-items: center;">
                                                    <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 40px; height: 40px; margin-right: 8px;">


                                                </div>



                                                <div class="hstack mt-3">
                                                    <input class="form-control me-auto form-control mr-8" type="text" name="ask_text" placeholder="Start your questions with “What” , “Why” , “How” etc." value="" style="width: 413px;" fdprocessedid="cawh3q">

                                                </div>
                                                <!--  -->
                                            </div>



                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary ">Add Question</button>
                                            </div>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->






                                <div class="live-preview">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid" fdprocessedid="54dc1a" style="width: 150px; border:none;">
                                        <img src="/assets/images/plantifeedpics/posting.png"" alt=" posting" style="width: 20px; height: 20px; margin-right: 5px;"> Post
                                    </button>

                                    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width: 600px; height:500px;">
                                                <div class="modal-header" style="margin-left:230px; ">
                                                    <h5 class="modal-title" id="exampleModalgridLabel">Create Post</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>


                                                <img src="/assets/images/plantifeedpics/line.png" alt="line-img" style="width:570px; margin-left:15px; margin-top:10px;">


                                                <div class="modal-body">

                                                    <div>
                                                        <div>
                                                            <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 40px; height: 40px; margin-right: 8px;">
                                                            <b>Center for Urban Agriculture and Innovation</b>
                                                        </div>



                                                        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf

                                                            <select name="selection" id="selection" style=" width:78px; margin-left: 52px; border:solid 1px; border-radius: 20px; padding:4px">
                                                                <option value="Public">Public</option>
                                                                <option value="Limited">Limited</option>
                                                            </select>
                                                            <select name="selectiontwo" id="selectiontwo" style=" width:78px; margin-left: 10px; border:solid 1px; border-radius: 20px; padding:4px">
                                                                <option value="Farmer">Farmer</option>
                                                                <option value="Admin">Admin</option>
                                                            </select>


                                                            <input required type="file" name="image" id="image" style=" width:90px;margin-left: 10px;">


                                                            <textarea name="createpost" id="createpost" placeholder="Say something..." required style="display: block; margin-top:20px; width:100%; border:none; outline:none; resize:none;" rows="12" cols="50"></textarea>

                                                            <div style="display: flex; justify-content:flex-end; margin-top:40px;">
                                                                <button style="margin-right:10px;" type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                <button class="btn btn-light" style="border-radius:10px; border:none;" type="submit">Add Question</button>
                                                            </div>
                                                        </form>


                                                    </div>

                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="grid-card" style=" display: flex; flex-direction:column; width: 600px; row-gap:20px;">

                    <div>
                        @foreach ($questions as $question)
                        <div class="dropdown" style=" box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);   display: grid; background-color:white; margin-bottom:20px; padding:30px; border-radius:13px; ">

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


                                    @foreach($comments as $comment)

                                    <div>
                                        <p>{{ $comment->content }}</p>
                                        @if($comment->image)
                                        <img src="{{ asset('images/' . $comment->image) }}" alt="Comment Image">
                                        @endif
                                    </div>

                                    <button>reply</button>
                                    @endforeach




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

@include('templates.footer')