<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes'; // Memastikan tabelnya benar
    protected $fillable = ['name'];

    // RELASI: Satu kelas punya banyak siswa
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}