<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';
    protected $fillable = ['id', 'title', 'thumbnail', 'description', 'video_url', 'alway_delivery_flg', 'grades_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grades_id');
        
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'curriculum_progress', 'users_id', 'curriculums_id')->withPivot('clear_flag');
    }

    public function curriculum_progress()
    {
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id', 'users_id')->withPivot('clear_flag');
    }
}
