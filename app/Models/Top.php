<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Top extends Model
{
    public function getImage() {
        //banners テーブルからデータを取得
        $banners = DB::table('banners')->get();

        return $banners;
    }
}
