<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\CareerRecommendationService;
use App\Services\StudyRecommendationService;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Student::with(['grades.subject', 'skills', 'class'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // 1. Definisikan 8 Mapel Tetap agar urutan segi-delapan konsisten
        $subjects = [
            'B. Indonesia', 'B. Inggris', 'Matematika', 'Basis Data', 
            'Pemrograman Java', 'Pemrograman Website', 'Pemrograman Android', 'Pemrograman Gim'
        ];

        // 2. Siapkan data untuk Chart
        $chartData = [];
        for ($i = 1; $i <= 5; $i++) {
            $semesterValues = [];
            foreach ($subjects as $subjectName) {
                $score = $student->grades
                    ->where('semester', $i)
                    ->where('subject.name', $subjectName)
                    ->first();
                
                $semesterValues[] = $score ? $score->score : 0;
            }
            $chartData[$i] = $semesterValues;
        }

        return view('student.dashboard', compact('student', 'chartData', 'subjects'));
    }

    public function grades(
        StudyRecommendationService $studyService,
        CareerRecommendationService $careerService
    )
    {
        $student = Student::with(['grades.subject', 'skills'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $grades = $student->grades;
        $avg = $grades->avg('score') ?? 0;
        $max = $grades->sortByDesc('score')->first();
        $min = $grades->sortBy('score')->first();

        $trend = "Stabil";
        if ($grades->count() >= 2) {
            $first = $grades->first()->score;
            $last = $grades->last()->score;
            if ($last > $first) $trend = "Meningkat 📈";
            elseif ($last < $first) $trend = "Menurun 📉";
        }

        $studyInsights = $studyService->analyze($student);
        $careers = $careerService->recommend($student);

        return view('student.grades', compact(
            'student', 'avg', 'max', 'min', 'trend', 'studyInsights', 'careers'
        ));
    }

    public function addSkill(Request $request)
    {
        $request->validate([
            'skill_name' => 'required|string|max:50',
        ]);

        $student = Auth::user()->student;

        // Cari atau buat skill baru berdasarkan nama saja
        $skill = Skill::firstOrCreate([
            'name' => trim($request->skill_name)
        ]);

        // Hubungkan ke siswa tanpa menghapus yang sudah ada (detach)
        $student->skills()->syncWithoutDetaching([$skill->id]);

        return redirect()->back()->with('success', 'Skill berhasil ditambahkan!');
    }

    public function showClass($id)
    {
        $class = \App\Models\Classes::with('students.user')->findOrFail($id);
        return view('teacher.class-students', compact('class'));
    }
}