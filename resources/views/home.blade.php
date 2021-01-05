@extends('layouts.app')

@section('content')
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="container">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Dashboard
                        <small></small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE CONTENT BODY -->
        <div class="page-content">
            <div class="container">
                <!-- BEGIN PAGE BREADCRUMBS -->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="#">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>
                <!-- END PAGE BREADCRUMBS -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="{{$bookingHistoryCount}}">0</span>
                                        </h3>
                                        @if(Auth::user()->type == 0 || Auth::user()->type == 2)
                                            <a href="{{ route('historyBookings') }}"><small>BOOKING HISTORY</small></a>
                                        @else
                                            <small>BOOKING HISTORY</small>
                                        @endif
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="{{$pendingBookingCount}}">0</span>
                                        </h3>
                                        @if(Auth::user()->type == 0 || Auth::user()->type == 2)
                                            <a href="{{ route('pendingBookings') }}"><small>PENDING BOOKINGS</small></a>
                                        @else
                                            <small>PENDING BOOKINGS</small>
                                        @endif
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->type == 0)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="{{$totalProviders}}">0</span>
                                        </h3>
                                        <a href="{{ route('providerList') }}"><small>TOTAL PROVIDERS</small></a>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(Auth::user()->type == 1)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <button class="btn btn-wide" onclick="location.href='{{ route('addBookingForm') }}'">Add Booking</button>
                                        <button class="btn btn-wide" onclick="location.href='{{ route('bookingList') }}'">View Booking</button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
        <!-- END PAGE CONTENT BODY -->
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
@endsection
@section('script')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/dashboard.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection
