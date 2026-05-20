<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Buat Tabel classes terlebih dahulu karena akan jadi Foreign Key
        if (!Schema::hasTable('classes')) {
            Schema::create('classes', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // XII RPL 3
                $table->timestamps();
            });
        }

        // 2. Modifikasi tabel students
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'class_id')) {
                $table->foreignId('class_id')->nullable()->constrained('classes')->onDelete('set null');
            }
        });

        // 3. Modifikasi tabel grades
        Schema::table('grades', function (Blueprint $table) {
            if (!Schema::hasColumn('grades', 'semester')) {
                $table->integer('semester')->default(1)->after('score');
            }
        });

        // 4. Modifikasi student_skills (Hapus level)
        Schema::table('student_skills', function (Blueprint $table) {
            if (Schema::hasColumn('student_skills', 'level')) {
                $table->dropColumn('level');
            }
        });
    }

    public function down()
    {
        // Ini untuk rollback jika ada kesalahan
        Schema::table('student_skills', function (Blueprint $table) {
            $table->integer('level')->default(0);
        });
        Schema::table('grades', function (Blueprint $table) {
            $table->dropColumn('semester');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropConstrainedForeignId('class_id');
        });
        Schema::dropIfExists('classes');
    }
};