<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class BKController extends Controller
{
    // Halaman Utama: Pilih Kelas
    public function dashboard()
    {
        $classes = Classes::withCount('students')->get();
        return view('bk.dashboard', compact('classes'));
    }

    // Halaman Daftar Siswa dalam satu kelas
    public function showClass($id)
    {
        $class = Classes::with('students.user')->findOrFail($id);
        return view('bk.class-detail', compact('class'));
    }

    // Halaman Monitoring Detail Siswa (Radar Chart & Skill)
    public function showStudent($id)
    {
        $student = Student::with(['grades.subject', 'skills', 'class', 'user'])->findOrFail($id);
        
        $subjects = [
            'B. Indonesia', 'B. Inggris', 'Matematika', 'Basis Data', 
            'Pemrograman Java', 'Pemrograman Website', 'Pemrograman Android', 'Pemrograman Gim'
        ];

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

        return view('bk.show-student', compact('student', 'chartData', 'subjects'));
    }

    // Fitur Hapus Skill Siswa yang "aneh"
    public function deleteSkill($studentId, $skillId)
    {
        $student = Student::findOrFail($studentId);
        $student->skills()->detach($skillId);
        
        return back()->with('success', 'Skill berhasil dihapus dari profil siswa.');
    }

public function storeRecommendation(\Illuminate\Http\Request $request)
{
    // 1. Validasi (Opsional tapi disarankan)
    $request->validate([
        'student_id' => 'required',
        'recommendation_college' => 'nullable|string',
        'recommendation_career' => 'nullable|string',
    ]);

    // 2. Cari Siswa
    $student = \App\Models\Student::findOrFail($request->student_id);

    // 3. Eksekusi Update
    // Jika step 1 tadi sudah dilakukan (fillable), ini pasti berhasil
    $student->update([
        'recommendation_college' => $request->recommendation_college,
        'recommendation_career' => $request->recommendation_career,
    ]);

    return redirect()->back()->with('success', 'Rekomendasi berhasil disimpan!');
}
}