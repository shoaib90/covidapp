<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Tzsk\payu\PayuGateway;
use Tzsk\payu\Controller\PaymentController;

class PayuController extends Controller
{
    public function create(Request $request){

    	// $payu = new PayuGateway();
    	// return $payu->make();
    	echo "Whats good";
    	die();
    	// $payu = new PaymentController();
    	// return $payu->index($request);
    }
}
