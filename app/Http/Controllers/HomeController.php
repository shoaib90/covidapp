<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Booking;
use App\User;
use Auth;

class HomeController extends Controller
{
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
    public function index()
    {
        $data['totalProviders'] = 0;
        if(Auth::user()->type == USER::CUSTOMER) {
            $data['bookingHistoryCount'] = Booking::where('user_id', Auth::user()->id)->where(function ($query) {
                $query->where('booking_status', 1)->orWhere('booking_status', '=', 2);
            })->get()->count();
            $data['pendingBookingCount'] = Booking::where('booking_status', 0)->where('user_id', Auth::user()->id)->get()->count();
        } elseif(Auth::user()->type == USER::PROVIDER) {
            $data['bookingHistoryCount'] = Booking::whereHas('bookingProvider', function($q) {
                $q->where('user_id', Auth::user()->id);
            })->where(function ($query) {
                $query->where('booking_status', 1)->orWhere('booking_status', '=', 2);
            })->get()->count();
            $data['pendingBookingCount'] = Booking::where('booking_status', 0)
            ->whereHas('bookingProvider', function($q) {
                $q->where('user_id', Auth::user()->id);
            })
            //->where('user_id', Auth::user()->id)
            ->get()->count();
        }else {
            $data['bookingHistoryCount'] = Booking::where('booking_status', 1)->orWhere('booking_status', 2)->get()->count();
            $data['pendingBookingCount'] = Booking::where('booking_status', 0)->get()->count();
            $data['totalProviders'] = User::join('providers', 'users.id','=','providers.user_id')->where('type', User::PROVIDER)->get()->count();
        }
        return view('home', $data);
    }
}
