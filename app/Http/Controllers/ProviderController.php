<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Http\Requests\ProviderRequest;
use App\Http\Requests\ProviderEditRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Provider;

class ProviderController extends Controller
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
        $providers = Provider::whereHas('user', function (Builder $query) {
            $query->where('status', '1');
        })->with('user')->paginate($this->paginate);
        return view('providerList', compact('providers'));
    }

    public function addForm(Request $request)
    {
        $country = Country::getAllCountries();
        $providerId = 0;
        return view('addProvider', compact('country','providerId'));
    }

    public function store(ProviderRequest $request)
    {
        $userData = $request->except(['clinic_name', 'country', 'state', 'city']);
        $userData['password'] = Hash::make($userData['password']);
        $userData['type'] = User::PROVIDER;
        $userData['token'] = User::TOKEN_PREFIX.mt_rand(10000, 99999);
        $user = User::create($userData);
        if(isset($user->id) && !empty($user->id)) {
            $provider = $request->only(['clinic_name', 'country', 'state', 'city', 'address', 'pin_code']);
            $provider['user_id'] = $user->id;
            Provider::create($provider);
            return redirect()->route('providerList');
        }
    }

    public function deleteProvider(Request $request, $id)
    {
        $provider = Provider::select('id', 'user_id')->where('id', $id)->first();
        $userId = $provider->user_id;
        if ($provider->delete()) {
            User::where('id', $userId)->update(['status' => 0]);
            return redirect()->route('providerList');
        }
    }

    public function edit(Request $request, $id) 
    {
        $provider = User::select(['users.*','providers.user_id', 'clinic_name', 'address', 'city','state','country', 'pin_code'])->join('providers', 'users.id','=', 'providers.user_id')->where('users.id', $id)->first();
        $country = Country::getAllCountries();
        $providerId = $provider->user_id;
        return view('addProvider', compact('country','providerId', 'provider'));
    }

    public function updateProvider(ProviderEditRequest $request)
    {
        $userData = $request->only(['first_name','last_name', 'phone_number']);
        User::where('id', $request->input('user_id'))->update($userData);
        if($request->input('user_id') != "") {
            $provider = $request->only(['clinic_name','address', 'pin_code']);
            Provider::where('user_id', $request->input('user_id'))->Update($provider);
            return redirect()->route('providerList');
        }
    }
}
