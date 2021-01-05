<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth','permissions']], function ()
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/add-booking', 'BookingController@addForm')->name('addBookingForm');
    Route::post('/add-booking', 'BookingController@storeBooking')->name('addBooking');
    Route::post('/accept-booking', 'BookingController@acceptBooking')->name('acceptBooking');
    Route::get('/reject-booking/{id}', 'BookingController@rejectBooking')->name('rejectBooking');
    Route::any('/bookings', 'BookingController@index')->name('bookingList');
    Route::get('/add-provider', 'ProviderController@addForm')->name('addProvider');
    Route::post('/add-provider', 'ProviderController@store')->name('addProvider');
    Route::get('/providers', 'ProviderController@index')->name('providerList');
    Route::get('/provider/{id}/edit', 'ProviderController@edit')->name('editProvider');
    Route::post('/updateProvider', 'ProviderController@updateProvider')->name('updateProvider'); 
    Route::get('/provider/delete/{id}', 'ProviderController@deleteProvider')->name('deleteProvider');
    Route::get('/get-states/{countryId}', 'BookingController@getCountryStates');

    Route::post('/upload-report', 'BookingController@uploadReport')->name('uploadReport');
    
    Route::get('/get-pending-bookings', 'BookingController@pendingBooking')->name('pendingBookings');
    Route::get('/get-booking-history', 'BookingController@historyBooking')->name('historyBookings');

    //payu payment gateway routes
    # Call Route
    Route::get('/paymentform', 'PayuController@create')->name('create');

    # Status Route
    // Route::get('payment/status', ['as' => 'payment.status', 'uses' => 'PayuController@status']);

});
