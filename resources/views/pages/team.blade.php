<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Plantify</title>
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

            
    <body>
    
    <br>
    <br>

    
                 <div class="row">
                        <div class="col-lg-10 mx-auto text-center">
                            <div>
                                <h1> PlanTeam</h1> <br>

                                <div id="teamlist">
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
                                                                    <img src="/assets/images/team/Gascon.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Camila Gascon</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Project Manager</p>    
                                                                            </div>         
                                                                        </div>    
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>


                                            <!-- last -->

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
                                                                  <img src="/assets/images/team/Guevarra.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Christine Joy Guevarra</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Assistant Project Manager</p>    
                                                                            </div>         
                                                                        </div>    
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>


                                            <!-- last -->

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
                                                                  <img src="/assets/images/team/Bonita.png" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Kenneth Bonita</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Head Programmer</p>    
                                                                            </div>         
                                                                        </div>    
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>


                                            <!-- last -->

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
                                                                  <img src="/assets/images/team/Samin.jpeg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Yna Rose Samin</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Head Researcher</p>    
                                                                            </div>         
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

                    <div class="row">
                        <div class="col-lg-10 mx-auto text-center"> <br>
                            <div>
                                <h1> Developer </h1> <br>

                                <div id="teamlist">
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
                                                                                    <h5 class="fs-16 mb-1">Kenneth Amoguis</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
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
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0"><img src="assets/images/users/avatar-2.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Andrei Competente</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
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
                                                                  <img src="/assets/images/team/Domingo.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Jayvee Domingo</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
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
                                                                                    <h5 class="fs-16 mb-1">Kyla Gabuay</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
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
                                                                  <img src="/assets/images/team/Maglana.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Gabriel Maglana</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
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
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0"><img src="assets/images/users/avatar-2.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Alexandra Marie Pareja</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
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
                                                                                    <h5 class="fs-16 mb-1">Cyril Pomida</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
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
                                                                 <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0"><img src="assets/images/users/avatar-2.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Shine Taciat</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>    
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                              
                                                 <!-- Start -->
                                       
                                                 <div class="col" >
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
                                                                  <img src="/assets/images/team/Torres.jpg" alt="" class="member-img img-fluid d-block rounded-circle"></div>   
                                                          <div class="team-content">  
                                              <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview">  
                                                                                    <h5 class="fs-16 mb-1">Lui Torres</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
                                                                        </div>    
                                                                 </div>     
                                                  
                                                             </div> 
                                                          </div>  
                                                    </div>   
                                                </div>

                                               <!-- Last-->
                                                                      
                                                  <!-- Start -->
                                       
                                            <div class="col ">
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
                                                                                    <h5 class="fs-16 mb-1">John Vida</h5>   
                                                                     </a>     
                                                         <p class="member-designation mb-0">Developer</p>    
                                                                            </div>         
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

                    <div class="row">
                        <div class="col-lg-10 mx-auto text-center"><br>
                            <div>
                                <h1> Researcher</h1> <br>

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
                                                                                              
</body>
                    

