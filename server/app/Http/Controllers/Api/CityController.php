<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $cities = City::where('name', 'ILIKE', '%' . $searchTerm . '%')->get();
        //$cities = City::all();
        return response()->json($cities);
    }
}
