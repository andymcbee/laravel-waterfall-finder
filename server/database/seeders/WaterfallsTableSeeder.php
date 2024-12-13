<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use League\Csv\Reader;

class WaterfallsTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('waterfalls')->truncate();

        $csv = Reader::createFromPath(storage_path('app/csv/waterfalls.csv'), 'r');
        $csv->setHeaderOffset(0); // Set the CSV header offset to read headers as array keys

        $records = $csv->getRecords(); // Get all records from the CSV
        foreach ($records as $record) {
            DB::table('waterfalls')->insert([
                'name' => $record['name'],
                'city' => $record['city'],
                'state' => $record['state'],
                'country' => $record['country'],
                'country_code' => $record['country_code'],
                'latitude' => $record['latitude'],
                'longitude' => $record['longitude'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
