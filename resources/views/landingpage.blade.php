<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>PlantiCUAI</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/plantifeedpics/rounded.png" class="img-fluid" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/app.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <style>
        body,
        html {
            height: 100%;
            background:;
        }
        .auth-one-bg-position {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            
        }
        .card {
            margin: 1em auto;
        }
        #translateButton {
        position: relative; /* Add position */
        z-index: 9999; /* Add z-index */
        background-color: #4CAF50; /* Green background */
        border: none;
        color: white;
        padding: 6px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 4px 4px;
        cursor: pointer;
        border-radius: 5px;
    }

        /* Custom styles for the arrow icon */
        #translateButton i {
            margin-left: 5px;
        }

        /* Custom styles for the Google Translate dropdown */
        .goog-te-menu-value span {
            color: white; /* Text color */
        }

        .goog-te-menu-value:hover {
            background-color: #5cb85c; /* Hover color */
        }
        /* .skiptranslate {
            display: none !important;
        } */
          
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar" style="background-color:#066903; padding: 4px;">
        
    <div class="container">
        <a class="navbar-brand text-white" href="/">
            <img src="assets/images/plantifeedpics/cuai.png" class="mr-2" alt="CUAI" height="45">
        </a>

  

            <button class="navbar-toggler py-0 fs-16 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">

                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="javascript:void(0);" onclick="scrollToHome()">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="/about-us">About Us</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="javascript:void(0);" onclick="scrollToFAQ()">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="javascript:void(0);" onclick="scrollToContact()">Contact Us</a>
                    </li>
                
                </ul>

                <div>
                    
                    <a class="btn btn-link text-white fw-bold" href="/login">Login</a>
                    <a class="btn btn-link text-white fw-semibold" style="background-color:#FFAB2D;" href="/signup">Sign Up</a>
                </div>
                    <div >
                        <button id="translateButton">
                    </button>
                    </div>
                
            </div>
        </div>
    </nav>

    <!-- end navbar -->
    <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>

  
    <section id="home-section" class="section nft-hero" id="hero" style="background-image: url('assets/images/plantifeedpics/bg2.png'); background-size: cover; background-position: center center;">
    <div class="container">
    <div class="row justify-content-between align-items-center ">
                        <div class="col-lg-6">
                            <div>
                            <h1 class="display-10 fw-bold mb-4 lh-base text-white" style="font-size: 35px; font-weight: 800;">Rooted in th city,<br>flourishing in the community!</h1>
                            <p class="lead text-white lh-base">Join the urban green revolution, easily grow crops in the city, and connect with a passionate community online. Start making a difference today!</p>
                            </div>
                            
                            <div class="mt-4 d-flex">
                                <a href="/login" class="btn btn-primary" style="background-color: #FFAB2D; border:none; width: 250px;">Get Started<i class="ri-arrow-right-line align-middle ms-1"></i></a>
                            </div>
                        </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end hero section -->
