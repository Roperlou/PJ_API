<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers')->insert([
            ['full_name' => 'Иванов Иван Тестоич',
            'birth_date' => '1979-03-21'],

            ['full_name' => 'Алекей Денисович Большеглядов',
            'birth_date' => '1982-12-30'],

            ['full_name' => 'Сергей Сергеевич Автобусов',
            'birth_date' => '1982-06-12'],

            ['full_name' => 'Алексей Петрович Долгоедов',
            'birth_date' => '1987-10-11'],

            ['full_name' => 'Дмитрий Иванович Рулевой',
            'birth_date' => '1975-02-27']
        ]);
    }
}
