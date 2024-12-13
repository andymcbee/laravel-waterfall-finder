<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use League\Csv\Reader;

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
            DB::table('cities')->insert([
                'name' => $record['name'],
                'id_csc' => $record['id'],
                'state_name' => $record['state_name'],
                'state_code' => $record['state_code'],
                'country_name' => $record['country_name'],
               // 'country_code' => $record['country_code'], 
                'latitude' => $record['latitude'],
                'longitude' => $record['longitude'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
