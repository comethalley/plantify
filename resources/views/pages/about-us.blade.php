<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About-Us</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
     <!-- Include FontAwesome CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.icon')}}" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="{{ asset('assets/js/inventory.js') }}"></script>

    <!--Scanner JS-->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <!-- CSS -->
    <link rel=stylesheet href = "resources/css/style.css">

    </style>
</head>

<div class="header-section" style="display:flex; justify-content:space-around; height:60px; position:sticky; top: 0;   background-color:#8BE262; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); z-index: 1000;">


<div class="header-title">
    <a style="font-size:14px; font-family: Montserrat,sans-serif; text-decoration:none; color:black;" href="#">
        <img src="/assets/images/bg/white 3.png" alt="Plant Image" class="img-fluid" style="height: 65px;">
    </a>
</div>

    

<div class="middle-section" style="align-items:center;font-size:15px;font-family:Montserrat,sans-serif; display:flex; justify-content:space-between; width:500px;">
    <a style="text-decoration:none; color:white; font-family: Poppins, sans-serif; font-size: 13px; font-weight: bold;" href="#" onmouseover="this.style.color='#13C56B'" onmouseout="this.style.color='white'">Home</a>
    <a style="text-decoration:none; color:white; font-family: Poppins, sans-serif; font-size: 13px; font-weight: bold;" href="#" onmouseover="this.style.color='#13C56B'" onmouseout="this.style.color='white'">Analytics</a>
    <a style="text-decoration:none; color:white; font-family: Poppins, sans-serif; font-size: 13px; font-weight: bold;" href="#" onmouseover="this.style.color='#13C56B'" onmouseout="this.style.color='white'">FAQs</a>
    <a style="text-decoration:none; color:white; font-family: Poppins, sans-serif; font-size: 13px; font-weight: bold;" href="#" onmouseover="this.style.color='#13C56B'" onmouseout="this.style.color='white'">Contact</a>
    <a style="text-decoration:none; color:white; font-family: Poppins, sans-serif; font-size: 13px; font-weight: bold;" href="#" onmouseover="this.style.color='#13C56B'" onmouseout="this.style.color='white'">Email</a>
</div>

<div class="middle-section" style="display: flex; align-items: center; justify-content: space-between; font-family: Rubik, sans-serif;">
    <a style="color: white; text-decoration: none; font-family: Poppins, sans-serif; font-size: 13px; font-weight: bold; margin-right: 10px;" href="#">Sign in</a>
    <a style="text-decoration: none; font-size: 13px; background-color: #ED5E5E; color: white; padding: 10px; border-radius: 5px; font-weight: bold; flex-grow: 1; text-align: center;" href="#" onmouseover="this.style.backgroundColor='#c95050'" onmouseout="this.style.backgroundColor='#ED5E5E'">SignUp</a>
</div>
</div>

<body>

<div class="wave">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1365 250" fill="none" >
<path d="M0 80L37.8889 93.3125C75.7778 106.875 151.556 133.125 227.333 143.313C303.111 153.125 378.889 146.875 454.667 126.688C530.444 106.875 606.222 73.125 682 76.6875C757.778 80 833.556 120 909.333 133.313C985.111 146.875 1060.89 133.125 1136.67 136.688C1212.44 140 1288.22 160 1326.11 170L1364 180V7.29139e-06H1326.11C1288.22 7.29139e-06 1212.44 7.29139e-06 1136.67 7.29139e-06C1060.89 7.29139e-06 985.111 7.29139e-06 909.333 7.29139e-06C833.556 7.29139e-06 757.778 7.29139e-06 682 7.29139e-06C606.222 7.29139e-06 530.444 7.29139e-06 454.667 7.29139e-06C378.889 7.29139e-06 303.111 7.29139e-06 227.333 7.29139e-06C151.556 7.29139e-06 75.7778 7.29139e-06 37.8889 7.29139e-06H0V80Z" fill="#8BE262"/>
    </svg>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-3">
                <img src="/assets/images/bg/abtlogo.png" alt="Plant Image" class="img-fluid">
            </div>
            <div class="col-md-9 text-black">
                <h2 class="fw-bold font-Poppins text-black">Why Plantify was Created?</h2>
                <p>
                    Plantify was created to efficiently help the farmers of the Center of Urban Agriculture and Innovation within
                    <br>Quezon City - District 5. The system helps the farmers in the following ways:
                </p>
                <ul class="list-unstyled">
              
        <li><i class="fas fa-check-circle" style="color: #4A9826;"></i> Manage urban farms in a timely manner</li>
        <li><i class="fas fa-check-circle" style="color: #4A9826;"></i> Create data reports for District Leaders</li>
        <li><i class="fas fa-check-circle" style="color: #4A9826;"></i> Track expenses for farms</li>
        <li><i class="fas fa-check-circle" style="color: #4A9826;"></i> Farm based on planting calendar</li>
            </ul>
            </div>
        </div>
    </div>

    <div class="wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1365 250" fill="none">
            <path d="M1365 153.889L1327.06 133.402C1289.11 112.531 1213.22 72.1354 1137.33 56.458C1061.44 41.3576 985.556 50.9757 909.667 82.042C833.778 112.531 757.889 164.469 682 158.986C606.111 153.889 530.222 92.3333 454.333 71.8468C378.444 50.9756 302.556 72.1354 226.667 66.6531C150.778 61.5555 74.8888 30.7777 36.9445 15.3888L-1 -8.17194e-05L-1.00004 277L36.9444 277C74.8888 277 150.778 277 226.667 277C302.556 277 378.444 277 454.333 277C530.222 277 606.111 277 682 277C757.889 277 833.778 277 909.667 277C985.556 277 1061.44 277 1137.33 277C1213.22 277 1289.11 277 1327.06 277L1365 277L1365 153.889Z" fill="#8BE262" />
        </svg>
    </div>
    
    <div class="green-rectangle" style="background-color:#8BE262; padding: 15px;">
<h1 style="margin-bottom:50px; background-color:#8BE262; text-align:center; color: Black; font-family: Poppins;font-size: 30px; font-style: normal; font-weight: 700; line-height: normal;">ORGANIZATIONS</h1>
        <div style="background-color:white; padding: 20px; border-radius:21px;">

            <h1 style="font-family: Poppins; font-size: 30px; font-style: normal;
