@include('templates.header')


<div class="main-containerprofile" style="display:flex; flex-direction:column; align-items:center; row-gap:20px;">

    <div class="bg-backgroundprofile" style="align-items:flex-end; display:flex; justify-content:center;margin-top:70px; width: 940px; height: 400px; background-image: url('/assets/images/plantifeedpics/profile-bg.png'); background-size: cover; background-position: center; border: 1px solid #ddd;">
        <div class="img-rounded">
            <img src="/assets/images/plantifeedpics/rounded.png" alt="img" width="168px" height="168px">
        </div>
    </div>


    <div class="title-profile" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 15px; background-color:white;display:flex; justify-content:center; align-items:center; flex-direction: column; width:940px;height:200px;">
        <h3 style="font-weight: bold;">Central for Urban Agriculture and Innovation</h3>
        <p style="margin: 5px;">Welcome to the Official Page of Center for Urban Agriculture and</p>
        <p style="margin: 0;"> Innovation of Quezon City University</p>

        <button style="margin-top:10px; width:168px; padding:7px; color:white; border: none; border-radius: 5px; background-color:#374BFF; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#00008b '" onmouseout="this.style.backgroundColor='#374BFF'" onclick="toggleModal()">Edit Profile</button>


        <div id="myModal" style="margin-top: 35px; display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); align-items: center; justify-content: center; overflow: auto; z-index: 1000;">
            <div style=" background-color: #fff; padding: 20px; border-radius: 5px; position: relative;">
                <span onclick="toggleModal()" style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-size:30px;">&times;</span>
                <p style="margin-bottom:5px;text-align:center;font-weight: bold;font-size:18px;">Edit Profile</p>

                <div class="modal-bg" style="align-items:flex-end; display:flex; justify-content:center; width: 700px; height: 200px; background-image: url('/assets/images/plantifeedpics/profile-bg.png'); background-size: cover; background-position: center; border: 1px solid #ddd; margin-bottom:10px;">
                    <div style="position: relative; width: 128px; height: 128px; overflow: hidden; border-radius: 50%;">
                        <img src="/assets/images/plantifeedpics/rounded.png" alt="Outer Image" width="128px" height="128px">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <label for="fileInput" style="position: absolute; top: 80px; right: 10px; cursor: pointer;">
                                <img src="/assets/images/plantifeedpics/img-uploadfile.png" alt="Inner Image" style="width: 30px; height: 30px;">
                            </label>
                            <input type="file" id="fileInput" name="fileInput" style="display: none;">
                            <input type="submit" value="Upload">
                        </form>
                    </div>
                </div>

                <div class="modal-titleprofile" style="display:flex; flex-direction:column; ">
                    <h3 style="text-align:start; font-weight: bold;font-size:18px;">Central for Urban Agriculture and Innovation</h3>
                    <form action="/submit" method="POST" style=" width:100%;display: flex;flex-direction:column;">
                        <textarea id="textarea" placeholder="Welcome to the Official Page of Center for Urban Agriculture and Innovation of Quezon City University" name="textarea" rows="4" cols="50" style="padding:10px;outline:none;margin-bottom:8px;width:100%;background-color:#F4F1F1; border:none; resize: none;"></textarea>

                        <h3 style="text-align:start; font-weight: bold;font-size:18px;">Contact and Information</h3>

                        <div style="display: flex; justify-content:space-between; margin-bottom:5px;">

                            <input type="text" placeholder="673 Quirino Highway," id="line1" name="line1" class="underline-input" style="background-color:#F4F1F1;width: 300px; outline: none;border: none;border-bottom: 1px solid #F4F1F1;border-radius:5px;padding:10px;">
                            <input type="text" placeholder="example@gmail.com" id="line1" name="line1" class="underline-input" style="background-color:#F4F1F1;width: 300px; outline: none;border: none;border-bottom: 1px solid #F4F1F1;border-radius:5px;padding:10px;">
                        </div>

                        <div style="display: flex; justify-content:space-between; margin-bottom:5px;">

                            <input type="text" placeholder="www.example@gmail.com" id="line1" name="line1" class="underline-input" style="background-color:#F4F1F1;width: 300px; outline: none;border: none;border-bottom: 1px solid #F4F1F1;border-radius:5px;padding:10px;">
                            <input type="text" placeholder="www.facebook.com" id="line1" name="line1" class="underline-input" style="background-color:#F4F1F1;width: 300px; outline: none;border: none;border-bottom: 1px solid #F4F1F1;border-radius:5px;padding:10px;">
                        </div>

                        <div style="display: flex; justify-content:space-between; margin-bottom:5px;">

                            <input type="text" placeholder="www.instagram.com" id="line1" name="line1" class="underline-input" style="background-color:#F4F1F1;width: 300px; outline: none;border: none;border-bottom: 1px solid #F4F1F1;border-radius:5px;padding:10px;">
                            <input type="text" placeholder="www.twitter.com" id="line1" name="line1" class="underline-input" style="background-color:#F4F1F1;width: 300px; outline: none;border: none;border-bottom: 1px solid #F4F1F1;border-radius:5px;padding:10px;">
                        </div>

                        <div style="display: flex; justify-content:flex-end; margin-top:1px;">
                            <input type="submit" value="Save changes" style="border:none; width:150px; padding:10px; color:white; background-color:#4A9826; border-radius:7px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#006400'" onmouseout="this.style.backgroundColor='#4A9826'">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="second-container" style="display: grid; grid-template-columns:300px 600px; column-gap:40px;">


        <div class="about-section" style="height:300px;display:flex; flex-direction:column; background-color:white; padding:30px;border-radius:10px;box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
            <h3 style="font-weight:bold; font-size: 15px;">About</h3>

            <div style="display: flex; align-items:flex-start;">

                <img src="/assets/images/plantifeedpics/location.png" alt="Location Image" style="width: 20px; height: 20px; margin-right: 10px;">
                <p>673 Quirino Highway, San Bartolome Novaliches, Quezon City</p>
            </div>

            <div style="display: flex; align-items:flex-start;">
                <img src="/assets/images/plantifeedpics/email.png" alt="Location Image" style="width: 20px; height: 20px; margin-right: 10px;">
                <p>mailto@gmail.com</p>
            </div>
            <div style="display: flex; align-items:flex-start;">
                <img src="/assets/images/plantifeedpics/fb.png" alt="Location Image" style="width: 20px; height: 20px; margin-right: 10px;">
                <p>www.facebook.com</p>
            </div>

            <div style="display: flex; align-items:flex-start;">
                <img src="/assets/images/plantifeedpics/instagram.png" alt="Location Image" style="width: 20px; height: 20px; margin-right: 10px;">
                <p>www.instagram.com</p>
            </div>

            <div style="display: flex; align-items:flex-start;">
                <img src="/assets/images/plantifeedpics/twitter.png" alt="Location Image" style="width: 20px; height: 20px; margin-right: 10px;">
                <p>www.twitter.com</p>
            </div>


        </div>

        <div class="feed-section" style="display: flex; flex-direction:column; ">

            <div style="margin-bottom: 15px; display:flex; justify-content:center;">

                <div class="content" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);font-family: Arial, sans-serif; width: 100%; max-width: 600px;  border: none; border-radius: 8px; background-color: #fff; padding: 15px;">

                    <div class="d-flex align-items-flex-start justify-content-between">

                        <div class="flex-shrink-0">
                            <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                        </div>


                        <div class="flex-grow-1 ms-3">
                            <h5 class="fs-15">@Erica245 <small class="text-muted fs-13 fw-normal">- 10 min Ago</small></h5>
                            <p class="text-muted mt-2" style="color: black !important;">Hi everyone! This is my first time using this platform. I just wanna share my journey on growing my garden at home. </p>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <button style="background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'">👍 Like</button>
                                <button style="background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'" onclick="var commentBox = document.getElementById('commentBoxSection2'); commentBox.style.display = commentBox.style.display === 'none' ? 'block' : 'none';">💬 Comment</button>
                                <button style="background-color: transparent; border: none; color: black; margin-right: 50px; font-size: 14px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='black'">↪ Share</button>
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

                <div class="content" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);font-family: Arial, sans-serif; width: 100%; max-width: 600px;  border: none; border-radius: 8px; background-color: #fff; padding: 15px;">

                    <div class="d-flex align-items-flex-start justify-content-between">

                        <div class="flex-shrink-0">
                            <img src="/assets/images/plantifeedpics/rounded.png" alt="Post Image" class="avatar-sm rounded" style="width: 40px; height: 40px;">
                        </div>

                        <!-- Original Content -->
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fs-15">Kenneth Salvador <small class="text-muted fs-13 fw-normal">- 10 min Ago</small></h5>

                            <img src="/assets/images/plantifeedpics/wide-pic.png" alt="Post Image" class="avatar-sm rounded" style="width: 500px; height: 250px;">
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

                <div class="content" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);font-family: Arial, sans-serif; width: 100%; max-width: 600px;  border: none; border-radius: 8px; background-color: #fff; padding: 15px;">

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
        </div>

        <script>
            function toggleModal() {
                var modal = document.getElementById('myModal');
                modal.style.display = modal.style.display === 'none' ? 'flex' : 'none';
            }
        </script>

        @include('templates.footer')