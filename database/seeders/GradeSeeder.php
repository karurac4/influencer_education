<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $grades = [
            '小学1年生',
            '小学2年生',
            '小学3年生',
            '小学4年生',
            '小学5年生',
            '小学6年生',
            '中学1年生',
            '中学2年生',
            '中学3年生',
            '高校1年生',
            '高校2年生',
            '高校3年生',
        ];

        foreach ($grades as $grade) {
            Grade::create(['name' => $grade]);
        }
    }
}
