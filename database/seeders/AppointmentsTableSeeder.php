<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('appointements')->insert([
                'datetime' => Carbon::now()->subDays(rand(1, 30)),
                'appointment_id' => Str::random(10),
                'patient_name' => $faker->name,
                'consultation_mode' => 'Video Call',
                'payment_mode' => 'Online',
                'payment_status' => $faker->randomElement(['Paid', 'Refunded']),
                'age_years' => $faker->numberBetween(20, 60),
                'age_months' => $faker->numberBetween(1, 12),
                'appointment_date' => Carbon::now()->addDays(rand(1, 30)),
                'appointment_status' => $faker->randomElement(['Confirmed', 'Rejected', 'Completed']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
