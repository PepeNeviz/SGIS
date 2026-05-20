<?php

namespace App\Services;

class StudyRecommendationService
{
    public function analyze($student)
    {
        $result = [];

        foreach ($student->grades as $grade) {

            $subject = $grade->subject->name ?? 'Unknown';
            $score = $grade->score;

            if ($score < 75) {

                $result[] = [
                    'type' => 'warning',
                    'message' => "Perlu belajar lebih di $subject"
                ];

            } elseif ($score >= 90) {

                $result[] = [
                    'type' => 'strong',
                    'message' => "Kamu sangat bagus di $subject 🔥"
                ];
            }
        }

        return $result;
    }
}