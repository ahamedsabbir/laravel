<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use Carbon\Carbon;
use Auth;


class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	function index_function(){
		return view('product/payment', [
			'unpaidPayment' => Checkout::where('payment', 0)->get()
		]);
	}
}
