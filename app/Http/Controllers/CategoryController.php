<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Subcategory;

class CategoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	function index(){
		$category = Category::latest()->paginate(5, ['*'], 'category');
		$deletedCat = Category::onlyTrashed()->latest()->paginate(5, ['*'], 'deletedCat');
		return view("category/category", compact("category", "deletedCat"));
	}
	function single($id){
		$category = Category::latest()->paginate(3);
		return view("category/category", compact("category"));
	}
	function insert(Request $request){
		$request->validate(
			[
				'name' => 'required|unique:categories,name|string|max:225', 
				'title' => 'required|unique:categories,title'
			],
			[
				'name.required' => 'name catagory not empty',
				'name.unique' => 'your name catagory alrady in database',
				'title.required' => 'title catagory not empty',
				'title.unique' => 'your title catagory alrady in database'
			],
		);
		Category::insert([
			"name" => $request->name,
			"title" => $request->title,
			"user" => auth::id(),
			"created_at" => Carbon::now()
		]);
		return back()->with("alert", "insert done....");
	}
	function update_function($id, Request $request){
		Category::find($id)->update([
			'name' => $request->name,
			'title' => $request->title,
		]);
		return back()->with("alert", "update done....");
	}
	function remove_function($id){
		Category::find($id)->forceDelete();
		return back()->with("alert", "insert done....");
	}
	function softdelete_function($id){
		Category::find($id)->delete();
		Subcategory::where('category', $id)->delete();
		return back()->with("alert", "insert done....");
	}
	function mark_softdelete_function(Request $request){
		foreach($request->id as $idkey => $idvalue){
			Category::find($idvalue)->delete();
		}
		return back()->with("alert", "insert done....");
	}
	function restore_function($id){
		# দুইটা function একই কাজ করে।
		//Category::withTrashed()->find($id)->restore();
		Category::onlyTrashed()->find($id)->restore();
		return back()->with("alert", "insert done....");
	}
	function alldelete_function(){
		Category::whereNotNull('id')->delete();
		return back()->with("alert", "insert done....");
	}
}
