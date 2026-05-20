<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name','category'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_skills');
    }
}