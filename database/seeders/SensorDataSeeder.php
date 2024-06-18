<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SensorDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sensors = ['sensor1', 'sensor2'];
        $baseTime = Carbon::now();

        for ($i = 0; $i < 10; $i++) {
            $randomMinutes = rand(1, 60); // Generate a random number of minutes between 1 and 60
            $createdAt = $baseTime->copy()->subMinutes($randomMinutes * $i); // Subtract random minutes for each entry

            DB::table('sensor_data')->insert([
                'sensor_id' => $sensors[array_rand($sensors)],
                'detection_level' => mt_rand(50, 100) / 10,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
