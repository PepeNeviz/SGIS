<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\BKController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {

        if (auth()->user()->role === 'teacher') {
            return redirect('/teacher/dashboard');
        }

        if (auth()->user()->role === 'student') {
            return redirect('/student/dashboard');
        }

        if (auth()->user()->role === 'bk') {
            return redirect('/bk/dashboard');
        }
    }Route::get('/', function () {
    if (auth()->check()) {

        if (auth()->user()->role === 'teacher') {
            return redirect('/teacher/dashboard');
        }

        if (auth()->user()->role === 'student') {
            return redirect('/student/dashboard');
        }

        if (auth()->user()->role === 'bk') {
            return redirect('/bk/dashboard');
        }
    }

    return redirect('/login');
});

    return redirect('/login');
});


// 🔐 AUTH ROUTES (BREEZE)
require __DIR__.'/auth.php';


// ==========================
// 🎓 STUDENT
// ==========================
Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/grades', [StudentController::class, 'grades'])->name('student.grades');
    Route::post('/student/skills', [StudentController::class, 'addSkill'])->name('student.skills.add');

});


// ==========================
// 👨‍🏫 TEACHER
// ==========================
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/class/{id}', [TeacherController::class, 'showClass']);
    Route::get('/teacher/grade/{id}', [TeacherController::class, 'createGrade']);
    Route::post('/teacher/grade', [TeacherController::class, 'storeGrade']);
});


// ==========================
// 🧑‍💼 BK (Bimbingan Konseling)
// ==========================
Route::middleware(['auth', 'role:bk'])->group(function () {
    Route::get('/bk/dashboard', [BKController::class, 'dashboard'])->name('bk.dashboard');
    Route::get('/bk/class/{id}', [BKController::class, 'showClass'])->name('bk.class.show');
    Route::get('/bk/student/{id}', [BKController::class, 'showStudent'])->name('bk.student.show');
    Route::delete('/bk/student/{studentId}/skill/{skillId}', [BKController::class, 'deleteSkill'])->name('bk.skill.delete');
    Route::post('/bk/student/recommend', [BKController::class, 'storeRecommendation'])->name('bk.student.recommend');
});


// ==========================
// Dashboard Redirect (Berdasarkan Role)
// ==========================
Route::get('/dashboard', function () {
    if (auth()->user()->isStudent()) return redirect()->route('student.dashboard');
    if (auth()->user()->isBK()) return redirect()->route('bk.dashboard');
    if (auth()->user()->isTeacher()) return redirect()->route('teacher.dashboard');
    return redirect('/');
})->middleware(['auth'])->name('dashboard');