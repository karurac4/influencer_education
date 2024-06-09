<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\CurriculumProgress;
use App\Models\Grade;
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
        'id',
        'name',
        'name_kana',
        'email',
        'password',
        'profile_image',
        'grades_id',
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

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grades_id');
    }

    public function curriculums()
    {
        return $this->belongsToMany(Curriculum::class, 'curriculum_progress', 'curriculums_id', 'users_id')->withPivot('clear_flag');
    }

    public function curriculum_progress()
    {
        return $this->hasMany(CurriculumProgress::class);
    }

    public function registUser($data) {
        // 登録処理
        DB::table('users')->insert([
            'name' => $data->name,
            'name_kana' => $data->name_kana,
            'email' => $data->email,
            'profile_image' => $data->profile_image,
        ]);
    }
}
