<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $classes = Classes::withCount('students')->get();
        return view('teacher.dashboard', compact('classes'));
    }

    // Menampilkan form input untuk satu siswa spesifik
    public function createGrade($id, Request $request)
    {
        $student = Student::with(['user', 'class'])->findOrFail($id);
        $subjects = Subject::all(); // Mengambil 8 mapel RPL tadi
        $selectedSemester = $request->get('semester', 1);

        return view('teacher.input-grade', compact('student', 'subjects', 'selectedSemester'));
    }

    // Menyimpan nilai
    public function storeGrade(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'semester' => 'required',
            'scores' => 'required|array'
        ]);

        $teacherId = auth()->user()->teacher->id;

        foreach ($request->scores as $subjectId => $score) {
            if ($score !== null) {
                Grade::updateOrCreate(
                    [
                        'student_id' => $request->student_id,
                        'subject_id' => $subjectId,
                        'semester'   => $request->semester,
                    ],
                    [
                        'teacher_id' => $teacherId,
                        'score'      => $score,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Data Grade berhasil diperbarui!');
    }

    public function showClass($id)
    {
        // Mengambil data kelas beserta siswa dan user-nya
        $class = \App\Models\Classes::with('students.user')->findOrFail($id);
        
        // Pastikan nama file view-nya sesuai dengan yang kita buat tadi
        return view('teacher.class-students', compact('class'));
    }
}