<br>

                    
  <!-- <div class="container text-center"> -->
    <div class="container card">
        <h1 class="display-10 fw-semibold mb-4 lh-base text-black text-center" style="font-size: 35px; font-weight: 800;">Manage your Urban Garden</h1>
            <p class="lead text-black lh-base text-center" style="max-width: 800px; margin: 0 auto;">Say hello to our growing community! Monitor your urban gardens in an efficient way through our intuitive tools. Join us and watch your urban garden bloom!</p>
                    <div class="row gy-4">
                        <div class="col-lg-4">
                            <div class=" plan-box h-100 mb-0">
                                <div class="card-body p-4 m-2">
                                    <div class="d-flex align-items-center ">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-1 fw-semibold text-center">
                                                <img src="assets/images/plantifeedpics/weather 1.png" alt="" class="img-fluid"> Weather Monitoring <hr>
                                            </h4><br>
                                            <p class="text-muted mb-0" style="text-align: justify;">Stay ahead of the weather curve with Weather Monitoring, your essential tool for urban farming success. Track current conditions, 7-day accurate weather data, and access to past weather data history to optimize your farming strategy.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end col-->
                        <div class="col-lg-4">
                            <div class=" plan-box h-100 mb-0">
                                <div class="card-body p-4 m-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-1 fw-semibold text-center">
                                                <img src="assets/images/plantifeedpics/analytics 1.png" alt="" class="img-fluid"> Analytics <hr>
                                            </h4><br>
                                            <p class="text-muted mb-0" style="text-align: justify;">Utilize comprehensive data analysis tools to effectively monitor expenses, inventory levels, and planting schedules, enabling you to enhance productivity and efficiency within your urban farming endeavors.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-lg-4">
                            <div class=" plan-box h-100 mb-0">
                                <div class="card-body p-4 m-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-1 fw-semibold text-center">
                                                <img src="assets/images/plantifeedpics/calendar 1.png" alt="" class="img-fluid"> Planting Calendar <hr>
                                            </h4><br>
                                            <p class="text-muted mb-0" style="text-align: justify;">Discover a user-friendly gardening companion! This simplifies scheduling, adjusts planting dates, and manages your planting history. Easily track crop growth on a twelve-month calendar view. Streamline your gardening with ease and precision.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                    
    </div>
    
                <div class="container card">

                        <div class="col-lg-12">
                            <div class="">
                                
                                <div class="card-body">
                                   

                                    <!-- Swiper -->
                                    <div class="swiper effect-coverflow-swiper rounded pb-5 swiper-coverflow swiper-3d swiper-initialized swiper-horizontal swiper-watch-progress">
                                        <div class="swiper-wrapper" id="swiper-wrapper-93239b4b57f8d37f" aria-live="off" style="cursor: grab; transition-duration: 300ms; transform: translate3d(-450.75px, 0px, 0px);">
                                        <div class="swiper-slide" role="group" aria-label="5 / 6" data-swiper-slide-index="4" style="width: 300.5px; transition-duration: 300ms; transform: translate3d(0px, 0px, -300px) rotateX(0deg) rotateY(150deg) scale(1); z-index: -2;">
                                                <img src="assets/images/vegetables/img1.jpg" alt="" class="img-fluid">
                                            <div class="swiper-slide-shadow-left swiper-slide-shadow-coverflow" style="opacity: 3; transition-duration: 300ms;"></div><div class="swiper-slide-shadow-right swiper-slide-shadow-coverflow" style="opacity: 0; transition-duration: 300ms;"></div></div><div class="swiper-slide swiper-slide-visible" role="group" aria-label="6 / 6" data-swiper-slide-index="5" style="width: 300.5px; transition-duration: 300ms; transform: translate3d(0px, 0px, -200.166px) rotateX(0deg) rotateY(100.083deg) scale(1); z-index: -1;">
                                                <img src="assets/images/vegetables/img2.jpg" alt="" class="img-fluid">
                                            <div class="swiper-slide-shadow-left swiper-slide-shadow-coverflow" style="opacity: 2.00166; transition-duration: 300ms;"></div><div class="swiper-slide-shadow-right swiper-slide-shadow-coverflow" style="opacity: 0; transition-duration: 300ms;"></div></div><div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-prev" role="group" aria-label="1 / 6" data-swiper-slide-index="0" style="width: 300.5px; transition-duration: 300ms; transform: translate3d(0px, 0px, -100px) rotateX(0deg) rotateY(50deg) scale(1); z-index: 0;">
                                                <img src="assets/images/vegetables/img3.jpg" alt="" class="img-fluid">
                                            <div class="swiper-slide-shadow-left swiper-slide-shadow-coverflow" style="opacity: 1; transition-duration: 300ms;"></div><div class="swiper-slide-shadow-right swiper-slide-shadow-coverflow" style="opacity: 0; transition-duration: 300ms;"></div></div><div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-active" role="group" aria-label="2 / 6" data-swiper-slide-index="1" style="width: 300.5px; transition-duration: 300ms; transform: translate3d(0px, 0px, -0.166389px) rotateX(0deg) rotateY(0.0831947deg) scale(1); z-index: 1;">
                                                <img src="assets/images/vegetables/img4.jpg" alt="" class="img-fluid">
                                            <div class="swiper-slide-shadow-left swiper-slide-shadow-coverflow" style="opacity: 0.00166389; transition-duration: 300ms;"></div><div class="swiper-slide-shadow-right swiper-slide-shadow-coverflow" style="opacity: 0; transition-duration: 300ms;"></div></div><div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-next" role="group" aria-label="3 / 6" data-swiper-slide-index="2" style="width: 300.5px; transition-duration: 300ms; transform: translate3d(0px, 0px, -100px) rotateX(0deg) rotateY(-50deg) scale(1); z-index: 0;">
                                                <img src="assets/images/vegetables/img5.jpg" alt="" class="img-fluid">
                                            <div class="swiper-slide-shadow-left swiper-slide-shadow-coverflow" style="opacity: 0; transition-duration: 300ms;"></div><div class="swiper-slide-shadow-right swiper-slide-shadow-coverflow" style="opacity: 1; transition-duration: 300ms;"></div></div><div class="swiper-slide swiper-slide-visible" role="group" aria-label="4 / 6" data-swiper-slide-index="3" style="width: 300.5px; transition-duration: 300ms; transform: translate3d(0px, 0px, -199.834px) rotateX(0deg) rotateY(-99.9168deg) scale(1); z-index: -1;">
                                                <img src="assets/images/vegetables/img6.jpg" alt="" class="img-fluid">
                                            <div class="swiper-slide-shadow-left swiper-slide-shadow-coverflow" style="opacity: 0; transition-duration: 300ms;"></div><div class="swiper-slide-shadow-right swiper-slide-shadow-coverflow" style="opacity: 1.99834; transition-duration: 300ms;"></div></div></div>
                                        <div class="swiper-pagination swiper-pagination-dark swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-bullets-dynamic" style="width: 150px;"><span class="swiper-pagination-bullet swiper-pagination-bullet-active-prev" tabindex="0" role="button" aria-label="Go to slide 1" style="left: 30px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active swiper-pagination-bullet-active-main" tabindex="0" role="button" aria-label="Go to slide 2" style="left: 30px;" aria-current="true"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next" tabindex="0" role="button" aria-label="Go to slide 3" style="left: 30px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next-next" tabindex="0" role="button" aria-label="Go to slide 4" style="left: 30px;"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5" style="left: 30px;"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 6" style="left: 30px;"></span></div>
                                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                    </div>
                </div>
                <!-- end container -->

           

             <!-- start features -->
        
            <div class="container card">
                
                    <div class="container-fluid card" style="background-color: #066903">
                        <div class="card-body">
                            <h2 class="mb-4 text-center" style="color: #ffffff;">Engage in the community using<br><span style="color:#FFAB2D;"><strong>P L A N T I F E E D</strong></span></h2>
                                <div class="row align-items-center justify-content-lg-between justify-content-center gy-4">

                                        <div class="col-lg-6">
                                            <div class="ratio ratio-16x9" style="border: 7px solid #ffffff;">
                                            <iframe width="560" height="350" src="https://www.youtube.com/embed/Fne6fIzQViA?si=1Jd3T_kfbLUgEnU-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="text-muted">
                                                <div class="vstack gap-0 mb-4 pb-1">
                                                    <h4 style="color: #ffffff;">1. Share your knowledge</h4>
                                                        <div class="d-flex col">
                                                            <div class="flex-grow-1">
                                                                <p class="lead text-white" style="text-align: justify;">
                                                                    Spill the Beans! Share your garden gold in this planting community by swapping tips & tricks to your fellow urban garden farmers enabling the exploration and unlocking of new planting technique journey!
                                                                </p>
                                                            </div>
                                                        </div>

                                                    <h4 style="color: #ffffff;">2. Create Inspiring Story</h4>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <p class="lead text-white" style="text-align: justify;">Plant your story, inspire your city! Spread the journey of your planting, allowing other urban garden farmers to be inspired and relate on your planting plot!.</p>
                                                        </div>
                                                    </div>

                                                    <h4 style="color: #ffffff;">3. Like, Comment, Share</h4>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <p class="lead text-white" style="text-align: justify;">Dig in Deep, Share Your Harvest! Engage with your co-urban garden farmers and express yourself with this interactive buttons by liking posts, commenting thoughts and opinions and sharing to allow a continuously growth of this planting community!</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