font-weight: 700; line-height: normal; text-align:center;color:Green; padding: 20px;">QUEZON CITY UNIVERSITY<h1>
                    
                    
                    <div style="text-align: center;">
                        <svg width="200" height="189" viewBox="0 0 200 191" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path d="M199 95.4999C199 147.259 154.727 189.308 99.9999 189.308C45.2728 189.308 0.999878 147.259 0.999878 95.4999C0.999878 43.741 45.2728 1.69238 99.9999 1.69238C154.727 1.69238 199 43.741 199 95.4999Z" fill="url(#pattern0)" stroke="#7D7979" stroke-width="2" />
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_1931_78" transform="matrix(0.00316456 0 0 0.00333787 0 -0.0273841)" />
                                </pattern>
                                <image id="image0_1931_78" width="316" height="316" xlink:href="data:image/png;base64,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" />
                            </defs>
                        </svg>
                    </div>


                    <p style="margin: 20px; color:black; font-size: 16px;font-family: Inter; font-weight: 400; text-align:justify;line-height: normal;text-align:center; text-indent: 2em;">Quezon City University (QCU), formerly known as Quezon City Polytechnic University (QCPU), is a city government-funded university in Quezon City, Philippines. It was established on March 1, 1994, as the Quezon City Polytechnic, offering technical and vocational courses. It was renamed as Quezon City Polytechnic University when it was elevated into university status in 2001. Twenty years later in 2021, QCPU was renamed Quezon City University. </p>




<div class="second-container" style="margin-top:50px; display: grid; grid-template-columns:250px 40px 250px 40px 290px; justify-content:center; ">

<div class="card-1" style="display:flex; flex-direction: column; align-items:center;">
    <svg style="margin-bottom:20px;" width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_1931_100)">
            <path d="M21.41 52.6231L17.1854 48.3985C16.0233 47.2364 15.6132 45.5548 16.1327 43.9962C16.5429 42.7794 17.0897 41.1934 17.746 39.3751H3.28114C2.10536 39.3751 1.01161 38.7462 0.423717 37.7208C-0.164174 36.6954 -0.150502 35.4376 0.45106 34.4259L7.62879 22.3263C9.40614 19.3321 12.619 17.5001 16.0917 17.5001H27.3436C27.6718 16.9532 27.9999 16.4473 28.328 15.9552C39.5253 -0.56047 56.205 -1.10734 66.1581 0.724688C67.744 1.0118 68.9745 2.25594 69.2753 3.84188C71.1073 13.8087 70.5468 30.4747 54.0448 41.672C53.5663 42.0001 53.0468 42.3282 52.4999 42.6563V53.9083C52.4999 57.3809 50.6679 60.6075 47.6737 62.3712L35.5741 69.5489C34.5624 70.1505 33.3046 70.1641 32.2792 69.5762C31.2538 68.9884 30.6249 67.9083 30.6249 66.7188V52.0626C28.6972 52.7325 27.0155 53.2794 25.744 53.6895C24.2128 54.1817 22.5448 53.7579 21.3964 52.6231H21.41ZM52.4999 22.9688C53.9503 22.9688 55.3413 22.3927 56.3669 21.3671C57.3925 20.3415 57.9686 18.9505 57.9686 17.5001C57.9686 16.0497 57.3925 14.6587 56.3669 13.6331C55.3413 12.6075 53.9503 12.0313 52.4999 12.0313C51.0495 12.0313 49.6585 12.6075 48.6329 13.6331C47.6073 14.6587 47.0311 16.0497 47.0311 17.5001C47.0311 18.9505 47.6073 20.3415 48.6329 21.3671C49.6585 22.3927 51.0495 22.9688 52.4999 22.9688Z" fill="#4A9826" />
        </g>
        <defs>
            <clipPath id="clip0_1931_100">
                <rect width="70" height="70" fill="white" />
            </clipPath>
        </defs>
    </svg>

    <h2 style="font-size: 18px; font-family: Poppins;font-style: normal; font-weight: 700;line-height: normal;"> MISSION</h2>

    <p style="font-size: 16px; font-family: Inter;text-align: center;">To be recognized as the #1 local
        university of employable graduate</p>
</div>

<div>
    <svg style="margin-left:15px; "width="2" height="250" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line x1="1" y1="4.37114e-08" x2="0.999989" y2="250" stroke="#4A9826" stroke-width="2" />
    </svg>

</div>


<div class="card-1" style="display:flex; flex-direction: column; align-items:center;">
    <svg style="margin-bottom:20px; "width="70" height="70" viewBox="0 0 58 77" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M44.8896 37.4322C47.0646 34.3342 48.3334 30.5594 48.3334 26.4688C48.3334 15.8361 39.6787 7.21875 29 7.21875C18.3214 7.21875 9.66669 15.8361 9.66669 26.4688C9.66669 30.5594 10.9354 34.3342 13.1104 37.4322C13.6693 38.2293 14.3339 39.1316 15.0438 40.0941C16.9922 42.7561 19.3182 45.9443 21.0552 49.0875C22.6261 51.9449 23.4266 54.9227 23.8193 57.735H16.4636C16.1313 55.9303 15.5724 54.1707 14.6813 52.5465C13.186 49.8395 11.3281 47.2979 9.47033 44.7563C8.68492 43.6885 7.8995 42.6207 7.14429 41.5379C4.16877 37.2818 2.41669 32.0783 2.41669 26.4688C2.41669 11.8508 14.3188 0 29 0C43.6813 0 55.5834 11.8508 55.5834 26.4688C55.5834 32.0783 53.8313 37.2818 50.8406 41.5529C50.0854 42.6357 49.3 43.7035 48.5146 44.7713C46.6568 47.2979 44.799 49.8395 43.3037 52.5615C42.4125 54.1857 41.8537 55.9453 41.5214 57.75H34.1959C34.5886 54.9377 35.3891 51.9449 36.9599 49.1025C38.6969 45.9594 41.0229 42.7711 42.9714 40.1092C43.6813 39.1467 44.3308 38.2443 44.8896 37.4473V37.4322ZM29 19.25C24.9974 19.25 21.75 22.4834 21.75 26.4688C21.75 27.7922 20.6625 28.875 19.3334 28.875C18.0042 28.875 16.9167 27.7922 16.9167 26.4688C16.9167 19.8215 22.324 14.4375 29 14.4375C30.3292 14.4375 31.4167 15.5203 31.4167 16.8438C31.4167 18.1672 30.3292 19.25 29 19.25ZM29 77C22.324 77 16.9167 71.616 16.9167 64.9688V62.5625H41.0834V64.9688C41.0834 71.616 35.6761 77 29 77Z" fill="#4A9826" />
    </svg>

    <h2 style="font-size: 18px; font-family: Poppins;font-style: normal;
