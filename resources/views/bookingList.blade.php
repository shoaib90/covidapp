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
                    <h1>Booking Table</h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <div class="page-content">
            <div class="container">
                <!-- BEGIN PAGE BREADCRUMBS -->
                <ul class="page-breadcrumb breadcrumb">
                    
                </ul>
                @if (Request::path() == 'bookings')
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4">
                            <form method="post" action="{{route('bookingList')}}">
                                @csrf
                                <div class="form-group row">
                                    <input type="text" name="daterange" value=""  id="bookingFilter"/>
                                    <input class="btn btn-primary" type="submit" value="search">
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                <!-- END PAGE BREADCRUMBS -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                         <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-comments"></i>Booking Table </div>
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
                                                <th> Father Name </th>
                                                <th> city </th>
                                                <th> Date </th>
                                                <th> Time </th>
                                                <th> Provider </th>
                                                <th> Status </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($bookings->count() > 0 )
                                                @foreach($bookings as $key => $booking)
                                                <tr>
                                                    <td> {{ $booking->id }} </td>
                                                    <td> {{ $booking->name }} </td>
                                                    <td> {{ $booking->father_name }} </td>
                                                    <td> {{ $booking->city }} </td>
                                                    <td> {{ $booking->booking_date }} </td>
                                                    <td> {{ $booking->booking_time_slot }} </td>
                                                    <td> {{ $booking->bookingProvider->provider->first_name. ' '. $booking->bookingProvider->provider->last_name }} </td>
                                                    <td> @if($booking->booking_status == 0)
                                                            {{ 'Pending'}}
                                                        @elseif($booking->booking_status == 1)
                                                            {{ 'Accepted'}}
                                                        @else 
                                                            {{ 'Rejected'}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if(Auth::user()->type == 0 || Auth::user()->type == 1) 
                                                        @if($booking->booking_status == 0)
                                                            <button type="button" data-id="{{ $booking->id }}" class="btn btn-success open-AddBookDialog" >Accept</button>
                                                            <a href="{{route('rejectBooking',['id'=>$booking->id]) }}" class="btn btn-danger">
                                                            Reject</a>
                                                        @elseif($booking->booking_status == 1 && empty($booking->report))
                                                            <button type="button" data-id="{{ $booking->id }}" class="btn btn-success open-UploadBookReport" >Upload Report</button>
                                                        @elseif(!empty($booking->report))
                                                        <a download href="{{ URL::to('/') . '/uploads/'.$booking->report->file}}" class="btn btn-success">
                                                            Download</a>
                                                        @endif
                                                    @else
                                                        {{ 'N/A' }}
                                                    @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr><td colspan="14"><p>{{ 'No Bookings Found' }}</p></td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                {{ $bookings->appends(request()->input())->links() }}
                            </div>
                            <div class="col-md-6 text-right">
                                Records {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} of {{ $bookings->total() }}
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

<div class="modal fade" id="addBookingDialog" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Fill below Fields</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('acceptBooking') }}" method="POST" id="acceptForm">
                    @csrf
                    <input type="hidden" id="bookingId" name="booking_id">
                    <div class="form-group">
                        <label for="charge" class="col-form-label">Charge</label>
                        <input type="number" class="form-control" id="charge" name="charge" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Comment</label>
                        <textarea class="form-control" id="message-text" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadBookingReport" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Fill below Fields</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('uploadReport') }}" method="POST" id="acceptForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="uploadbookingId" name="booking_id">
                    <div class="form-group">
                        <label for="charge" class="col-form-label">Upload Report</label>
                        <input type="file" class="form-control" name="report" required>
                        @error('file')
                            <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        
        $('input[name="daterange"]').daterangepicker();
        $(document).on("click", ".open-AddBookDialog", function () {
            let myBookId = $(this).data('id');
            $("#bookingId").val( myBookId );
            $('#addBookingDialog').modal('show');
        });
        $(document).on("click", ".open-UploadBookReport", function () {
            let myBookId = $(this).data('id');
            $("#uploadbookingId").val( myBookId );
            $('#uploadBookingReport').modal('show');
        });
        
        function acceptBookingRequest()
        {

        }
    </script>
@endsection