<!-- end col -->
                                </div>
                                <h3 class="text-white mb-0 text-center">A platform that connects the urban farmers across the city !</h3>
<!-- end row -->
                        </div>

                    </div>
                
    <!-- end container -->
            </div>

<!-- end features -->



     <!-- start faqs -->
     <section id="faq-section" class="" ><br>
            <div class="container card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-20">
                            <div class="text-center mb-2 mt-3">
                                <h3 class="mb-3">
                                    <img src="assets/images/plantifeedpics/Question.png" alt="FAQ Image" style="vertical-align: middle; margin-right: 10px;">Frequently Asked Questions
                                </h3>
                                <h3 class="mb-3 fw-semibold" style="color:#066903">Questions?<span style="color: black;"><strong> Find Here!</strong></span></h3>

                            </div>
                        </div>
                    </div>
                    <!-- end row -->


    <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
      <h5>What is this Platform for?<h5>
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body"style="text-align: justify;">
        <strong>"Title:</strong> A Web-Based Urban Planting Management System" is a sophisticated platform designed to support the operations of the Center for Urban Agriculture and Innovation. It serves as a comprehensive toolset for managing urban planting initiatives, optimizing resources, and fostering community engagement. Here's an overview of its key features:<br><br>
        <strong>Analytics:</strong> Provides data-driven insights and analytics based on various metrics collected from planting projects, helping the farmers make informed decisions and assess the impact of their efforts.<br><br>
        <strong>Weather Monitoring:</strong> Integrates weather forecasting functionalities to help users plan planting activities effectively and mitigate risks associated with adverse weather conditions.<br><br>
        <strong>Chat System:</strong> Facilitates real-time communication and collaboration among stakeholders, enabling seamless coordination of tasks, sharing of ideas, and support among team members.<br><br>
        <strong>Task Monitoring:</strong> Allows users to create and assign tasks, track their progress, and receive notifications and updates, ensuring efficient project management and accountability.<br><br>
        <strong> Planting Calendar:</strong> Offers a centralized calendar for scheduling and managing planting activities, including planting dates, maintenance tasks, and harvest times, helping users stay organized and on track.<br><br>
        <strong>Event Calendar:</strong> Provides a platform for scheduling and promoting events related to urban agriculture and innovation, fostering community engagement and participation.<br><br>
        <strong>Expense Tracker:</strong> Enables users to monitor and track expenses associated with planting projects, including materials, labor, and other costs, facilitating budget management and financial planning.<br><br>
        <strong>Farm Management:</strong> Offers tools for managing and optimizing farm operations, including crop rotation, soil management, and irrigation scheduling, promoting sustainable and efficient agricultural practices.<br><br>
        <strong>Inventory Management:</strong> Allows users to track the inventory of plants, seeds, tools, and other resources needed for planting projects, ensuring adequate supply and efficient resource allocation.<br><br>
        <strong>Plant Information:</strong> Offers a comprehensive database of plant species suitable for urban environments, including their characteristics, growth requirements, and maintenance needs, aiding in informed plant selection and care.<br><br>
        <strong>Maps:</strong> Integrates mapping functionalities to visualize planting projects, identify suitable planting locations, and share project locations with stakeholders, enhancing planning and communication.

      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
      <h5>Who can use this platform?
