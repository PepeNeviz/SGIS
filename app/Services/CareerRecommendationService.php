<?php

namespace App\Services;

use App\Models\Student;

class CareerRecommendationService
{
    public function recommend($student)
    {
        // 🛡️ safety guard
        if (!$student || !($student instanceof Student)) {
            return [
                'study' => [],
                'career' => []
            ];
        }

        $study = [];
        $career = [];

        $avg = $student->grades->avg('score') ?? 0;
        $skills = $student->skills->pluck('name')->toArray();

        // 🎓 STUDY
        if ($avg >= 85) {
            $study[] = "Teknik Informatika";
            $study[] = "Sistem Informasi";
        }

        if ($avg >= 75 && $avg < 85) {
            $study[] = "Manajemen";
            $study[] = "Bisnis Digital";
        }

        if ($avg < 75) {
            $study[] = "Penguatan dasar akademik dulu";
        }

        // 💼 CAREER
        if (in_array('Coding', $skills) || $avg >= 85) {
            $career[] = "Software Developer 💻";
        }

        if (in_array('Design', $skills)) {
            $career[] = "UI/UX Designer 🎨";
        }

        if (in_array('Data Analysis', $skills) || $avg >= 80) {
            $career[] = "Data Analyst 📊";
        }

        if ($avg < 70) {
            $career[] = "Perlu pembinaan 😔";
        }

        // fallback
        if (empty($career)) {
            $career[] = "Eksplorasi minat lebih lanjut 🔍";
        }

        return [
            'study' => $study,
            'career' => $career
        ];
    }
}