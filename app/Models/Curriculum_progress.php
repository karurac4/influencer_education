<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class Curriculum_progress extends Model
{
    use HasFactory;


    public function getCurriculum_progress() {
        //Curriculum_progresses テーブルからデータを取得
        $Curriculum_progresses = DB::table('Curriculum_progresses')->get();

        return $Curriculum_progresses;
    }


    public function user(){

        return $this->belongsTo(User::class, 'users_id');

    }

    public function curriculum(){

        return $this->belongsTo(User::class, 'id');

    }

}
