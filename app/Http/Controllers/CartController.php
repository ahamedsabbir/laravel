<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Cupon;
use Carbon\Carbon;
use Str;
use Cookie;

class CartController extends Controller
{
    function index_function($name = false){
		if($name != false and Cupon::where('name', $name)->exists() and Carbon::now()->format('Y-m-d') < Cupon::where('name', $name)->first()->validity){
			$discount = Cupon::where('name', $name)->first()->percent;
		}else{
			$discount = 1;
		}
		return view("product/cart", [
			'discount' => $discount,
			'carts' => Cart::where('unique', Cookie::get('unique'))->get()
		]);
	}
	function add_function($id, Request $request){
		if(Cookie::get('unique')){
			$unique = Cookie::get('unique');
		}else{
			$unique = Str::random(45).time();
			Cookie::queue(Cookie::make('unique', $unique, 10800));
		}
		if(Cart::where('unique', $unique)->where('product_id', $id)->exists()){
			Cart::where('unique', $unique)->where('product_id', $id)->increment('amount', $request->amount);
		}else{
			Cart::insert([
				'unique' => $unique,
				'product_id' => $id,
				'amount' => $request->amount,
				"created_at" => Carbon::now()
			]);
		}
		return back()->with("success", "cart add done....");
	}
}
