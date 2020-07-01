<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">          
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert.css')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>


<script src="{{asset('assets/js/jquery.min.js')}}" ></script> 
 <script src="{{asset('assets/js/toastr.min.js')}}"></script> 
<!-- <script src="{{asset('assets/js/alert.js')}}" ></script> -->
<script src="{{asset('assets/js/vue.js')}}" ></script>
<script src="{{asset('assets/js/axios.js')}}" ></script>

 <script src="{{asset('assets/js/bootstrap.min.js')}}" ></script>


    <!-- Scripts -->
   

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
     <link href="{{ asset('css/pagination.css') }}" rel="stylesheet"> 
     <link href="{{ asset('css/style-v2.css') }}" rel="stylesheet"> 
</head>
<body>
    <div id="app">
            @guest
            @else
            <!-- <nav class="navbar navbar-expand-lg " style="background-color: white; font-size: 18px; position: fixed; width: 100%; height: 50px;" >
                    <div class="navbar-header">
                            <span class="menu-icon" id="menu-icon">
                                   <svg height="65px" width="32px">
                                   <path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/></svg>
                            </span>
                         </div> -->

               
            <div class="top-header">
                
                <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo">
                <div class="header-profile">
                <div class="dropdownContainer">
                        <img onclick="myFunction()"  src="{{ asset('images/bell.svg') }}" alt="notification" class="notification dropdown-toggle">
                            <span id="notification"> </span>
                            <ul class="dropdown">
                              
                            </ul>
                        </div>

                    <h3 class="restaurant-name">{{ Auth::user()->name }}</h3>
                    <div class="pdp dropdownclick" >
                   <img class="pdp" src="http://restaurant.foodeals.ma/storage/{{Auth::user()->logo }}"  alt="Logo">
                   
                    {{-- <img class="pdp" src="{{ asset('images/pdp.png') }}"  alt="Logo"> --}}
                    </div>
                    <img class="down dropdownclick" src="{{ asset('images/down.svg') }}" alt="down arrow">
                    <ul class="drop-down">
                        <!-- <li><a href="#">Profile</a></li>  -->
                        <li><a href="{{url('/profile')}}">Profile</a> </li>  
                        {{-- <li><span>{{Auth::user()->logo }}</span></li> --}}
                       <!-- <li><a href="{{url('/documents')}}">Mes Documents</a></li>-->
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form></li>
                    </ul>
                </div>
            </div>   
                   
                 

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto" style="list-style:none;">
                                    
                      <a class="navbar-brand" href="{{url('/home' )}}">
                            {{-- <img src="{{ asset('storage/logo.jpg') }}" width="130" height="30" alt=""> --}}
                          </a>
                                   @endguest
                      
        
                    </ul>
                     
                      @guest
                 @else
                
                  @endguest
                    </div>
                     
                  </nav> 
                  @guest
                  @else
                   <div class="container_table_side">
                        <div class="side_bar">
                            <ul id="side" class="side-nav">    
                                @php
                                   $page = $_SERVER['PHP_SELF'];    
                                //    echo '<h1>'.$page.'</h1>';
                                @endphp          
                                <li   @if($page=="/index.php/home" || $page=="/index.php/produitsCourants") class='active_side_Bar' @endif >                      
                                    <a class="" href="{{url('/home')}}">Accueil </a>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                        <path d="M2.25 6.75L9 1.5L15.75 6.75V15C15.75 15.3978 15.592 15.7794 15.3107 16.0607C15.0294 16.342 14.6478 16.5 14.25 16.5H3.75C3.35218 16.5 2.97064 16.342 2.68934 16.0607C2.40804 15.7794 2.25 15.3978 2.25 15V6.75Z" stroke="#8E8F8F" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.75 16.5V9H11.25V16.5" stroke="#8E8F8F" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0">
                                        <rect width="18" height="18" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                </li>
                                <li @if($page=="/index.php/historique") class='active_side_Bar' @endif>                      
                                    <a class="" href="{{url('/historique')}}">Historique</a>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 16.5C13.1421 16.5 16.5 13.1421 16.5 9C16.5 4.85786 13.1421 1.5 9 1.5C4.85787 1.5 1.5 4.85786 1.5 9C1.5 13.1421 4.85787 16.5 9 16.5Z" stroke="#8E8F8F" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 4.5V9L12 10.5" stroke="#8E8F8F" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </li>
                                <li @if($page=="/index.php/Mesproduits") class='active_side_Bar' @endif>                      
                                    <a class="" href="{{url('/Mesproduits')}}">Mes produits</a>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.5 1.5L2.25 4.5V15C2.25 15.3978 2.40804 15.7794 2.68934 16.0607C2.97064 16.342 3.35218 16.5 3.75 16.5H14.25C14.6478 16.5 15.0294 16.342 15.3107 16.0607C15.592 15.7794 15.75 15.3978 15.75 15V4.5L13.5 1.5H4.5Z" stroke="#8E8F8F" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M2.25 4.5H15.75" stroke="#8E8F8F" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 7.5C12 8.29565 11.6839 9.05871 11.1213 9.62132C10.5587 10.1839 9.79565 10.5 9 10.5C8.20435 10.5 7.44129 10.1839 6.87868 9.62132C6.31607 9.05871 6 8.29565 6 7.5" stroke="#8E8F8F" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> 
                                </li>
                                <li @if($page=="/index.php/commandeslivrees" || $page=="/index.php/produitsLivres") class='active_side_Bar' @endif>                      
                                    <a class="" href="{{url('/commandeslivrees')}}">Commande livrée</a>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.5 8.3099V8.9999C16.4991 10.6172 15.9754 12.1909 15.007 13.4863C14.0386 14.7816 12.6775 15.7293 11.1265 16.1878C9.57557 16.6464 7.91795 16.5913 6.40085 16.0308C4.88376 15.4704 3.58849 14.4345 2.70822 13.0777C1.82795 11.7209 1.40984 10.1159 1.51626 8.50214C1.62267 6.88832 2.24791 5.35214 3.29871 4.1227C4.34951 2.89326 5.76959 2.03644 7.34714 1.68001C8.9247 1.32358 10.5752 1.48665 12.0525 2.1449" stroke="#8E8F8F" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16.5 3L9 10.5075L6.75 8.2575" stroke="#8E8F8F" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> 
                                </li>
                            </ul>
                        </div>
                      
                    @endguest
                    <div class="right_side_container" id="right-container">
                        @yield('content')
                    </div>
           
                  
                 




          
        


       
    </div>

    <input type="hidden" value="{{Session::get('success')}}" id="success">
    <input type="hidden" value="{{session()->get('warning')}}" id="warning">




@yield('style')
@yield('javascript')

<script type="text/javascript">
    var sc = $('#success').val();
    var wr = $('#warning').val();

if(sc!="")
    toastr.success(sc);

if(wr!="")
    toastr.error(wr);
</script>



    <script src="{{asset('assets/js/myscript.js')}}" ></script>
    <script src="{{asset('assets/js/Timer.js')}}" ></script>
</body>
</html>

