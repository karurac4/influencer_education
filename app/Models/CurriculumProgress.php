<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $table = 'curriculum_progress';

    protected $fillable = [
        'user_id',
        'curriculums_id',
        'clear_flag',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'curriculum_progress', 'curriculums_id', 'user_id')->withPivot('clear_flag');
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_progress', 'user_id', 'curriculums_id')->withPivot('clear_flag');
    }
}
