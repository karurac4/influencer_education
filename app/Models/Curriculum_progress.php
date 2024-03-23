<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Curriculum;

class Curriculum_progress extends Model
{
    use HasFactory;


    public function getList() {
        //curriculum_progresses テーブルからデータを取得
        $deliveries = DB::table('curriculum_progresses')->get();

        return $deliveries;
    }


    public function getArticle() {
        //articles テーブルからデータを取得
        $articles = DB::table('articles')->get();

        return $articles;
    }

    public function getImage() {
        //banners テーブルからデータを取得
        $banners = DB::table('banners')->get();

        return $banners;
    }

    public function user(){

        return $this->belongsTo(User::class, 'id');

    }

    public function curriculum(){

        return $this->belongsTo(User::class, 'id');

    }

}
