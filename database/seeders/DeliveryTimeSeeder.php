<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use Faker\Factory as Faker;

class DeliveryTimeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $curriculums = Curriculum::all();

        foreach ($curriculums as $curriculum) {
            DeliveryTime::create([
                'curriculums_id' => $curriculum->id,
                'delivery_from' => $faker->dateTimeBetween('-1 week', '+1 week')->format('Ymd') . '120000',
                'delivery_to' => $faker->dateTimeBetween('+1 week', '+2 weeks')->format('Ymd') . '120000',
            ]);
        }
    }
}
