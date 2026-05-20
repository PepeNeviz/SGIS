<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Skill;
use App\Models\Classes; // Pastikan Model Classes sudah dibuat
use Illuminate\Support\Facades\Hash;

class SGISPerfectSeeder extends Seeder
{
    public function run()
    {
        $class = Classes::create(['name' => 'XII RPL 3']);
        
        $subjects = [
            'B. Indonesia', 
            'B. Inggris', 
            'Matematika', 
            'Basis Data', 
            'Pemrograman Java', 
            'Pemrograman Website', 
            'Pemrograman Android', 
            'Pemrograman Gim'
        ];
        $subjectModels = [];
        foreach ($subjects as $s) {
            $subjectModels[] = Subject::create(['name' => $s]);
        }

        $userStudent = User::create([
            'name' => 'Neviz',
            'email' => 'ziven642@gmail.com',
            'password' => \Hash::make('password'),
            'role' => 'student'
        ]);

        $student = Student::create([
            'user_id' => $userStudent->id,
            'class_id' => $class->id,
            'nis' => '2024001',
        ]);

        $userTeacher = User::create([
            'name' => 'Pak Budi',
            'email' => 'teacher@gmail.com',
            'password' => \Hash::make('password'),
            'role' => 'teacher'
        ]);
        $teacher = Teacher::create(['user_id' => $userTeacher->id, 'nip' => '19870101']);

        User::create([
            'name' => 'Ibu Rahma (BK)',
            'email' => 'bk@gmail.com',
            'password' => \Hash::make('password'),
            'role' => 'bk'
        ]);

        // Seed Nilai 5 Semester
        foreach ($subjectModels as $sub) {
            for ($smtr = 1; $smtr <= 5; $smtr++) {
                Grade::create([
                    'student_id' => $student->id,
                    'subject_id' => $sub->id,
                    'teacher_id' => $teacher->id,
                    'score' => rand(70, 98),
                    'semester' => $smtr
                ]);
            }
        }
    }
}