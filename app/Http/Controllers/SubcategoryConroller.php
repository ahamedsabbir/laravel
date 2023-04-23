<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryConroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	function index(){
		$category = category::get();
		$subcategory = Subcategory::simplePaginate(3);
		return view("category/subcategory", compact("category", "subcategory"));
	}
	function insert(Request $request){
		$request->validate([
			'category' => 'required',
			'name' => 'required|unique:subcategories,name'
		],[
			'name.required' => 'catagory not empty'
		]);
		if(Subcategory::where('category', $request->category)->where('name', $request->name)){
			return back()->with("alert", "insert done....");
		}else{
			Subcategory::insert([
				"name" => $request->name,
				"category" => $request->category,
				"user" => auth::id(),
				"created_at" => Carbon::now()
			]);
			return back()->with("alert", "insert done....");
		}
		
	}
	function update(Request $request){
		return back()->with("alert", "insert done....");
	}
	function remove($id){
		Subcategory::find($id)->delete();
		return back()->with("alert", "insert done....");
	}
	function markDelete(Request $request){
		/*if($request->id){
			foreach($request->id as $idkey){
				Subcategory::find($id)->delete();
				return back()->with("alert", "insert done....");
			}	
		}else{
			return back()->with("alert", "insert done....");
		}*/
	}
	function allDelete($id){
		Subcategory::find($id)->delete();
		return back()->with("alert", "insert done....");
	}
}
