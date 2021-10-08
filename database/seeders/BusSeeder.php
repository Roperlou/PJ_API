<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('buses')->insert([
            ['bus_name' => 'ЛиАЗ 4274 1995',
            'bus_average_speed' => '60'],

            ['bus_name' => 'Volvo 9500 2010',
            'bus_average_speed' => '80'],

            ['bus_name' => 'Volvo 9700 2012',
            'bus_average_speed' => '75'],

            ['bus_name' => 'Mitsubishi Fuso Rosa 2002',
            'bus_average_speed' => '85']
        ]);
    }
}
