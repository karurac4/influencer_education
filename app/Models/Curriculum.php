<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Curriculum extends Model
{
    public function getCurriculum() {
        //banners テーブルからデータを取得
        $curriculums = DB::table('curriculums')->get();

        return $curriculums;
    }
}
