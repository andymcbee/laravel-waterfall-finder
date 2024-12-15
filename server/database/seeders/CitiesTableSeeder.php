<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use League\Csv\Reader;
use App\Models\City;


class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        // Truncate the existing cities to avoid duplicate entries
        DB::table('cities')->truncate();

        $csv = Reader::createFromPath(storage_path('app/csv/cities.csv'), 'r');
        $csv->setHeaderOffset(0); // Set the CSV header offset to read headers as array keys

        $records = $csv->getRecords(); // Get all records from the CSV
        foreach ($records as $record) {

            $slug = Str::slug($record['name'], '-');

            $originalSlug = $slug;   // Keep the original slug to append numbers if needed

            // Check for uniqueness and modify if needed
            $counter = 1;
            while (City::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter; // Append counter
                $counter++;
            }

            DB::table('cities')->insert([
                'name' => $record['name'],
                'slug' => $slug,
                'id_csc' => $record['id'],
                'state_name' => $record['state_name'],
                'state_code' => $record['state_code'],
                'country_name' => $record['country_name'],
                'country_code' => $record['country_code'], 
                'latitude' => $record['latitude'],
                'longitude' => $record['longitude'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
