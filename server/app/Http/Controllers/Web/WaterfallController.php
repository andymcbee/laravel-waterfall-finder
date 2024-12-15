<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller; 
use App\Models\Waterfall;
use App\Models\City;
use Illuminate\Http\Request;

class WaterfallController extends Controller
{

    public function showWaterfalls()
    {
        $waterfalls = Waterfall::all();        
        $cities = City::whereHas('waterfalls') // Filter cities with at least one waterfall
              ->withCount('waterfalls') // Include the "waterfalls_count" column
              ->orderByDesc('waterfalls_count') // Sort by the count in descending order
              ->get();




        return view('waterfalls', [
            'waterfalls' => $waterfalls,
            'cities' => $cities,
        ]);
        
    }

    public function showWaterfall($id)
    {
        $waterfall = Waterfall::findOrFail($id);
        
        return view('waterfall', ['waterfall' => $waterfall]);
    }
    
}


