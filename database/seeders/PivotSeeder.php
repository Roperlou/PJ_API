<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bus_driver')->insert([
            ['bus_id' => '1',
            'driver_id' => '1'],

            ['bus_id' => '3',
            'driver_id' => '1'],

            ['bus_id' => '4',
            'driver_id' => '1'],

            ['bus_id' => '1',
            'driver_id' => '2'],

            ['bus_id' => '2',
            'driver_id' => '2'],

            ['bus_id' => '4',
            'driver_id' => '3'],

            ['bus_id' => '5',
            'driver_id' => '3'],

            ['bus_id' => '2',
            'driver_id' => '4'],

            ['bus_id' => '3',
            'driver_id' => '4'],

            ['bus_id' => '1',
            'driver_id' => '5'],

            ['bus_id' => '5',
            'driver_id' => '5'],
        ]);
    }
}
