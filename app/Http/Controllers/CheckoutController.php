<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cupon;
use App\Models\Country;
use App\Models\City;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Checkout;
use Carbon\Carbon;
use Str;
use Auth;
use Cookie;

class CheckoutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	function index_function(){
		return view("product/checkout", [
			'countries' => Country::select('name', 'id')->get(),
			//'cities' => City::select('name', 'id', 'country_id')->get(),
		]);
	}
	function payment_function(Request $request){
		if($request->paymentMethod == 1){
			return redirect()->route('checkoutcompleteonline');
		}else{
			return redirect()->route('checkoutcompleteoffline');
		}
	}
	function offline_payment_function(Request $request){
		if($request->paymentMethod == 1){
			return redirect()->route('checkoutcompleteonline');
		}else{
			$unique_id_generate = Str::random(40).date('Ymd').time();
			$address = Country::find($request->country)->name.", ".City::find($request->city)->name.", ".$request->zip.", ".$request->address;
			$checkout = Checkout::insertGetId([
				'user_id' => Auth::id(),
				'unique' => $unique_id_generate,
				'total' => session('total'),
				'discount' => session('discount'),
				'subtotal' => session('total')-session('discount'),
				'address' => $address,
				'notes' => $request->notes,
				'method' => $request->method,
				'payment' => 0,
				"created_at" => Carbon::now()
			]);
			$cart_item = Cart::where('unique', Cookie::get('unique'))->get();
			foreach($cart_item as $cart_key => $cart_value){
				$order = Order::insert([
					'user_id' => Auth::id(),
					'checkout_id' => $checkout,
					'unique' => $unique_id_generate,
					'product_id' => $cart_value->product_id,
					'quantity' => $cart_value->amount,
					"created_at" => Carbon::now()
				]);
				Product::find($cart_value->product_id)->update([
					'quantity' => Product::find($cart_value->product_id)->first()->quantity-$cart_value->amount
				]);
			}
			if($order){
				Cart::where('unique', Cookie::get('unique'))->delete();
				//return view("product/checkout")->with('success', 'order done');
				//return redirect()->route('home');
				return redirect('home');
			}else{
				//return view("product/checkout")->with('error', 'order not done');
			}
		}
	}
	function online_payment_function(Request $request){
		
	}
	
}
