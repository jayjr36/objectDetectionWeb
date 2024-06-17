<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensorDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sensors = ['sensor1', 'sensor2'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('noise_data')->insert([
                'sensor_id' => $sensors[array_rand($sensors)],
                'noise_level' => mt_rand(50, 100) / 10, 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
