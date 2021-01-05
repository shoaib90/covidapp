<!-- BEGIN HEADER -->
<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <!--<a href="index.html">
                    <img src="../assets/layouts/layout3/img/logo-default.jpg" alt="logo" class="logo-default">
                </a>-->
                <h3>{{ __('CovidApp') }}</h3>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default">1</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>You have
                                    <strong>12 pending</strong> tasks</h3>
                                <a href="app_todo.html">view all</a>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <li class="droddown dropdown-separator">
                        <span class="separator"></span>
                    </li>
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="{{ asset('/images/theme/avatar9.jpg')}}">
                            <span class="username username-hide-mobile">{{ Auth::user()->first_name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i> {{ __('Logout') }} </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu  ">
                <ul class="nav navbar-nav">
                    <li class="menu-dropdown classic-menu-dropdown active">
                        <a href="{{ route('home') }}"> Dashboard
                            <span class="arrow"></span>
                        </a>
                    </li>
                    @if(Auth::user()->type == 0 || Auth::user()->type == 2)
                    <li class="menu-dropdown classic-menu-dropdown active">
                        <a href="{{ route('bookingList') }}" class="nav-link  active">
                        Booking List </a>
                    </li>
                    @endif
                    @if(Auth::user()->type == 0)
                        <li class="menu-dropdown classic-menu-dropdown active">
                            <a href="{{ route('addBookingForm') }}" class="nav-link  ">
                                Add New Booking
                            </a>
                        </li>
                        <li class="menu-dropdown classic-menu-dropdown active">
                            <a href="{{ route('addProvider') }}" class="nav-link  ">
                                Add New Provider
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ route('providerList') }}" class="nav-link  active">
                               Provider List </a>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->