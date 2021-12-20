<!doctype html>

<html dir="{{ str_replace('_', '-', app()->getLocale()) == 'ar' ? 'rtl' : 'ltr' }}"
        lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <title>{{ config('app.name', 'Accounting') }}</title>
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
   
        @yield('style')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>
    <div id="app">

       <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{ asset('images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{ asset('images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="{{ asset('images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="sl-icon-menu font-20"></i>
                            </a>
                        </li>

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">

                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="flag-icon flag-icon-us font-18"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbarDropdown2">
                       @if (app()->getLocale() == 'ar')
                                <a class="dropdown-item" href="{{ url('locale/en') }}">
                                    <i class="flag-icon flag-icon-us"></i> English</a>
                   @else
                                <a class="dropdown-item" href="{{ url('locale/ar') }}">
                                    <i class="flag-icon flag-icon-fr"></i> Arabic</a>
                     @endif




                            </div>
                        </li>

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            @guest
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img src="{{ asset('images/users/default_user.png') }}" alt="user" class="rounded-circle" width="31">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="">
                                        <img src="{{ asset('images/users/default_user.png') }}" alt="user" class="img-circle" width="60">
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"> visitor</h4>
                                        <p class=" m-b-0"> ..</p>
                                    </div>
                                </div>

                              @if (Route::has('login'))
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="ti-user m-r-5 m-l-5"></i>{{ __('Login') }}</a>
                                     @endif
                                     @if (Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}">
                                    <i class="ti-wallet m-r-5 m-l-5"></i>{{ __('Register') }}</a>
                                    @endif

                            </div>
                              @else
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img src="{{ asset('images/users/default_user.png') }}" alt="user" class="rounded-circle" width="31">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="">
                                        <img src="{{ asset('images/users/default_user.png') }}" alt="user" class="img-circle" width="60">
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"> {{ Auth::user()->name }}</h4>
                                        <p class=" m-b-0"> {{ Auth::user()->email }}</p>
                                    </div>
                                </div>


                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i>{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                            @csrf
                                                                        </form>
                                
                            </div>
                            @endguest
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @auth()
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">{{__('Add Daily Entry')}}</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-Navigation-LeftWindow" style="padding-left: 30px"></i><span class="hide-menu" style="padding-left: 20px">{{__('Add Daily Entry')}}</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('Mains.create')}}" aria-expanded="false"><i class="mdi mdi-border-top"></i><span class="hide-menu">{{__('financial record')}}</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('Mains.dailyCash',3)}}" aria-expanded="false"><i class="mdi mdi-border-style"></i><span class="hide-menu">{{__('Cash')}}</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('Mains.dailyCashIn',1)}}" aria-expanded="false"><i class="mdi mdi-border-style"></i><span class="hide-menu">{{__('Cash in')}}</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('Mains.dailyCashOut',2)}}" aria-expanded="false"><i class="mdi mdi-border-style"></i><span class="hide-menu">{{__('Cash out')}}</span></a></li>
                            </ul>
                        </li>

                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">{{__('Daily Entry')}}</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{route('Mains.index')}}" aria-expanded="false"><i class="icon-Box-withFolders"></i><span class="hide-menu">{{__('Daily Entry')}}</span></a></li>

                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">{{__('Financial constraints')}}</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{route('Transactions.index')}}" aria-expanded="false"><i class="icon-File-HorizontalText"></i><span class="hide-menu">{{__('Financial constraints')}}</span></a></li>

                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">{{__('General ledger')}}</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{route('gl')}}" aria-expanded="false"><i class="icon-File-HorizontalText"></i><span class="hide-menu">{{__('General ledger')}}</span></a></li>

<li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">{{__('Trial Balance')}}</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="icon-Neutron" style="padding-left: 30px"></i><span class="hide-menu" style="padding-left: 20px"> {{__('Trial Balance')}}</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('BLdaily')}}" aria-expanded="false"><i class="mdi mdi-image-filter-tilt-shift"></i><span class="hide-menu"> {{__('Daily Account Balance')}}</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">{{__('General Balance')}}</span></a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item"><a href="{{route('BLsheetGet','budget')}}" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> {{__('budget')}}</span></a></li>
                                        <li class="sidebar-item"><a href="{{route('BLsheetGet','Income_list')}}" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> {{__('Income list')}}</span></a></li>
                                         </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">{{__('Options')}}</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-Car-Wheel"></i><span class="hide-menu">{{__('settings')}}</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('Accounts.index')}}" aria-expanded="false"><i class="mdi mdi-border-top"></i><span class="hide-menu">{{__('Accounts')}}</span></a></li>
                                @if (Auth::user()->parent_id == null)
                                 <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('Users.index')}}" aria-expanded="false"><i class="mdi mdi-border-top"></i><span class="hide-menu">{{__('Employees')}}</span></a></li>
                                @endif
                                 <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('Options.index')}}" aria-expanded="false"><i class="mdi mdi-border-top"></i><span class="hide-menu">{{__('Options')}}</span></a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('Sets.index')}}" aria-expanded="false"><i class="mdi mdi-border-style"></i><span class="hide-menu">{{__('Default values')}}</span></a></li>
                            </ul>
                        </li>




                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-Increase-Inedit"></i><span class="hide-menu">{{__('Additions')}}</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                 @if(Auth::user()->parent_id== null)
                                     <li class="sidebar-item"><a href="{{route('poll.index')}}" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu"> {{__('New vote')}}</span></a></li>
                                     <li class="sidebar-item"><a href="{{route('allResult')}}" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu"> {{__('Voting results')}}</span></a></li>
                                    @endif
                                <li class="sidebar-item"><a href="{{route('getvote')}}" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu"> {{__('vote')}}</span></a></li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-Increase-Inedit"></i><span class="hide-menu">{{__('Task')}}</span></a>
                            <ul aria-expanded="false" class="collapse first-level">

                                     <li class="sidebar-item"><a href="{{route('delegatedTasks')}}" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu"> {{__('Delegated Tasks')}}</span></a></li>
                                     <li class="sidebar-item"><a href="{{route('tasks.create')}}" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">{{__('New Task')}}</span></a></li>
                                     <li class="sidebar-item"><a href="{{route('tasks.index')}}" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">{{__('My Tasks')}}</span></a></li>
                                     <li class="sidebar-item"><a href="{{route('archive')}}" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">{{__('Archive')}}</span></a></li>



                            </ul>
                        </li>



                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        @endauth

                @yield('content')

                <footer class="page-footer font-small blue " >
                        <!-- Copyright -->
                            <div class="footer-copyright text-center py-3"> {{__('All Rights Reserved by Innovative Systems . Designed and Developed by')}}
                                <a href="https://www.almounkez.com" target="Blank"> {{__('AlMounkez')}}</a>.
                            </div>
                        <!-- Copyright -->
                </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
     </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/app.init.horizontal.js') }}"></script>
    <script src="{{ asset('js/app-style-switcher.horizontal.js') }}"></script>
     {{-- <script src="{{ asset('js/app.init.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/app-style-switcher.js') }}"></script> --}}
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/custom.min.js') }}"></script>


 </body>
@yield('script')
</html>
