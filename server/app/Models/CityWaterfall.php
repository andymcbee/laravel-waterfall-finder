<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityWaterfall extends Model
{
    // Define the table name if it does not follow Laravel's plural naming convention
    protected $table = 'city_waterfalls';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'city_id',
        'waterfall_id',
        'distance_km',
    ];

    // Indicates whether the model should be timestamped
    public $timestamps = false;

    /**
     * Define the relationship with the City model.
     * A city_waterfall belongs to a city.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Define the relationship with the Waterfall model.
     * A city_waterfall belongs to a waterfall.
     */
    public function waterfall()
    {
        return $this->belongsTo(Waterfall::class);
    }
}
