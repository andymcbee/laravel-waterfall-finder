<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waterfall extends Model
{
    protected $fillable = ['name', 'height', 'province', 'location'];

    public $timestamps = true;

    /**
     * Define the casts for the properties.
     */
    protected $casts = [
        'location' => 'array', // To handle the geometry data
    ];
}
