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
                        <h1>Add Provider</h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE CONTENT BODY -->
            <div class="page-content">
                <div class="container">
                    <!-- BEGIN PAGE CONTENT INNER -->
                    <div class="page-content-inner">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Add Provider 
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                @if(empty($providerId))
                                    <form action="{{ route('addProvider') }}" method="POST" class="horizontal-form">
                                @else
                                    <form action="{{ route('updateProvider') }}" method="POST" class="horizontal-form">
                                @endif
                                    @csrf
                                    <input type="hidden" name="user_id", value="{{ $providerId }}">
                                    <div class="form-body">
                                        <h3 class="form-section">Provider Info</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group @error('first_name') has-error @enderror">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" id="firstName" name="first_name" class="form-control" placeholder="Please enter first name" value="{{ old('first_name', isset($provider) ? $provider->first_name : '') }}">
                                                    @error('first_name')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group @error('last_name') has-error @enderror">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" id="last_name" class="form-control" placeholder="Please enter last name" name="last_name" value="{{ old('last_name', isset($provider) ? $provider->last_name : '') }}">
                                                    @error('last_name')
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
                                                <div class="form-group @error('phone_number') has-error @enderror">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="text" id="last_name" class="form-control" placeholder="Please enter Phone Number" name="phone_number" value="{{ old('phone_number', isset($provider) ? $provider->phone_number : '') }}">
                                                    @error('phone_number')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--/span-->
                                            @if(empty($provider))
                                            <div class="col-md-6">
                                                <div class="form-group @error('email') has-error @enderror">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" id="email" class="form-control" placeholder="Please enter email" name="email"  value="{{ old('email', isset($provider) ? $provider->email : '') }}">
                                                    @error('email')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <!--/span-->
                                            <div class="col-md-6">
                                                @if(empty($provider))
                                                    <div class="form-group @error('password') has-error @enderror">
                                                        <label class="control-label">Password</label>
                                                        <input type="password" id="password" class="form-control" placeholder="Please enter password" name="password">
                                                        @error('password')
                                                            <span class="help-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                @endif
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group @error('clinic_name') has-error @enderror">
                                                    <label class="control-label">Clinic Name</label>
                                                    <input type="text" id="clinic_name" class="form-control" placeholder="Please enter Clinic Name" name="clinic_name"  value="{{ old('clinic_name', isset($provider) ? $provider->clinic_name : '') }}">
                                                    @error('clinic_name')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="form-section">Address Details</h3>
                                        @if(empty($provider))
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group @error('country') has-error @enderror">
                                                        <label class="control-label">Select Country</label>
                                                        <select class="form-control" onchange="getStates()" id="country_id" name="country">
                                                        <option value="">{{ ('Select Country') }}</option>
                                                            @foreach($country as $countryId => $country)
                                                            <option value="{{ $countryId }} " >{{ $country }}</option>
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
                                        @endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group @error('city') has-error @enderror">
                                                    <label class="control-label">Select City</label>
                                                    <input type="text" class="form-control" placeholder="Please enter city" name="city" value="{{ old('city', isset($provider) ? $provider->city : '') }}"> 
                                                    @error('city')
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pin Code</label>
                                                    <input type="text" class="form-control" placeholder="Please enter pin code" name="pin_code" value="{{ old('pin_code', isset($provider) ? $provider->pin_code : '') }}"> 
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group @error('address') has-error @enderror">
                                                    <label class="control-label">Address</label>
                                                    <input type="text" class="form-control" placeholder="Please enter address" name="address" value="{{ old('address', isset($provider) ? $provider->address : '') }}"> 
                                                    @error('address')
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