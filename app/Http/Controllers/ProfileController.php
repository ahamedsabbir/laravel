<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use auth;
use Hash;
use Image;

class ProfileController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	function index_function(){
		return view("profile");
	}
	function password_edit_function($id, Request $request){
		$request->validate([
			'old_password' => 'required',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
		]);
		if(preg_match("@[A-Z]@", $request->password) AND preg_match("@[a-z]@", $request->password) AND preg_match("@[0-9]@", $request->password)){
			# এখানে Hash class টা old 
			if(Hash::check($request->old_password, auth::User()->password)){
				User::find($id)->update([
					'password' => bcrypt($request->password)
				]);
				return back()->with('success', 'password change done.');
			}else{
				return back()->with('error', 'old password not match on database');
			}
		}else{
			return back()->with('error', 'password one upper case and one lower case and number too');
		}
	}
	function photo_edit_function($id, Request $request){
		$request->validate([
			'profile_photo' => 'required|image|file|max:5120|mimes:jpg,bmp,png|dimensions:min_width=100,min_height:200'
		]);
		if(Auth::user()->photo != "default.jpg"){
			unlink(public_path()."/upload/user/".Auth::user()->photo);
		}
		$file_temp = $request->file('profile_photo');
		$file_name = rand(9999, 1000).".".$file_temp->getClientOriginalExtension();
		$img = Image::make($file_temp)->save(base_path("public/upload/user/".$file_name));
		User::find($id)->update([
			'photo' => $file_name
		]);
		return back()->with('success', 'photo update');
	}
}
