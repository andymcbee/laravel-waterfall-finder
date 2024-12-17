<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityWaterfallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the table first to avoid duplicates (optional)
        DB::table('city_waterfalls')->truncate();

        // Raw SQL for the insert operation
        DB::statement('
            INSERT INTO city_waterfalls (city_id, waterfall_id, distance_km)
            SELECT
                c.id AS city_id,
                w.id AS waterfall_id,
                ST_Distance(c.geom::geography, w.geom::geography) / 1000 AS distance_km
            FROM
                cities c
            CROSS JOIN
                waterfalls w
            WHERE
                ST_DWithin(c.geom::geography, w.geom::geography, 100000) -- 100km in meters
        ');
    }
}