</h5>
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body"style="text-align: justify;">This platform can be used by anyone to organize their urban gardens. It is designed for farmers, farmer leaders, and public urban farmers who aim to streamline their activities while planting.





</div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      <h5>Can I use Plantify in my Smartphones?<h5>
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body"style="text-align: justify;"> Absolutely! Plantify offers the flexibility and convenience of access from any mobile device, including smartphones, as well as web browsers. This means whether you're out in the field overseeing planting projects, attending community events, or simply on the move, you can stay connected and manage your urban greening initiatives effortlessly. With Plantify, there's no need to be tied to a desktop computer – you have the freedom to plan, monitor, and engage with your projects wherever you are, ensuring that your efforts in creating vibrant green spaces in urban environments are always at your fingertips.</div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFour">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
      <h5>Can anyone share their story in Plantifeed?</h5>
      </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body"style="text-align: justify;"> Yes! Plantifeed is an inclusive platform where everyone is invited to share their urban planting stories. Whether you're an experienced gardener or just starting out, your voice matters. Join us in inspiring and learning from each other as we cultivate greener, more sustainable cities together.</div>
       
    </div>
  </div>
</div>
</div>
                        <!--end accordion-->
                    </div>
                </div>
            </section>
            <br>

            <section id="contact-section" class="section" id="try" style="padding-top:8px;">
            <div class="container card">
               
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden m-0">
                            <div class="row justify-content-center g-0">
                            
                                <div class="col-lg-8 mt-3">
                                    <div class="text-center mt-3">
                                        <h3 style="vertical-align: middle; margin-right: 10px;"><i class="ri-phone-fill"></i> CONTACT US
                                        </h3>
                                        
                                    </div>
                                </div>
                    
                                <div class="col-lg-6">
                                    <div class="p-lg-4 p-4 auth-one-bg h-100">
                                        
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div>
                                                <a href="/" class="d-block">
                                              
                                                    <img src="assets/images/plantifeedpics/landing-page.png" alt="" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-lg-4 p-4">
                                        <div>
                                            <h5 class="text-center">Let us know how we can help you!</h5>
                                            <p class="text-muted">Send us a message and we’ll get back to you as soon as we can.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form class="needs-validation" novalidate action="index.html">


                                            <div class="mb-3">
                                                    <label for="useremail" class="form-label">Name</label>
                                                    <input type="email" class="form-control" id="useremail" placeholder="Enter your name" required>
                                                    <div class="invalid-feedback">
                                                        Please enter email
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="useremail" placeholder="Enter email address" required>
                                                    <div class="invalid-feedback">
                                                        Please enter email
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Subject</label>
                                                    <input type="text" class="form-control" id="username" placeholder="Enter subject" required>
                                                    <div class="invalid-feedback">
                                                        Please enter username
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="message" class="form-label">Message</label>
                                                    <textarea class="form-control" id="message" placeholder="Enter your message" required></textarea>
                                                    <div class="invalid-feedback">
                                                      Please enter a message
                                                  </div>
                                              </div>
                                               
                                              
                                              <button class="btn btn-success w-100" type="submit" style="background-color: #066903">
                                                      <i class="fas fa-paper-plane"></i> Send message
                                                  </button>

                                                </div>
                                            </form>
                                        </div>
                                        <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-4">&copy;
                                <script>document.write(new Date().getFullYear())</script> CUAI <i class="mdi mdi-heart"style="color: darkgreen; "></i>
                            </p>
                        </div>
                    </div>
                </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    
                   
              
          

                </div>
                <!-- end row -->
            </div>
            
            <!-- end container -->
            
        </div>
        </div>
        </section>

            <footer class="custom-footer py-2 position-relative" style="background-color: #066903">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <div>
                            <div>
                                <img src="assets/images/plantifeedpics/cuai.png" alt="logo light" height="45"><br>
                            </div>

                            <div class="text-muted mt-2">
                                <ul class="list-unstyled ff-secondary footer-list">
                                    <li><a href="https://qcu.edu.ph/" class="text-white "><i class="fas fa-globe"></i> Quezon City University</a></li>
                                    <li><a href="https://www.facebook.com/centerforurbanagri" class="text-white "><i class="fab fa-facebook"></i> Center for Urban Agriculture and Innovation</a></li>
                                    <li><a href="https://www.youtube.com/@qcenterforurbanagri" class="text-white "><i class="fab fa-youtube"></i> QCU Center for Urban Agriculture and Innovation</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 ms-lg-auto">
                        <div class="row">
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0 fs-14">About</h5>
                                <div class="text-muted mt-2">
                                    <ul class="list-unstyled ff-secondary footer-list ">
                                        <li><a href="" class="text-white ">About CUAI </a></li>
                                        <li><a href="" class="text-white ">FAQS</a></li>
                                        <li><a href="" class="text-white ">Help</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0 fs-14">Discover</h5>
                                <div class="text-muted mt-2">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="" class="text-white ">How it works</a></li>
                                        <li><a href="" class="text-white">Learn More</a></li>
                                        <li><a href="" class="text-white ">To Explore</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0 fs-14">Address</h5>
                                <div class="text-muted mt-2">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="https://maps.app.goo.gl/cjvbhDUpdak8g4Fs5" class="text-white "><i class="fas fa-map-marker-alt"></i> 673 Quirino High-way, San Bartolome, Novaliches, Quezon City</a></li>
                                        <li><a href="/" class="text-white "><i class="fas fa-phone-alt"></i> (+63) 927-1168-609</a></li>
                                        <li><a href="/" class="text-white "><i class="fas fa-envelope"></i> Send us a Message</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>

        </footer>
        <!-- end footer -->




            <!--start back-to-top-->    
            
        

            <button onclick="topFunction()" class="btn btn-success btn-icon landing-back-top" id="back-to-top">
                <i class="ri-arrow-up-line"></i>
                
            </div>

            <!-- end layout wrapper -->

            <script>
            function scrollToFAQ() {
            var faqSection = document.getElementById('faq-section');
            faqSection.scrollIntoView({ behavior: 'smooth' });
            }
            function scrollToContact() {
            var faqSection = document.getElementById('contact-section');
            faqSection.scrollIntoView({ behavior: 'smooth' });
            }
            function scrollToHome() {
            var faqSection = document.getElementById('home-section');
            faqSection.scrollIntoView({ behavior: 'smooth' });
            }
            </script>
            <!-- JAVASCRIPT -->
            
            <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/libs/simplebar/simplebar.min.js"></script>
            <script src="assets/libs/node-waves/waves.min.js"></script>
            <script src="assets/libs/feather-icons/feather.min.js"></script>
            <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
            <script src="assets/js/plugins.js"></script>

            <script src="assets/libs/swiper/swiper-bundle.min.js"></script>
            <script src="assets/js/pages/swiper.init.js"></script>
            <!--Swiper slider js-->
            

            <!-- landing init -->
            <script src="assets/js/pages/landing.init.js"></script>
            <script src="assets/libs/particles.js/particles.js"></script>
            <script src="assets/js/pages/particles.app.js"></script>
</body>

</html>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,tl',
            autoDisplay: false,
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'translateButton');
        
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                    var iframe = document.querySelector('.goog-te-banner-frame.skiptranslate');
                    if (iframe) {
                        iframe.style.display = 'none';
                        observer.disconnect();
                    }
                }
            });
        });
        
        observer.observe(document.body, { childList: true, subtree: true });
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>