<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Curriculum_progress;
use App\Models\Grade;
use App\Models\Class_clear_checks;

use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'name_kana', 'grade_id'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUsers() {
        //users テーブルからデータを取得
        $users = DB::table('users')->get();

        return $users;
    }

    public function curriculum_progress() {

        return $this->hasMany(Curriculum_progress::class);

    }

    public function class_clear_check() {

        return $this->hasMany(Class_clear_check::class,'users_id');

    }



    public function grade() {

        return $this->belongsTo(Grade::class);

    }
}
