<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>HireX Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">

     <link rel="stylesheet" href="{{asset('css/bootstrapNew.min.css')}}"> 

     <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}"> 

    <link rel="stylesheet" href="{{asset('css/scrollbar/jquery.mCustomScrollbar.min.css')}}">
     <link href=" {{asset('images/logo-transparent.png')}}" rel="icon" type="image/x-icon"> 
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>



    <!-- Start Left menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar">
            <div class="sidebar-header">
               <a href="/dashboard"> <img src="{{asset('images/logo-transparent.png')}}" alt="" style="width: 200px;
                    height: 100px;"></a>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">

                        <li>
                            <a title="Landing Page" href="{{route('employer')}}" aria-expanded="false"><span><i class="fa-solid fa-users"></i></span> <span class="mini-click-non">Employers</span></a>
                        </li>
                        <li>
                            <a title="Landing Page" href="{{route('candidate')}}" aria-expanded="false"><span><i class="fa-solid fa-user"></i></span> <span class="mini-click-non">Candidates</span></a>
                        </li>
                        <li>
                            <a title="Landing Page" href="{{route('category')}}" aria-expanded="false"><span><i class="fa-solid fa-list"></i></span> <span class="mini-click-non">Category</span></a>
                        </li>
                        <li>
                            <a title="Landing Page" href="{{route('jobs')}}" aria-expanded="false"><span><i class="fa-solid fa-briefcase"></i></span> <span class="mini-click-non">Jobs</span></a>
                        </li>

                        <li>
                            <a title="Landing Page" href="{{route('home')}}" aria-expanded="false"><span><i class="fa-solid fa-house"></i></span> <span class="mini-click-non">Home</span></a>
                        </li>

                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Left menu area -->

    
<div class="all-content-wrapper">
<div class="header-advance-area">
    <div class="header-top-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="header-top-wraper">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                                <div class="menu-switcher-pro">
                                    <button type="button" id="sidebarCollapse" class=" bar-button-pro header-drl-controller-btn  ">
                                        <i class="fa-solid fa-sliders" style="color: #1f3541;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-11 col-md-10 col-sm-10 col-8">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu justify-content-end">
                                        <li class="nav-item dropdown">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                <i class="fa-solid fa-bars" style="color: #1f3541; margin-right:20px;"></i>
                                                <span class="indicator-ms"></span>
                                            </a>
                                            <div role="menu" class="author-message-top dropdown-menu animated zoomIn">
                                                <div class="message-single-top">
                                                    <a href="/dashboard">Main</a><br>
                                                    <a href="{{route('employer')}}">Employers</a><br>
                                                    <a href="{{route('candidate')}}">Candidates</a><br>
                                                    <a href="{{route('category')}}">Categories</a><br>
                                                    <a href="{{route('jobs')}}">Jobs</a><br>
                                                    <a href="{{route('home')}}">Home</a><br>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

</div>
    <script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebarDropdown').toggle();
        });
    });
</script>




    <script src="{{asset('js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.meanmenu.js')}}"></script>
    <script src="{{asset('js/metisMenu/metisMenu-active.js')}}"></script>
    <script src="{{asset('js/morrisjs/raphael-min.js')}}"></script>
    <script src="{{asset('js/morrisjs/morris.js')}}"></script>
    <script src="{{asset('js/morrisjs/morris-active.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    @yield('scripts')

</body>

</html>