<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Cupon;

class CuponController extends Controller
{
   function index_function(){
	   return view('product/cupon', [
		'cupons' => Cupon::all()
	   ]);
   }
   function insert_function(Request $request){
	   $request->validate([
			'name' => 'required|unique:cupons,name', 
			'percent' => 'required|integer|max:99|min:1', 
		]);
		#যখন form input name আর data base table এক নামের হয় তখন এই ফুঞ্চতিওন ব্যভার করা যায়।
	   Cupon::insert($request->except('_token', 'insert')+["created_at" => Carbon::now()]);
	   return back()->with("alert", "coupon insert done....");
   }
}