font-weight: 700;
line-height: normal;"> VISION</h2>

    <p style="font-size: 16px; font-family: Inter;text-align: center;font-style: normal;
font-weight: 400;
line-height: normal;">To be provide a comprehensive education thet enhances the lives of QCU students for nation-buildin</p>

</div>


<div>
    <svg style="margin-left:45px;"width="2" height="250" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line x1="1" y1="4.37114e-08" x2="0.999989" y2="250" stroke="#4A9826" stroke-width="2" />
    </svg>

</div>

<div class="card-1" style="display:flex; flex-direction: column; align-items:center;">
    <svg style="margin-bottom:20px; "width="70" height="70" viewBox="0 0 57 76" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_1931_93)">
            <path d="M25.7984 0.816418C27.4312 -0.267175 29.5687 -0.267175 31.2015 0.816418L33.8437 2.55314C34.7344 3.13204 35.7734 3.41407 36.8273 3.3547L39.989 3.16173C41.9484 3.04298 43.7891 4.11173 44.6648 5.86329L46.0898 8.69845C46.5648 9.64845 47.3367 10.4055 48.2719 10.8805L51.1367 12.3203C52.8883 13.1961 53.957 15.0367 53.8383 16.9961L53.6453 20.1578C53.5859 21.2117 53.868 22.2656 54.4469 23.1414L56.1984 25.7836C57.282 27.4164 57.282 29.5539 56.1984 31.1867L54.4469 33.8438C53.868 34.7344 53.5859 35.7734 53.6453 36.8274L53.8383 39.9891C53.957 41.9484 52.8883 43.7891 51.1367 44.6649L48.3015 46.0899C47.3516 46.5649 46.5945 47.3367 46.1195 48.2719L44.6797 51.1367C43.8039 52.8883 41.9633 53.957 40.0039 53.8383L36.8422 53.6453C35.7883 53.5859 34.7344 53.868 33.8586 54.4469L31.2164 56.1984C29.5836 57.282 27.4461 57.282 25.8133 56.1984L23.1562 54.4469C22.2656 53.868 21.2265 53.5859 20.1726 53.6453L17.0109 53.8383C15.0515 53.957 13.2109 52.8883 12.3351 51.1367L10.9101 48.3016C10.4351 47.3516 9.66327 46.5945 8.72811 46.1195L5.86327 44.6797C4.11171 43.8039 3.04296 41.9633 3.16171 40.0039L3.35467 36.8422C3.41405 35.7883 3.13202 34.7344 2.55311 33.8586L0.816394 31.2016C-0.2672 29.5688 -0.2672 27.4313 0.816394 25.7984L2.55311 23.1563C3.13202 22.2656 3.41405 21.2266 3.35467 20.1727L3.16171 17.0109C3.04296 15.0516 4.11171 13.2109 5.86327 12.3352L8.69842 10.9102C9.64842 10.4203 10.4203 9.64845 10.8953 8.69845L12.3203 5.86329C13.1961 4.11173 15.0367 3.04298 16.9961 3.16173L20.1578 3.3547C21.2117 3.41407 22.2656 3.13204 23.1414 2.55314L25.7984 0.816418ZM40.375 28.5C40.375 25.3506 39.1239 22.3301 36.8969 20.1031C34.6699 17.8761 31.6494 16.625 28.5 16.625C25.3505 16.625 22.3301 17.8761 20.1031 20.1031C17.8761 22.3301 16.625 25.3506 16.625 28.5C16.625 31.6495 17.8761 34.6699 20.1031 36.8969C22.3301 39.1239 25.3505 40.375 28.5 40.375C31.6494 40.375 34.6699 39.1239 36.8969 36.8969C39.1239 34.6699 40.375 31.6495 40.375 28.5ZM0.192956 65.5797L6.59061 50.3648C6.6203 50.3797 6.63514 50.3945 6.64999 50.4242L8.07499 53.2594C9.81171 56.7031 13.4187 58.7961 17.2781 58.5734L20.4398 58.3805C20.4695 58.3805 20.514 58.3805 20.5437 58.4102L23.1859 60.1617C23.943 60.6516 24.7445 61.0375 25.5758 61.3047L19.9945 74.5602C19.6531 75.3766 18.8961 75.9258 18.0203 76C17.1445 76.0742 16.2984 75.6734 15.8234 74.9313L11.0437 67.6133L2.71639 68.8453C1.8703 68.9641 1.02421 68.6227 0.489831 67.9547C-0.0445439 67.2867 -0.14845 66.3664 0.178112 65.5797H0.192956ZM37.0055 74.5453L31.4242 61.3047C32.2555 61.0375 33.057 60.6664 33.8141 60.1617L36.4562 58.4102C36.4859 58.3953 36.5156 58.3805 36.5601 58.3805L39.7219 58.5734C43.5812 58.7961 47.1883 56.7031 48.925 53.2594L50.35 50.4242C50.3648 50.3945 50.3797 50.3797 50.4094 50.3648L56.8219 65.5797C57.1484 66.3664 57.0297 67.2719 56.5101 67.9547C55.9906 68.6375 55.1297 68.9789 54.2836 68.8453L45.9562 67.6133L41.1765 74.9164C40.7015 75.6586 39.8555 76.0594 38.9797 75.9852C38.1039 75.9109 37.3469 75.3469 37.0055 74.5453Z" fill="#4A9826" />
        </g>
        <defs>
            <clipPath id="clip0_1931_93">
                <rect width="57" height="76" fill="white" />
            </clipPath>
        </defs>
    </svg>


    <h2 style="font-size: 18px; font-family: Poppins;font-style: normal; font-weight: 700;line-height: normal;"> VALUES</h2>

    <p style=" margin-left:39px; font-size: 16px; font-family: Inter;text-align: center;font-style: normal;
