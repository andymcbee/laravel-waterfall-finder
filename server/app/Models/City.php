<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'height', 'province', 'latitude', 'longitude'];

    public $timestamps = true;

    public function waterfalls()
    {
        return $this->belongsToMany(Waterfall::class, 'city_waterfalls')
                    ->withPivot('distance_km');
    }
}
