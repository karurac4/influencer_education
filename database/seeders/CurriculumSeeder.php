<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Curriculum;
use App\Models\Grade;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全ての学年を取得
        $grades = Grade::all();

        // 各学年に3つのダミーデータを挿入
        foreach ($grades as $grade) {
            for ($i = 1; $i <= 3; $i++) {
                Curriculum::create([
                    'title' => 'Curriculum ' . $i . ' for Grade ' . $grade->name,
                    'thumbnail' => 'thumbnail_path',
                    'description' => 'Description for Curriculum ' . $i . ' for Grade ' . $grade->name,
                    'video_url' => 'video_url',
                    'alway_delivery_flg' => true,
                    'grade_id' => $grade->id
                ]);
            }
        }
    }
}
