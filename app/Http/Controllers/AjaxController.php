<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class AjaxController extends Controller
{
    function getCityData(Request $request){
		$cities = City::where('country_id', $request->country_id)->get();
		$ajax_send_data = "<option>select<option>";
		foreach($cities as $citiesKey => $citiesValue){
			$ajax_send_data .= "<option value='{$citiesValue->id}'>{$citiesValue->name}</option>";
		}
		echo $ajax_send_data;
	}
}