font-weight: 400; line-height: normal;">Jointness of Undertakings Organizational Adaptability Yoke of Efficiency and Effectivesnes</p>

  
</div>
</div>
</div>
</div>


    <div class="green-rectangle" style="background-color:#8BE262; padding: 15px;">
<h1 style="margin-bottom:50px; background-color:#8BE262; text-align:center; color: Black; font-family: Poppins;font-size: 30px; font-style: normal; font-weight: 700; line-height: normal;"></h1>
        <div style="background-color:white; padding: 20px; border-radius:21px;">

            <h1 style="font-family: Poppins; font-size: 30px; font-style: normal;
font-weight: 700; line-height: normal; text-align:center;color:Green; padding: 20px;">CENTER FOR URBAN AGRICULTURE AND INNOVATION <h1>
                    <div style="text-align: center;">    
    <img src="/assets/images/plantifeedpics/CUAI.jpg" alt="" class="img-fluid" style="width: 220px; height: 210px;">
                    </div>
                            

                            
                <path d="M199 95.4999C199 147.259 154.727 189.308 99.9999 189.308C45.2728 189.308 0.999878 147.259 0.999878 95.4999C0.999878 43.741 45.2728 1.69238 99.9999 1.69238C154.727 1.69238 199 43.741 199 95.4999Z" fill="url(#pattern0)" stroke="#7D7979" stroke-width="2" />

                        

                    <p style="margin: 20px; color:black; font-size: 16px;font-family: Inter; font-weight: 400; text-align:justify;line-height: normal;text-align:center; text-indent: 2em;">Center for Urban Agriculture and Innovation (CUAI) is one of the many manifestations of Mayor Joy Belmonte's commitment to the program on urban development particularly in her effort to address the "zero hunger" challenge of the city. In QCU through CUAI, we believe engaging in this work on many levels towards improving the social, health and economic outcomes for communities.</p>

<div class="second-container" style="margin-top:50px; display: grid; grid-template-columns:250px 40px 250px 40px 290px; justify-content:center; ">

<div class="card-1" style="display:flex; flex-direction: column; align-items:center;">
    <svg style="margin-bottom:20px;" width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_1931_100)">
            <path d="M21.41 52.6231L17.1854 48.3985C16.0233 47.2364 15.6132 45.5548 16.1327 43.9962C16.5429 42.7794 17.0897 41.1934 17.746 39.3751H3.28114C2.10536 39.3751 1.01161 38.7462 0.423717 37.7208C-0.164174 36.6954 -0.150502 35.4376 0.45106 34.4259L7.62879 22.3263C9.40614 19.3321 12.619 17.5001 16.0917 17.5001H27.3436C27.6718 16.9532 27.9999 16.4473 28.328 15.9552C39.5253 -0.56047 56.205 -1.10734 66.1581 0.724688C67.744 1.0118 68.9745 2.25594 69.2753 3.84188C71.1073 13.8087 70.5468 30.4747 54.0448 41.672C53.5663 42.0001 53.0468 42.3282 52.4999 42.6563V53.9083C52.4999 57.3809 50.6679 60.6075 47.6737 62.3712L35.5741 69.5489C34.5624 70.1505 33.3046 70.1641 32.2792 69.5762C31.2538 68.9884 30.6249 67.9083 30.6249 66.7188V52.0626C28.6972 52.7325 27.0155 53.2794 25.744 53.6895C24.2128 54.1817 22.5448 53.7579 21.3964 52.6231H21.41ZM52.4999 22.9688C53.9503 22.9688 55.3413 22.3927 56.3669 21.3671C57.3925 20.3415 57.9686 18.9505 57.9686 17.5001C57.9686 16.0497 57.3925 14.6587 56.3669 13.6331C55.3413 12.6075 53.9503 12.0313 52.4999 12.0313C51.0495 12.0313 49.6585 12.6075 48.6329 13.6331C47.6073 14.6587 47.0311 16.0497 47.0311 17.5001C47.0311 18.9505 47.6073 20.3415 48.6329 21.3671C49.6585 22.3927 51.0495 22.9688 52.4999 22.9688Z" fill="#4A9826" />
        </g>
        <defs>
            <clipPath id="clip0_1931_100">
                <rect width="70" height="70" fill="white" />
            </clipPath>
        </defs>
    </svg>

    <h2 style="font-size: 18px; font-family: Poppins;font-style: normal; font-weight: 700;line-height: normal;"> MISSION</h2>

    <p style="font-size: 16px; font-family: Inter;text-align: center;">To be recognized as the #1 local
        university of employable graduate</p>
</div>

<div>
    <svg style="margin-left:15px; "width="2" height="250" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line x1="1" y1="4.37114e-08" x2="0.999989" y2="250" stroke="#4A9826" stroke-width="2" />
    </svg>

</div>


