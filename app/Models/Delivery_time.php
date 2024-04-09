<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Delivery_time extends Model
{
    public function getDelivery_time() {
        //banners テーブルからデータを取得
        $curriculums = DB::table('delivery_times')->get();

        return $curriculums;
    }
}
