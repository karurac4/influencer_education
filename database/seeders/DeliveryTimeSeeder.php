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

        // すべてのカリキュラムを取得
        $curriculums = Curriculum::all();

        // 各カリキュラムに対してダミーの配信日時を1つずつ作成
        foreach ($curriculums as $curriculum) {
            DeliveryTime::create([
                'curriculums_id' => $curriculum->id,
                'delivery_from' => $faker->dateTimeBetween('-1 week', '+1 week'),
                'delivery_to' => $faker->dateTimeBetween('+1 week', '+2 weeks'),
            ]);
        }
    }
}
