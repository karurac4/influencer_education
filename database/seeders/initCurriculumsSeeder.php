<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class initCurriculumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => Str::random(10),
            'email'     => Str::random(10).'@gmail.com',
            'password'  => Hash::make('password'),
        ]);


        DB::table('curriculums')->insert([
            'id' => Str::random(10),
            'title'     => Str::random(10),
            'thumbnail'     => Str::random(10),
            'description'     => Str::random(10),
            'video_url'     => Str::random(10),
            'alway_delivery_flg'     => Str::random(10),
            'grade_id'     => Str::random(10),
            'timestamps'     => Str::random(10),
        ]);


    }
}