<div class="card-1" style="display:flex; flex-direction: column; align-items:center;">
    <svg style="margin-bottom:20px; "width="70" height="70" viewBox="0 0 58 77" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M44.8896 37.4322C47.0646 34.3342 48.3334 30.5594 48.3334 26.4688C48.3334 15.8361 39.6787 7.21875 29 7.21875C18.3214 7.21875 9.66669 15.8361 9.66669 26.4688C9.66669 30.5594 10.9354 34.3342 13.1104 37.4322C13.6693 38.2293 14.3339 39.1316 15.0438 40.0941C16.9922 42.7561 19.3182 45.9443 21.0552 49.0875C22.6261 51.9449 23.4266 54.9227 23.8193 57.735H16.4636C16.1313 55.9303 15.5724 54.1707 14.6813 52.5465C13.186 49.8395 11.3281 47.2979 9.47033 44.7563C8.68492 43.6885 7.8995 42.6207 7.14429 41.5379C4.16877 37.2818 2.41669 32.0783 2.41669 26.4688C2.41669 11.8508 14.3188 0 29 0C43.6813 0 55.5834 11.8508 55.5834 26.4688C55.5834 32.0783 53.8313 37.2818 50.8406 41.5529C50.0854 42.6357 49.3 43.7035 48.5146 44.7713C46.6568 47.2979 44.799 49.8395 43.3037 52.5615C42.4125 54.1857 41.8537 55.9453 41.5214 57.75H34.1959C34.5886 54.9377 35.3891 51.9449 36.9599 49.1025C38.6969 45.9594 41.0229 42.7711 42.9714 40.1092C43.6813 39.1467 44.3308 38.2443 44.8896 37.4473V37.4322ZM29 19.25C24.9974 19.25 21.75 22.4834 21.75 26.4688C21.75 27.7922 20.6625 28.875 19.3334 28.875C18.0042 28.875 16.9167 27.7922 16.9167 26.4688C16.9167 19.8215 22.324 14.4375 29 14.4375C30.3292 14.4375 31.4167 15.5203 31.4167 16.8438C31.4167 18.1672 30.3292 19.25 29 19.25ZM29 77C22.324 77 16.9167 71.616 16.9167 64.9688V62.5625H41.0834V64.9688C41.0834 71.616 35.6761 77 29 77Z" fill="#4A9826" />
    </svg>

    <h2 style="font-size: 18px; font-family: Poppins;font-style: normal;
font-weight: 700;
line-height: normal;"> VISION</h2>

    <p style="font-size: 16px; font-family: Inter;text-align: center;font-style: normal;
font-weight: 400;
line-height: normal;">To be provide a comprehensive education thet enhances the lives of QCU students for nation-buildin</p>

</div>


<div>
    <svg style="margin-left:45px;"width="2" height="250" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line x1="1" y1="4.37114e-08" x2="0.999989" y2="250" stroke="#4A9826" stroke-width="2" />
    </svg>

</div>

<div class="card-1" style="display:flex; flex-direction: column; align-items:center;">
    <svg style="margin-bottom:20px; "width="70" height="70" viewBox="0 0 57 76" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_1931_93)">
            <path d="M25.7984 0.816418C27.4312 -0.267175 29.5687 -0.267175 31.2015 0.816418L33.8437 2.55314C34.7344 3.13204 35.7734 3.41407 36.8273 3.3547L39.989 3.16173C41.9484 3.04298 43.7891 4.11173 44.6648 5.86329L46.0898 8.69845C46.5648 9.64845 47.3367 10.4055 48.2719 10.8805L51.1367 12.3203C52.8883 13.1961 53.957 15.0367 53.8383 16.9961L53.6453 20.1578C53.5859 21.2117 53.868 22.2656 54.4469 23.1414L56.1984 25.7836C57.282 27.4164 57.282 29.5539 56.1984 31.1867L54.4469 33.8438C53.868 34.7344 53.5859 35.7734 53.6453 36.8274L53.8383 39.9891C53.957 41.9484 52.8883 43.7891 51.1367 44.6649L48.3015 46.0899C47.3516 46.5649 46.5945 47.3367 46.1195 48.2719L44.6797 51.1367C43.8039 52.8883 41.9633 53.957 40.0039 53.8383L36.8422 53.6453C35.7883 53.5859 34.7344 53.868 33.8586 54.4469L31.2164 56.1984C29.5836 57.282 27.4461 57.282 25.8133 56.1984L23.1562 54.4469C22.2656 53.868 21.2265 53.5859 20.1726 53.6453L17.0109 53.8383C15.0515 53.957 13.2109 52.8883 12.3351 51.1367L10.9101 48.3016C10.4351 47.3516 9.66327 46.5945 8.72811 46.1195L5.86327 44.6797C4.11171 43.8039 3.04296 41.9633 3.16171 40.0039L3.35467 36.8422C3.41405 35.7883 3.13202 34.7344 2.55311 33.8586L0.816394 31.2016C-0.2672 29.5688 -0.2672 27.4313 0.816394 25.7984L2.55311 23.1563C3.13202 22.2656 3.41405 21.2266 3.35467 20.1727L3.16171 17.0109C3.04296 15.0516 4.11171 13.2109 5.86327 12.3352L8.69842 10.9102C9.64842 10.4203 10.4203 9.64845 10.8953 8.69845L12.3203 5.86329C13.1961 4.11173 15.0367 3.04298 16.9961 3.16173L20.1578 3.3547C21.2117 3.41407 22.2656 3.13204 23.1414 2.55314L25.7984 0.816418ZM40.375 28.5C40.375 25.3506 39.1239 22.3301 36.8969 20.1031C34.6699 17.8761 31.6494 16.625 28.5 16.625C25.3505 16.625 22.3301 17.8761 20.1031 20.1031C17.8761 22.3301 16.625 25.3506 16.625 28.5C16.625 31.6495 17.8761 34.6699 20.1031 36.8969C22.3301 39.1239 25.3505 40.375 28.5 40.375C31.6494 40.375 34.6699 39.1239 36.8969 36.8969C39.1239 34.6699 40.375 31.6495 40.375 28.5ZM0.192956 65.5797L6.59061 50.3648C6.6203 50.3797 6.63514 50.3945 6.64999 50.4242L8.07499 53.2594C9.81171 56.7031 13.4187 58.7961 17.2781 58.5734L20.4398 58.3805C20.4695 58.3805 20.514 58.3805 20.5437 58.4102L23.1859 60.1617C23.943 60.6516 24.7445 61.0375 25.5758 61.3047L19.9945 74.5602C19.6531 75.3766 18.8961 75.9258 18.0203 76C17.1445 76.0742 16.2984 75.6734 15.8234 74.9313L11.0437 67.6133L2.71639 68.8453C1.8703 68.9641 1.02421 68.6227 0.489831 67.9547C-0.0445439 67.2867 -0.14845 66.3664 0.178112 65.5797H0.192956ZM37.0055 74.5453L31.4242 61.3047C32.2555 61.0375 33.057 60.6664 33.8141 60.1617L36.4562 58.4102C36.4859 58.3953 36.5156 58.3805 36.5601 58.3805L39.7219 58.5734C43.5812 58.7961 47.1883 56.7031 48.925 53.2594L50.35 50.4242C50.3648 50.3945 50.3797 50.3797 50.4094 50.3648L56.8219 65.5797C57.1484 66.3664 57.0297 67.2719 56.5101 67.9547C55.9906 68.6375 55.1297 68.9789 54.2836 68.8453L45.9562 67.6133L41.1765 74.9164C40.7015 75.6586 39.8555 76.0594 38.9797 75.9852C38.1039 75.9109 37.3469 75.3469 37.0055 74.5453Z" fill="#4A9826" />
        </g>
        <defs>
            <clipPath id="clip0_1931_93">
                <rect width="57" height="76" fill="white" />
            </clipPath>
        </defs>
    </svg>


    <h2 style="font-size: 18px; font-family: Poppins;font-style: normal; font-weight: 700;line-height: normal;"> VALUES</h2>

    <p style=" margin-left:39px; font-size: 16px; font-family: Inter;text-align: center;font-style: normal;
