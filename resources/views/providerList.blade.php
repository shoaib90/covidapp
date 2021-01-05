@extends('layouts.app')

@section('content')
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="container">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Basic Datatables
                        <small>basic datatable samples</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <div class="page-content">
            <div class="container">
                <!-- BEGIN PAGE BREADCRUMBS -->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">More</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">Tables</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Static Tables</span>
                    </li>
                </ul>
                <!-- END PAGE BREADCRUMBS -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                         <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-comments"></i>Provider Table </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                    <a href="javascript:;" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th>Name </th>
                                                <th>Email </th>
                                                <th> Phone Number </th>
                                                <th> Address </th>
                                                <th> city </th>
                                                <th> Clinic Name </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($providers->count() > 0 )
                                                @foreach($providers as $key => $provider)
                                                <tr>
                                                    <td> {{ $provider->id }} </td>
                                                    <td> {{ $provider->user->first_name. ' '. $provider->user->last_name  }} </td>
                                                    <td> {{ $provider->user->email }} </td>
                                                    <td> {{ $provider->user->phone_number }} </td>
                                                    <td> {{ $provider->address }} </td>
                                                    <td> {{ $provider->city }} </td>
                                                    <td> {{ $provider->clinic_name }} </td>
                                                    <td> 
                                                        <a href="{{route('editProvider',['id'=> $provider->user_id ])}}" class="btn btn-success">Edit</a>
                                                        
                                                        <a href="{{route('deleteProvider',['id'=> $provider->id ])}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this provider ?')">
                                                            Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <p>{{ 'No Providers Found' }}</p>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                {{ $providers->appends(request()->input())->links() }}
                            </div>
                            <div class="col-md-6 text-right">
                                Records {{ $providers->firstItem() }} - {{ $providers->lastItem() }} of {{ $providers->total() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>
@endsection