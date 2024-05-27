<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    // protected $table = 'grades';
    protected $fillable = [
        'name',
        
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'grades_id');
    }

    public function curriculums()
    {
        return $this->hasMany(Curriculum::class, 'grades_id', 'curriculums_id');
    }
}