font-weight: 400; line-height: normal;">Jointness of Undertakings Organizational Adaptability Yoke of Efficiency and Effectivesnes</p>

  
</div>
</div>
</div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1364 340" fill="none">
            <path d="M0 151.2L37.8889 176.361C75.7778 201.994 151.556 251.606 227.333 270.861C303.111 289.406 378.889 277.594 454.667 239.439C530.444 201.994 606.222 138.206 682 144.939C757.778 151.2 833.556 226.8 909.333 251.961C985.111 277.594 1060.89 251.606 1136.67 258.339C1212.44 264.6 1288.22 302.4 1326.11 321.3L1364 340.2V-6.92257e-05H1326.11C1288.22 -6.92257e-05 1212.44 -6.92257e-05 1136.67 -6.92257e-05C1060.89 -6.92257e-05 985.111 -6.92257e-05 909.333 -6.92257e-05C833.556 -6.92257e-05 757.778 -6.92257e-05 682 -6.92257e-05C606.222 -6.92257e-05 530.444 -6.92257e-05 454.667 -6.92257e-05C378.889 -6.92257e-05 303.111 -6.92257e-05 227.333 -6.92257e-05C151.556 -6.92257e-05 75.7778 -6.92257e-05 37.8889 -6.92257e-05H0V151.2Z" fill="#8BE262" />
        </svg>




















        
        
        
        
        



        <div class="row" style="width: 1360px; justify-content: flex-end;">
                        <div class="col-lg-10 mx-auto text-center">
