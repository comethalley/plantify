@include('templates.header')

<head>
    <link rel="shortcut icon" href="{{ asset('assets/images/plantifeedpics/feedcover.png') }}" />

</head>

<body>

    <div class="main-content">
        <div class="page-content" style="padding-bottom: 10px;">
            <div class="mb-3" style="display: flex;  justify-content: center;">
                <input type="text" class="form-control form-control-lg bg-white border-white" placeholder="Search here.." style="font-size: 13px; width: 485px;">
                <button type="submit" style="font-size: 13px; margin-left: 10px;" class="btn btn-primary btn-lg waves-effect waves-light">
                    <i class="mdi mdi-magnify me-1"></i> Search
                </button>
            </div>
        </div>
    </div>




    <div style="display: flex; justify-content:center;">
        <div class="main-content">
            <div class=" page-content" style="padding:0;">
                <div class="row" style="width: 600px; margin-left:1px; border-radius:20px;">
                    <div class=" card" style="padding:0;">
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

                                                <div class="modal-body">
                                                    <h5 class="fs-15">
                                                        Tips on getting good answers quickly
                                                    </h5>
                                                    <p class="text-muted">• Make sure your question has not been asked already </p>
                                                    <p class="text-muted">• Keep your question short and to the point</p>
                                                    <p class="text-muted">• Double-check grammar and spelling</p>

                                                    <div style="display: flex; align-items: center;">
                                                        <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 40px; height: 40px; margin-right: 8px;">

                                                        <div class="dropdown" style="position: relative; display: inline-block; width:100px; border-radius:30px;">
                                                            <div class="dropdown-btn" style="background-color: #405189; color: white; padding: 5px; cursor: pointer; border-radius:30px; text-align: center;" onclick="var dropdownMenu = this.nextElementSibling; dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';">🌎︎ Public</div>
                                                            <div class="dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background-color: #fff; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                                                                <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Public</div>
                                                                <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Limited</div>
                                                                <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Option 3</div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="hstack mt-3"><input class="form-control me-auto form-control " type="text" name="" placeholder="Start your questions with “What” , “Why” , “How” etc." value="" style="width: 100%; border-width: 0px 0px 1px 0px " fdprocessedid="cawh3q">

                                                    </div>
                                                </div>



                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary ">Add Question</button>
                                                </div>

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                </div>
                            </div>



                            <div class="mt-2" style="display: flex; justify-content:center;">

                                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">❔ Ask</button>
                                <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="width: 600px; height:500px;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Add Question</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="fs-15">
                                                    Tips on getting good answers quickly
                                                </h5>
                                                <p class="text-muted">• Make sure your question has not been asked already </p>
                                                <p class="text-muted">• Keep your question short and to the point</p>
                                                <p class="text-muted">• Double-check grammar and spelling</p>

                                                <div style="display: flex; align-items: center;">
                                                    <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 40px; height: 40px; margin-right: 8px;">

                                                    <div class="dropdown" style="position: relative; display: inline-block; width:100px; border-radius:30px;">
                                                        <div class="dropdown-btn" style="background-color: #405189; color: white; padding: 7px; cursor: pointer; border-radius:30px; text-align: center;" onclick="var dropdownMenu = this.nextElementSibling; dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';">🌎︎ Public</div>
                                                        <div class="dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background-color: #fff; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                                                            <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Public</div>
                                                            <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Limited</div>
                                                            <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Option 3</div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="hstack mt-3"><input class="form-control me-auto form-control mr-8" type="text" name="" placeholder="Start your questions with “What” , “Why” , “How” etc." value="" style="width: 413px;" fdprocessedid="cawh3q">

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





                                <button type="button" class="btn btn-primary mx-5" data-bs-target="#exampleModalgrid" fdprocessedid="54dc1a">
                                    📝 Answer
                                </button>


                                <div class="live-preview">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid" fdprocessedid="54dc1a">
                                        ✏️ Post
                                    </button>
                                    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width: 600px; height:500px;">
                                                <div class="modal-header" style="margin-left:225px;">
                                                    <h5 class="modal-title" id="exampleModalgridLabel">Create Post</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div>
                                                        <div>
                                                            <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 40px; height: 40px; margin-right: 8px;">
                                                            <b>Center for Urban Agriculture and Innovation</b>
                                                        </div>

                                                        <div class="dropdown" style="position: relative; display: inline-block; width:100px; border-radius:30px; margin-left:50px;">
                                                            <div class="dropdown-btn" style="background-color: #405189; color: white; padding: 7px; cursor: pointer; border-radius:30px; text-align: center;" onclick="var dropdownMenu = this.nextElementSibling; dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';">🌎︎ Public</div>
                                                            <div class="dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background-color: #fff; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                                                                <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Public</div>
                                                                <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Limited</div>
                                                                <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Option 3</div>
                                                            </div>
                                                        </div>

                                                        <div class="dropdown" style="position: relative; display: inline-block; width:100px; border-radius:30px; margin-left:5px;">
                                                            <div class="dropdown-btn" style="background-color: #405189; color: white; padding: 7px; cursor: pointer; border-radius:30px; text-align: center;" onclick="var dropdownMenu = this.nextElementSibling; dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';">Farmer</div>
                                                            <div class="dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background-color: #fff; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                                                                <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Option1</div>
                                                                <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Limited</div>
                                                                <div class="dropdown-item" style="padding: 10px; display: block; color: #333; text-decoration: none;">Option 3</div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="hstack mt-3">
                                                        <textarea class="form-control me-auto form-control mr-8" name="" placeholder="Say something..." style="width:100%; height: 150px; resize: none; border: none;"></textarea>
                                                    </div>

                                                    <!--  -->
                                                </div>



                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary ">Add Questions</button>
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

            <div style="margin-bottom: 15px; display:flex; justify-content:center;">

                <div class="content" style="font-family: Arial, sans-serif; width: 100%; max-width: 600px;  border: none; border-radius: 8px; background-color: #fff; padding: 15px;">

                    <div class="d-flex align-items-flex-start justify-content-between">

                        <div class="flex-shrink-0">
                            <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                        </div>


                        <div class="flex-grow-1 ms-3">
                            <h5 class="fs-15">@Erica245 <small class="text-muted fs-13 fw-normal">- 10 min Ago</small></h5>
                            <p class="text-muted fs-12" style="color: grey; margin-bottom: 0;">Farmer</p>
                            <p class="text-muted mt-2" style="color: black !important;">Hi everyone! This is my first time using this platform. I just wanna share my journey on growing my garden at home. </p>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <button style="background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'" onclick="toggleCommentBox('commentBoxSection2')">👍 Like</button>
                                <button style="background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'" onclick="toggleCommentBox('commentBoxSection2')">💬 Comment</button>
                                <button style="background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'" onclick="toggleCommentBox('commentBoxSection2')">↪ Share</button>
                            </div>


                            <div id="commentBoxSection2" style="display: none; margin-top:20px;">
                                <!-- Existing Comments -->
                                <div class="comment" style="margin-bottom: 10px;">
                                    <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                                    <strong style="margin-left:6px;">Erica:</strong> Feel free to ask any questions about gardening.
                                </div>


                                <form action="/submit_comment" method="post">
                                    <div style="position: relative; width: 100%;">
                                        <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px; position: absolute; left: 1px; top: 50%; transform: translateY(-50%);">
                                        <textarea id="newCommentSection2" name="comment" style="resize:none; border:none; outline: none; background-color:#E6E6E6; width: calc(100% - 60px); height: 50px; border-radius: 10px; padding: 10px; box-sizing: border-box; margin-left: 50px;" placeholder="Write a comment..."></textarea>
                                        <button type="button" style="background-color: transparent; border: none; color: black; font-size: 14px; cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);" onclick="addComment('newCommentSection2', 'commentBoxSection2')">📤</button>
                                    </div>
                                </form>


                                <script>
                                    function toggleCommentBox(commentBoxId) {
                                        var commentBox = document.getElementById(commentBoxId);
                                        commentBox.style.display = (commentBox.style.display === 'none' || commentBox.style.display === '') ? 'block' : 'none';
                                    }

                                    function addComment(newCommentId, commentBoxId) {
                                        var newCommentInput = document.getElementById(newCommentId);
                                        var newComment = newCommentInput.value;

                                        if (newComment.trim() !== '') {
                                            var commentBox = document.getElementById(commentBoxId);
                                            var commentDiv = document.createElement('div');
                                            commentDiv.className = 'comment';
                                            commentDiv.innerHTML = '<img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;"><strong style="margin-left:6px;">@You:</strong> ' + newComment;
                                            commentBox.appendChild(commentDiv);
                                            newCommentInput.value = '';
                                        }

                                        commentBox.style.display = 'none';
                                    }
                                </script>
                            </div>
                        </div>


                        <div class="flex-shrink-0">
                            <div class="dropdown">
                                <a href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill fs-14"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                    <li><a class="dropdown-item" href="#">📝 Edit Post</a></li>
                                    <li><a class="dropdown-item" href="#">🗑️ Delete Post</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div style="margin-bottom: 15px; display:flex; justify-content:center;">

                <div class="content" style="font-family: Arial, sans-serif; width: 100%; max-width: 600px;  border: none; border-radius: 8px; background-color: #fff; padding: 15px;">

                    <div class="d-flex align-items-flex-start justify-content-between">

                        <div class="flex-shrink-0">
                            <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                        </div>

                        <!-- Original Content -->
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fs-15">Kenneth Salvador <small class="text-muted fs-13 fw-normal">- 10 min Ago</small></h5>
                            <p class="text-muted fs-12" style="color: grey; margin-bottom: 0;">Farmer</p>
                            <button style="background-color:#4A9826; color:white;border-radius:50px; border:none;">Discussion</button> <b style="font-size: 15px;">What is the best soil for cactus?</b>
                            <p class="text-muted mt-2" style="color: black !important;">Low-nutrient potting compost, such as a peat-free seed compost. A loam-based John Innes no 1 type is ideal. Coarse sand or horticultural grit. Both are available to buy – do not use sand or grit dug from the garden as the texture is unlikely to be suitable and it won't be sterilized. </p>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <button style="background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'">👍 Like</button>
                                <button style="background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'" onclick="var commentBox = document.getElementById('commentBoxSection1'); commentBox.style.display = commentBox.style.display === 'none' ? 'block' : 'none';">💬 Comment</button>
                                <button style="background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'">↪ Share</button>
                            </div>

                            <!-- Comment Box -->
                            <div id="commentBoxSection1" style="display: none; margin-top:20px;">
                                <!-- Existing Comments -->
                                <div class="comment" style="margin-bottom: 10px;">
                                    <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                                    <strong style="margin-left:6px;">Kenneth:</strong> This is an example comment.
                                </div>
                                <div class="comment" style="margin-bottom: 10px;">
                                    <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                                    <strong style="margin-left:6px;">Smith:</strong> Another comment to showcase the layout.
                                </div>

                                <!-- Comment Form -->
                                <form action="/submit_comment" method="post">
                                    <div style="position: relative; width: 100%;">
                                        <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px; position: absolute; left: 1px; top: 50%; transform: translateY(-50%);">
                                        <textarea id="newCommentSection1" name="comment" style="resize:none; border:none; outline: none; background-color:#E6E6E6; width: calc(100% - 60px); height: 50px; border-radius: 10px; padding: 10px; box-sizing: border-box; margin-left: 50px;" placeholder="Write a comment..."></textarea>
                                        <button type="button" style="background-color: transparent; border: none; color: black; font-size: 14px; cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);" onclick="var newCommentInput = document.getElementById('newCommentSection1'); var newComment = newCommentInput.value; if (newComment.trim() !== '') { var commentBox = document.getElementById('commentBoxSection1'); var commentDiv = document.createElement('div'); commentDiv.className = 'comment'; commentDiv.innerHTML = '<strong>@You:</strong> ' + newComment; commentBox.appendChild(commentDiv); newCommentInput.value = ''; } var commentBox = document.getElementById('commentBoxSection1'); commentBox.style.display = 'none';">📤</button>
                                    </div>
                                </form>
                            </div>
                        </div>




                        <div class="flex-shrink-0">
                            <div class="dropdown">
                                <a href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill fs-14"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                    <li><a class="dropdown-item" href="#">📝 Edit Post</a></li>
                                    <li><a class="dropdown-item" href="#">🗑️ Delete Post</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div style="margin-bottom: 150px; display:flex; justify-content:center;">

                <div class="content" style="font-family: Arial, sans-serif; width: 100%; max-width: 600px;  border: none; border-radius: 8px; background-color: #fff; padding: 15px;">

                    <div class="d-flex align-items-flex-start justify-content-between">

                        <div class="flex-shrink-0">
                            <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fs-15">@Erica245 <small class="text-muted fs-13 fw-normal">- 10 min Ago</small></h5>
                            <img src="/assets/images/plantifeedpics/wide-pic.png" alt="Post Image" class="avatar-sm rounded" style="width: 500px; height: 250px;">
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <button id="likeBtn" style=" margin-right: 50px;background-color: transparent; border: none; color: black; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'" onclick="console.log('Liked')">👍 Like</button>
                                <button id="commentBtn" style=" background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'" onclick="var commentBox = document.getElementById('commentBox'); commentBox.style.display = commentBox.style.display === 'none' ? 'block' : 'none';">💬 Comment</button>
                                <button style="background-color: transparent; border: none; color: black; font-size: 14px; margin-right: 54px" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'">↪ Share</button>
                            </div>
                            <!-- Comment Box -->
                            <div id="commentBox" style="display: none; margin-top:20px;">
                                <!-- Existing Comments -->
                                <div class="comment" style="margin-bottom: 10px;">
                                    <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                                    <strong style="margin-left:6px;">Kenneth:</strong> This is an example comment.
                                </div>
                                <div class="comment" style="margin-bottom: 10px;">
                                    <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                                    <strong style="margin-left:6px;">Smith:</strong> Another comment to showcase the layout.
                                </div>

                                <!-- Comment po-->
                                <form action="/submit_comment" method="post">
                                    <div style="position: relative; width: 100%;">
                                        <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px; position: absolute; left: 1px; top: 50%; transform: translateY(-50%);">
                                        <textarea id="newComment" name="comment" style="resize:none; border:none; outline: none; background-color:#E6E6E6; width: calc(100% - 60px); height: 50px; border-radius: 10px; padding: 10px; box-sizing: border-box; margin-left: 50px;" placeholder="Write a comment..."></textarea>
                                        <button type="button" style="background-color: transparent; border: none; color: black; font-size: 14px; cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);" onclick="var newCommentInput = document.getElementById('newComment'); var newComment = newCommentInput.value; if (newComment.trim() !== '') { var commentBox = document.getElementById('commentBox'); var commentDiv = document.createElement('div'); commentDiv.className = 'comment'; commentDiv.innerHTML = '<strong>@You:</strong> ' + newComment; commentBox.insertBefore(commentDiv, newCommentInput); newCommentInput.value = ''; } var commentBox = document.getElementById('commentBox'); commentBox.style.display = 'none';">📤</button>
                                    </div>
                                </form>

                            </div>
                        </div>



                        <div class="flex-shrink-0">
                            <div class="dropdown">
                                <a href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill fs-14"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                    <li><a class="dropdown-item" href="#">📝 Edit Post</a></li>
                                    <li><a class="dropdown-item" href="#">🗑️ Delete Post</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>










</body>

@include('templates.footer')