<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Carbon\Carbon;
use App\Models\Category;

class CategoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	function index(){
		$category = Category::latest()->paginate(3);
		$deletedCat = Category::onlyTrashed()->latest()->paginate(3);
		return view("category/category", compact("category", "deletedCat"));
	}
	function insert(Request $request){
		$request->validate([
			'name' => 'required|unique:categories,name'
		],[
			'name.required' => 'catagory not empty'
		]);
		Category::insert([
			"name" => $request->name,
			"user" => auth::id(),
			"created_at" => Carbon::now()
		]);
		return back()->with("alert", "insert done....");
	}
	function update(Request $request){
		return back()->with("alert", "insert done....");
	}
	function remove($id){
		Category::find($id)->delete();
		return back()->with("alert", "insert done....");
	}
	function delete($id){
		Category::find($id)->delete();
		return back()->with("alert", "insert done....");
	}
	function markDelete(Request $request){
		Category::find($id)->delete();
		return back()->with("alert", "insert done....");
	}
	function allDelete($id){
		Category::find($id)->delete();
		return back()->with("alert", "insert done....");
	}
}
