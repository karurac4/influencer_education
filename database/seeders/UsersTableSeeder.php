<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        
            [
                'id'=> '1',
                'name'=> '山田太郎',
                'name_kana'=> 'ヤマダタロウ',
                'email'=> 'hoge@example.com',
                'password'=> Hash::make('hogehoge'),
                'profile_image'=> 'hoge.png',
                'grades_id'=> '6',
            ],
            [
                'id'=> '2',
                'name'=> '鈴木花子',
                'name_kana'=> 'スズキハナコ',
                'email'=> 'sample@example.com',
                'password'=> Hash::make('samplehanako'),
                'profile_image'=> 'sample.png',
                'grades_id'=> '10',
                ],
        //
        ]);
    }
}
