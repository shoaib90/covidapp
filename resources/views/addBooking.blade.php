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
                        <h1>Add Booking</h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE CONTENT BODY -->
            <div class="page-content">
                <div class="container">
                    <!-- BEGIN PAGE BREADCRUMBS -->
                    
                    <!-- END PAGE BREADCRUMBS -->
                    <!-- BEGIN PAGE CONTENT INNER -->
                    <div class="page-content-inner">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Add Bookings 
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{ route('addBooking') }}" class="horizontal-form" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <h3 class="form-section">{{ __('Patient Info') }}</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group @error('name') has-error @enderror">
                                                    <label for="name" class="control-label">{{ __('Name') }}</label>
                                                    <input type="text" id="name" class="form-control " placeholder="Please enter patient name" name="name">
                                                    @error('name')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group @error('father_name') has-error @enderror">
                                                    <label for="father_name" class="control-label">{{ __('Father Name') }}</label>
                                                    <input type="text" id="father_name" class="form-control" placeholder="Please enter patient Father name" name="father_name">
                                                    @error('father_name')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group @error('gender') has-error @enderror">
                                                    <label for="gender" class="control-label">Gender</label>
                                                    <select class="form-control" name="gender">
                                                        <option value="">Select Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                    @error('gender')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group @error('dob') has-error @enderror">
                                                    <label class="control-label">Date of Birth</label>
                                                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" name='dob'> 
                                                    @error('dob')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <h3 class="form-section">Address Details</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group @error('country') has-error @enderror">
                                                    <label class="control-label">Select Country</label>
                                                    <select class="form-control" onchange="getStates()" id="country_id" name="country">
                                                    <option value="">{{ ('Select Country') }}</option>
                                                        @foreach($country as $countryId => $country)
                                                        <option value="{{$countryId}}">{{ $country }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group @error('state') has-error @enderror">
                                                    <label class="control-label">Select State</label>
                                                    <select class="form-control" id="state_id" name="state">
                                                        <option value="">{{ ('Select State') }}</option>
                                                    </select>
                                                    @error('state')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group @error('city') has-error @enderror">
                                                    <label class="control-label">Select City</label>
                                                    <input type="text" class="form-control" placeholder="Please enter city" name="city"> 
                                                    @error('city')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group @error('pin_code') has-error @enderror">
                                                    <label>Pin Code</label>
                                                    <input type="text" class="form-control" placeholder="Please enter pin code" name="pin_code">
                                                    @error('pin_code')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <h3 class="form-section">Provider Details</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group @error('provider') has-error @enderror">
                                                    <label class="control-label">Select Provider</label>
                                                    <select class="form-control" name="provider">
                                                    <option value="">{{ ('Select Provider') }}</option>
                                                        @foreach($providers as $key=> $provider) 
                                                            <option value="{{$key}}">{{ $provider }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('provider')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group @error('booking_date') has-error @enderror">
                                                    <label class="control-label">Select Booking Date</label>
                                                    <div class="input-group date form_datetime">
                                                        <input type="text" size="16" readonly class="form-control" name="booking_date">
                                                        <span class="input-group-btn">
                                                            <button class="btn default date-set" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    @error('provider')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions right">
                                        <button type="button" class="btn default">Cancel</button>
                                        <button type="submit" class="btn blue">
                                            <i class="fa fa-check"></i> Save</button>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
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
@section('css')
<link href="{{ asset('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('script')
<script src="{{ asset('plugins/components-date-time-pickers.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
@endsection