<h1 style="margin-bottom:40px; text-align:center; color: Black; font-family: Poppins;font-size: 30px; font-style: normal; font-weight: 700; line-height: normal;">MEET THE TEAM</h1>

                                <div id="teamlist">
                                    <div class="team-list grid-view-filter row" id="team-member-list">

                                    <!-- start -->
                                    
                                    <div class="col mx-auto text-center">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                    <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>            
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                    <img src="/assets/images/team/Gascon.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                <h5 class="fs-16 mb-1">Camila Rose Gascon</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Project Manager</p>    
                                                                            </div>         
                                                                        </div>   
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href=" https://www.facebook.com/camilarose.gascon" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/gasconcamila/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>


                                            <!-- last -->

       
                  

                                </div>
                             
                            </div>
                        </div>
                        <!-- end col -->
                    </div> 
                    
                    
                    <div class="row"  style="width: 1360px;">
                        <div class="col-lg-10 mx-auto text-center">


                                <div id="teamlist">
                                    <div class="team-list grid-view-filter row" id="team-member-list">

                             <!-- start -->
                                    
                             <div class="col mx-auto text-center">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Guevarra.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Christine Joy Guevarra</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Assistant Project Manager</p>    
                                                                            </div>         
                                                                        </div>  
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/Sensaikyut" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/cjguevarra__/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/Cjaaay1" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>


                                            <!-- last -->
       
                  

                                </div>
                             
                            </div>
                        </div>
                        <!-- end col -->
                    </div> 





                    <div class="row"  style="width: 1360px;">
                        <div class="col-lg-10 mx-auto text-center">


                                <div id="teamlist">
                                    <div class="team-list grid-view-filter row" id="team-member-list">



                                                <!-- start -->
                                    
                                    <div class="col mx-auto text-center">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>          
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Bonita.png" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                    <h5 class="fs-16 mb-1">Kenneth Bonita</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Head Programmer</p>    
                                                                            </div>         
                                                                        </div>  
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href=" https://www.facebook.com/kenn.bonita7" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/bonita-kenneth-28b43b23b/" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/comethalley" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  
                                                                         
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>


                                            <!-- last -->

                                                <!-- start -->
                                    
                                    <div class="col mx-auto text-center">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Samin.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                                  
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                    <h5 class="fs-16 mb-1">Yna Rose Samin</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Head Researcher</p>    
                                                                            </div>         
                                                                        </div>    
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/yoo.junggggggg" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/everynayt?igsh=OTAzdGd0bHhibGxn&fbclid=IwAR3lTBIpECJxGybALUk-f6j3x4sfBotTdTGR2u9H29F9xpgICtu6wZ2Un2w" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/Ynarose" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div> 
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>


                                            <!-- last -->

                                </div>
                             
                            </div>
                        </div>
                        <!-- end col -->
                    </div> 


                    <!-- Developer section -->

                    
                    <div class="row" style="width: 1360px; justify-content: flex-end;">
                    <div id="teamlist">
                        <div class="col-lg-10 mx-auto text-center"> <br>
                            <div>
                            <h1 style="margin-bottom:40px; text-align:center; color: Black; font-family: Poppins;font-size: 30px; font-style: normal; font-weight: 700; line-height: normal;">Developer</h1>


                               
                                    <div class="team-list grid-view-filter row" id="team-member-list">
                                    
                                    

                                              <!-- start -->

                                              <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Amoguis.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                        <h5 class="fs-16 mb-1">John Kenneth Amoguis</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>    
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/knnth0715" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/kennierman/?fbclid=IwAR3X9CUnyY23Dwqi-Hfp11CDBDR9nfKWGJF9iLWdAJIETvQkp1eElJOT6gU" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/amoguis-john-kenneth-501b8b249/?fbclid=IwAR3SIaekCRebXDmKyPFNnTw3MwnH38HR3OgYgPdYWr80Za95Wa83Sk0DktE" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/amoguis0715/kenneth15" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>


                                            <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Cabote.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Edman Cabote</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>   
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/edmanerss/" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/edmaners/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/edman-cabote-1955652ba/" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/Edmaners" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>   
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                              
                                                    <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Casas.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                <h5 class="fs-16 mb-1">James Ivan Casas</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>   
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/james.pimocasas" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>   
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                    
                                                    <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0"><img src="assets/images/team/Competente.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                    <h5 class="fs-16 mb-1">Andrei Competente</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div> 
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/andrei.competente.7" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/dreis.pov/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/defnotdrei" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>     
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                      
                                                    <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Domingo.png" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                    <h5 class="fs-16 mb-1">Jayvee Domingo</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>    
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/profile.php?id=100007227828011" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/jaycol19?fbclid=IwAR3vUwbz8pl7btZXbC4R_Efqi5SzYE3GtGPjFF-MR9oEI4nujg_u1xBugQU" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                              
                                                     <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Gabuay.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                    <h5 class="fs-16 mb-1">Kyla Mariel Gabuay</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>  
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/kylmrlgby" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/kyl.mrl/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href=": https://github.com/kylmrl" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>    
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->

                                               <!-- start -->

                                     <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Gecto.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                            <h5 class="fs-16 mb-1">Jerry Gecto</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>  
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/gectojerry" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/xtaka_chan/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/jerry-gecto-8322b9243/" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/xTaka-chan" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>    
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>


                                            <!-- last -->
                                                  
                                                    <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Maglana.png" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                <h5 class="fs-16 mb-1">Jhon Gabriel Maglana</h5>   
                                                                 </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>  
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href=" https://www.facebook.com/jgmaglana" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href=" https://www.instagram.com/jgmaglana" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>    
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                
                                                    <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0"><img src="assets/images/team/Pareja.jpg"alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                    <h5 class="fs-16 mb-1">Alexandra Marie Pareja</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>    
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/alexandramc.pareja" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/alexandra.prj?igsh=MWYwOTMwdzV1eTVtOA%3D%3D" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/alexandra-marie-pareja-4a5375288?trk=contact-info" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/wdpooh" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->

                                                    <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Pomida.png" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                
                                                                    <h5 class="fs-16 mb-1">Cyril John Pomida</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>    
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/pomss0705" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/cyjhnpmd/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/cyjhn" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->

                                                    <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Saludares.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Jayson Karl Saludares</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>    
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href=" https://www.facebook.com/jksaludares" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/kjayssss/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/saludares-jayson-karl-a-33059a2b4/" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/jaysonkarl" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->

                                                    <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0"><img src="assets/images/team/tacsiat.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Shine Tacsiat</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>    
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/Illegirl09" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/shine-tacsiat-4bb79227b/" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/Skytaire?fbclid=IwAR0VpePPzHdt6lMnsbMnaMUR-OU2rCmp0tCug3BZKMs-N5Mw-YEXGNP7S0k" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  

                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                              
                                                 <!-- Start -->
                                       
                                                 <div class="col mx-auto text-center" >
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Torres.png" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Luigi Torres</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div> 
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/lui.torres.96" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/Luitorres" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                        
                                    </ul>
                                </div>     
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                                      
                                                  <!-- Start -->
                                       
                                            <div class="col mx-auto text-center">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/vida.png" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                    <h5 class="fs-16 mb-1">John Paul Vida</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>   
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/jp.vida2" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href=" https://github.com/JohnVida12" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>   
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                              

                                    </div>
                             
                             </div>
                         </div>
                         <!-- end col -->
                     </div>
 


                   <!-- Researcher Section -->

                    <div class="row" style="padding:0;">
                        <div class="col-lg-10 mx-auto text-center"><br>
                            <div>
                            <h1 style="margin-bottom:40px; text-align:center; color: Black; font-family: Poppins;font-size: 30px; font-style: normal; font-weight: 700; line-height: normal;">Researcher</h1>


                                <div id="teamlist">
                                    <div class="team-list grid-view-filter row" id="team-member-list">

                              
                                
                                        
                                       <!-- Start -->
                                       
                                       <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Lagmay.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Loveth Mae Lagmay</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Researcher</p>    
                                                                            </div>         
                                                                        </div>    

                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/luvettoo" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/luvettoo" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/lovethlagmay" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/laveff" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->

                                                 <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Magado.jpeg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Blessie Magado</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Researcher</p>    
                                                                            </div>         
                                                                        </div>   
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/hermione.macy" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/macykim_00/?fbclid=IwAR24gT6t71R3HXOJ874T_x9U-d-KnpanezoPqzaJCSy0TcT-Lw8l1jjd5mI" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/blessie-magado/" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>   
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->

                                                  <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Perez.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Many Perez</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Researcher</p>    
                                                                            </div>         
                                                                        </div>    
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/profile.php?id=100087732785741" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/mannyd.perez?igsh=YWtrN3MyZXF5bHpy&fbclid=IwAR2aU5C9ZeanlOd-exkRZIbBaxCu_YJzrewHF6LbnXdlVkjgVhnPeIOj9pM" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/MannyPerez514?fbclid=IwAR1yzFRJ53zq3MeN-p_A2CbGREiZfHI3zQ0ZriGdNbXZjr8ajwpERKIe1tg" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                              
                                                     <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Ramirez.jpeg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Lodyanne Ramirez</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Researcher</p>    
                                                                            </div>         
                                                                        </div>   
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/ramirezlodyanne" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/lodyanneramirez26?igsh=eG0yaXc5c2dpazdt" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/lodyanne-ramirez-a0592820b/" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>  

                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->                    
                                                       
                                              <!-- Start -->
                                       
                                              <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Romero.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                        <h5 class="fs-16 mb-1">Mark Angelo Romero</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Researcher</p>    
                                                                            </div>         
                                                                        </div>   
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/romerski14" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/markromerski?igsh=MWZ6OXN2amc1YTN2OQ==" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/in/mark-angelo-romero-35b96020b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/macagelo12" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>   
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->

                                                 <!-- Start -->
                                       
                                            <div class="col">
                                            <div class="card team-box" style="border: 2px solid #337236;">
                                                <div class="team-cover" style="background-color:#337236;">  
                                                <img src="/assets/images/team/teamcover.jpg" alt="" class="img-fluid"> </div>           
                                                    <div class="card-body p-4" style="background-color: ;">    
                                                    <div class="row align-items-center team-row"> 
                                                    <div class="col team-settings">   
                                                       <div class="row">            
                                                        <div class="col">    
                                                               
                                                        </div>                 
                                                          <div class="col text-end dropdown"> 
                                              
                                                              </a>            
                                                                </ul>  
                                                                 </div>      
                                                                 </div>        
                                                          </div>         
                                                        <div class="col-lg-4 col">    
                                                          <div class="team-profile-img">   
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                  <img src="/assets/images/team/Zulueta.jpeg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Leonilo Zulueta</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Researcher</p>    
                                                                            </div>         
                                                                        </div>  
                                                                        <div class="card-footer text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/profile.php?id=100079746917904" class="lh-1 align-middle link-secondary"><i class="ri-facebook-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/baile.cute/" class="lh-1 align-middle link-success"><i class="lab la-instagram" style="font-size: 24px; color: pink;"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.linkedin.com/home" class="lh-1 align-middle link-primary"><i class="ri-linkedin-fill style="font-size: 24px;></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        <a href="https://github.com/" class="lh-1 align-middle link-success"><i class="lab la-github" style="font-size: 24px; color: black;"></i></a>
                                        </li>
                                       
                                    </ul>
                                </div>
                                
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                               


                                            </div>
                             
                             </div>
                             
                         </div>
                         <!-- end col -->

                        
            

                     </div>
                
