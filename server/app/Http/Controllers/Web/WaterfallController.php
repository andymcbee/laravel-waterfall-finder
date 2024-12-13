<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller; 
use App\Models\Waterfall;
use Illuminate\Http\Request;

class WaterfallController extends Controller
{

    public function showWaterfalls()
    {
        $waterfalls = Waterfall::all(); 
        
        return view('waterfalls', ['waterfalls' => $waterfalls]);
    }

    public function showWaterfall($id)
    {
        $waterfall = Waterfall::findOrFail($id);
        
        return view('waterfall', ['waterfall' => $waterfall]);
    }
    
}


