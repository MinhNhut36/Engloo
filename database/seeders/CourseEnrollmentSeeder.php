<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseEnrollment;
use App\Models\Student;
use App\Models\Course;
use Carbon\Carbon;

class CourseEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $courses = Course::all();

        foreach ($students as $student) {
            // Mỗi student chỉ có 2-3 enrollments
            $numEnrollments = rand(2, 3);

            for ($i = 0; $i < $numEnrollments; $i++) {
                $course = $courses->random();

                // Tránh duplicate enrollments
                $existingEnrollment = CourseEnrollment::where('student_id', $student->student_id)
                    ->where('assigned_course_id', $course->course_id)
                    ->first();

                if ($existingEnrollment) {
                    continue; // Skip nếu đã có enrollment này
                }

                $status = $this->getRandomStatus();
                $registrationDate = $this->getRegistrationDate($status);

                CourseEnrollment::create([
                    'student_id' => $student->student_id,
                    'assigned_course_id' => $course->course_id,
                    'status' => $status,
                    'registration_date' => $registrationDate,
                ]);
            }
        }
    }

    private function getRandomStatus()
    {
        // Tăng tỷ lệ studying để phù hợp với thực tế
        $statuses = [1, 2, 2, 2, 2, 3, 3, 4]; // 0=pending, 1=studying, 2=passed, 3=failed
        return $statuses[array_rand($statuses)];
    }

    private function getRegistrationDate($status)
    {
        $now = Carbon::now();

        switch ($status) {
            case 1: // Pending - vừa đăng ký gần đây
                return $now->subDays(rand(1, 7));
            case 2: // Studying - đang học (1-3 tháng)
                return $now->subDays(rand(7, 90));
            case 3: // Passed - đã hoàn thành (2-6 tháng trước)
                return $now->subDays(rand(60, 180));
            case 4: // Failed - thất bại (1-4 tháng trước)
                return $now->subDays(rand(30, 120));
            default:
                return $now->subDays(rand(1, 60));
        }
    }
}