</div>


   


<div class="row" style="width: 1370px; justify-content:flex-; background-color:#70CC40; display:grid; grid-template-columns:300px 210px 220px 300px 200px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">

<div class="plantify-section" style="flex-direction: column; padding:10px; align-items: center;">
<a style="font-size:14px; font-family: Montserrat,sans-serif; color:white;" href="#">
    <img src="/assets/images/bg/white 3.png" alt="Plant Image" class="img-fluid" style="height: 65px;">
</a>



</div>



<div class="about-section" style="display:flex; flex-direction: column; padding:10px;">
    <h4 style="font-family:Montserrat,sans-serif; color:white;">About</h4>
    <p style="font-family: Rubik, sans-serif; color:white; font-size:14px; margin-bottom: 5px;">About Plantify</p>
    <p style="font-family: Rubik, sans-serif; color:white; font-size:14px; margin-bottom: 5px;">FAQS</p>
    <p style="font-family: Rubik, sans-serif; color:white; font-size:14px; margin-bottom: 5px;">Help</p>
</div>

<div class="discover-section" style="display:flex; flex-direction: column; padding:10px;">
    <h4 style="font-family:Montserrat,sans-serif; color:white;">Discover</h4>
    <p style="font-family: Rubik, sans-serif; color:white; font-size:14px; margin-bottom: 5px;">How it works</p>
    <p style="font-family: Rubik, sans-serif; color:white; font-size:14px; margin-bottom: 5px;">Learn More</p>
    <p style="font-family: Rubik, sans-serif; color:white; font-size:14px; margin-bottom: 5px;">To Explore</p>
</div>

<div class="address-section" style="display:flex; flex-direction: column; padding:10px;">
<h4 style="font-family:Montserrat,sans-serif; color:white;">Address</h4>
<p style="font-family: Rubik, sans-serif; color:white; font-size:14px; margin-bottom: 5px;"><i class="fas fa-map-marker-alt"></i>
673 Quirino Highway, San <br>Bartolome Novaliches Quezon City</p>
</div>

<div class="contact-section" style="display:flex; flex-direction: column; padding:10px 2px;">
<h4 style="font-family:Montserrat,sans-serif;  color:white; ">Contact us</i></h4>
    
<p style="font-family: Rubik, sans-serif; color: white; font-size: 14px; margin-bottom: 5px; text-align: justify;">Feel free to contact us any time. We will get back to you as soon as we can!</p>

<button id="myBtn" style="padding: 10px 20px; background-color: #ffffff; color: black; border: 1px solid black; border-radius: 8px; cursor: pointer;">Send us a Message!</button>

<!-- The Modal -->
<div id="myModal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
<div style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 40%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
<form id="contactForm" style="text-align: left;">
  <span style="color: #aaa; font-size: 28px; font-weight: bold; cursor: pointer; position: absolute; right: 10px; top: 10px;" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
  
  <label for="email" style="font-size: 14px; color: #333; text-align: left; display: block; font-weight: bold;">Email:</label>
  <input type="email" id="email" name="email" placeholder="Enter your Email" style="outline: none; width: calc(100% - 20px); padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; text-align: left;" required><br>
  
  <label for="subject" style="font-size: 14px; color: #333; text-align: left; display: block; font-weight: bold;">Subject:</label>
  <input type="subject" id="subject" name="subject" placeholder="Enter your Subject" style="outline: none; width: calc(100% - 20px); padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; text-align: left;" required><br>
  
  <label for="message" style="font-size: 14px; color: #333; text-align: left; display: block; font-weight: bold;">Message:</label>
  <textarea id="message" placeholder="Enter your Message" name="message" style="resize: none; outline: none; width: calc(100% - 20px); padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; text-align: left;" required></textarea><br>
  
  <div style="text-align: right;">
    <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 14px;">Send</button>
    <button type="button" style="padding: 10px 20px; background-color: rgb(237, 94, 94); color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; margin-left: 10px;" onclick="document.getElementById('myModal').style.display='none'">Close</button>
  </div>
</form>
</div>
</div>



                     
                    