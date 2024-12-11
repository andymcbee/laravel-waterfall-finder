<?php

namespace App\Http\Controllers;

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
