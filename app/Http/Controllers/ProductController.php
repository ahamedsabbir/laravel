<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Thumbnail;
use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;
use auth;
use Image;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	function index_function(){
		return view('product/product', [
			'products' => Product::latest()->paginate(5, ['*'], 'products'),
			'category' => Category::get(),
			'subcategory' => Subcategory::get()
		]);
	}
	function insert_function(Request $request){
		$request->validate([
			'name' => 'required|unique:products,name'
		]);
		$file_temp = $request->file('photo');
		$file_name = date('dmY').'_'.rand(999999, 100000).".".$file_temp->getClientOriginalExtension();
		$img = Image::make($file_temp)->resize(15, 15)->save(base_path("public/upload/product/".$file_name));
		Product::insert([
			"name" => $request->name,
			"description" => $request->description,
			"price" => $request->price,
			"category" => $request->category,
			"sub_category" => $request->sub_category,
			"quantity" => $request->quantity,
			"photo" => $file_name,
			"created_at" => Carbon::now()
		]);
		$product_id = Product::where('name', $request->name)->first()->id;
		foreach($request->file('thumbnail') as $thumble){
			$file_name = date('dmY').'_'.rand(999999, 100000).".".$thumble->getClientOriginalExtension();
			$img = Image::make($thumble)->save(base_path("public/upload/thumbnail/".$file_name));
			Thumbnail::insert([
				"product_id" => $product_id,
				"name" => $file_name
			]);
		}
		return back()->with('success', "product insert done");
	}
	function single_function($id){
		$cat_id = Product::find($id)->category;
		return view('product/single', [
			'products' => Product::find($id),
			'category' => Category::all(),
			'subcategory' => Subcategory::all(),
			'related_product' => Product::where('category', $cat_id)->where('id', '!=', $id)->get()
		]);
	}
	function category_function($id){
		return view('product/category', [
			'products' => Product::where('category', $id)->get()
		]);
	}
	function search_function(){
		$keyword = $_GET['keyword']
		return view('search', [
			"products" = Product::where("name", "like", "%$keyword%")->get();
		]);
	}
	function delete_function($id){
		foreach(Thumbnail::where('product_id', $id)->get() AS $thumbnail){
			unlink(public_path()."/upload/thumbnail/".$thumbnail->name);
		}
		unlink(public_path()."/upload/product/".Product::find($id)->photo);
		Product::find($id)->delete();
		return back()->with('success', "product delete done");
	}
}
