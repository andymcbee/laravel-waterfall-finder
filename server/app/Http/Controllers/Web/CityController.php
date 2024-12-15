<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller; 
use App\Models\Waterfall;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function show(Request $request)
    {
        $countryName = $request->route('country_name');
        $slug = $request->route('slug');

        $city = City::where('slug', $slug)->firstOrFail();

        $waterfalls = $city->waterfalls;
        
        return view('city', [
            'city' => $city, 
            'waterfalls' => $waterfalls
        ]);

    }
}
