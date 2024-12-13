<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waterfall extends Model
{
    protected $fillable = ['name', 'height', 'province', 'latitude', 'longitude'];

    public $timestamps = true;

 
}
