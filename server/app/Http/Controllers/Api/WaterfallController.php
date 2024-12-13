<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use App\Models\Waterfall;
use Illuminate\Http\Request;

class WaterfallController extends Controller
{
    public function index()
    {
        $waterfalls = Waterfall::all();
        return response()->json($waterfalls);
    }

}


