<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurriculumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curriculums')->insert([
            
                [
                    'id'=> '1',
                    'title'=> '掛け算の学習',
                    'thumbnail'=> 'thumbnail_path',
                    'description'=> 'Description for Curriculum',
                    'video_url'=> 'video_url',
                    'alway_delivery_flg'=> true,
                    'grades_id'=> '3',
                ],
                [
                    'id'=> '2',
                    'title'=> '理科の実験',
                    'thumbnail'=> 'thumbnail_path',
                    'description'=> 'Description for Curriculum',
                    'video_url'=> 'video_url',
                    'alway_delivery_flg'=> true,
                    'grades_id'=> '5',
                ],
                [
                    'id'=> '3',
                    'title'=> '大学受験に向けた学習',
                    'thumbnail'=> 'thumbnail_path',
                    'description'=> 'Description for Curriculum',
                    'video_url'=> 'video_url',
                    'alway_delivery_flg'=> true,
                    'grades_id'=> '12',
                ],
            //
            ]);
        //
    }
}
