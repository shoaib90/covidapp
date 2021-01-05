<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\Booking;
use App\BookingProvider;
use App\Report;
use App\Http\Requests\BookingRequest;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    protected $paginate = 50; 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $startDate ='';
        $endDate = '';
        if ($request->isMethod('post')) {
            if ($request->input('daterange') != "") {
                $dateRange = explode("-", $request->input('daterange'));
                $startDate = carbon::parse($dateRange[0])->format('Y-m-d');
                $endDate = carbon::parse($dateRange[1])->format('Y-m-d'); 
            }
        }
        $booking = Booking::with('bookingProvider','bookingProvider.provider', 'report');
        if (isset($startDate) && !empty($endDate)) {
            $booking->whereBetween('booking_date', [$startDate, $endDate]);  
        }
        if (Auth::user()->type == User::CUSTOMER) {
            $booking->where('user_id', Auth::user()->id)->orderBy('id', 'desc');
            if (isset($startDate) && !empty($endDate)) {
                $bookings = $booking->whereBetween('booking_date', [$startDate, $endDate]);  
            }
        } else if(Auth::user()->type == User::PROVIDER) {
            $booking->whereHas('bookingProvider', function($q) {
                $q->where('user_id', Auth::user()->id);
            });
        }
        $bookings = $booking->orderBy('id', 'desc')->paginate($this->paginate);
        return view('bookingList', compact('bookings'));
    }

    public function addForm()
    {
        $country    = Country::getAllCountries();
        $providers  = User::where('type', User::PROVIDER)->pluck('first_name', 'id');
        return view('addBooking', compact('country','providers'));
    }

    public function getCountryStates(Request $request, $countryId)
    {
        $option = '';
        $states = Country::getCountryState($countryId);
        if (count($states) > 0) {
            foreach($states as $key => $state) {
                $option .= '<option value='.$key.'>'. $state.'</option>';
            }
        }
        return $option;
    }

    public function storeBooking(BookingRequest $request)
    {
        $records = $request->except('provider');
        $records['user_id'] = Auth::user()->id;
        if (isset($records['booking_date']) && !empty($records['booking_date'])) {
            $bookingDate = explode('-',$records['booking_date']);
            $records['booking_date'] = Carbon::parse($bookingDate[0])->format('Y-m-d');
            $records['booking_status'] = Booking::BOOKING_PENDING;
            $records['booking_time_slot'] = $bookingDate[1];
        }
        $bookingId = Booking::create($records)->id;
        BookingProvider::create([
            'booking_id' => $bookingId,
            'user_id' => $request->input('provider') 
        ]);
        return redirect()->route('bookingList');
    }

    public function acceptBooking(Request $request)
    {
        if($request->input('booking_id')){
            Booking::where('id', $request->input('booking_id'))->update(['booking_status'=> Booking::BOOKING_ACCEPTED]);
            $bookingProvider = BookingProvider::where('booking_id', $request->input('booking_id'))->first();
            $bookingProvider->charges = $request->input('charge');
            $bookingProvider->comment = $request->input('comment');
            $bookingProvider->save();
            return redirect()->route('bookingList');
        }
    }

    public function rejectBooking(Request $request, $id)
    {
        Booking::where('id', $id)->update(['booking_status'=> Booking::BOOKING_DECLINED]);
        return redirect()->route('bookingList');
    }

    public function uploadReport(Request $request)
    {
        $fileName = time().'.'.$request->report->extension();  
        $request->report->move(public_path('uploads'), $fileName);
        $bookingProvider = BookingProvider::where('booking_id', $request->input('booking_id'))->first();
        Report::create([
            'booking_id' => $request->input('booking_id'),
            'provider_id'=> $bookingProvider->user_id,
            'file' => $fileName
        ]);
        return redirect()->route('bookingList');
    }

    public function pendingBooking(Request $request)
    {
        if (Auth::user()->type == 2) {
            $booking = Booking::where('booking_status', Booking::BOOKING_PENDING)
            ->whereHas('bookingProvider', function($q) {
                $q->where('user_id', Auth::user()->id);
            });
        } else {
            $booking = Booking::where('booking_status', Booking::BOOKING_PENDING);
        }
        $bookings = $booking->orderBy('id', 'desc')->paginate($this->paginate);
        return view('bookingList', compact('bookings'));
    }

    public function historyBooking(Request $request)
    {
        if (Auth::user()->type == 2) {
            $booking = Booking::where('booking_status', Booking::BOOKING_ACCEPTED)->where('booking_status', Booking::BOOKING_DECLINED)->whereHas('bookingProvider', function($q) {
                $q->where('user_id', Auth::user()->id);
            });
        } else {
            $booking = Booking::where('booking_status', Booking::BOOKING_ACCEPTED)->orwhere('booking_status', Booking::BOOKING_DECLINED);
        }
        $bookings = $booking->orderBy('id', 'desc')->paginate($this->paginate);
        return view('bookingList', compact('bookings'));
    }
}
