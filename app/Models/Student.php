<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nis',
        'class_id',
        'birth_date',
        'gender',
        'recommendation_college', 
        'recommendation_career'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function grades()
    {
        return $this->hasMany(\App\Models\Grade::class);
    }

    public function attendance() {
        return $this->hasMany(Attendance::class);
    }

    public function skills()
    {
        return $this->belongsToMany(\App\Models\Skill::class, 'student_skills')
                    ->withTimestamps(); // Hapus ->withPivot('level')
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}