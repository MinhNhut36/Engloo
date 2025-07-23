<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
   
          $this->call([
            AdminSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
            LessonSeeder::class,
            CourseSeeder::class,
            LessonPartSeeder::class,

            // Question seeders organized by level
            A1LevelQuestionsSeeder::class,
            A2LevelQuestionsSeeder::class,
            A3LevelQuestionsSeeder::class,
            TA2LevelQuestionsSeeder::class,

            // Course and enrollment management
            CourseEnrollmentSeeder::class,
            TeacherCourseAssignmentSeeder::class,

            // Student learning data
            RealisticStudentAnswerSeeder::class,
            ExamResultSeeder::class,
            LessonPartScoreSeeder::class,
            StudentProgressSeeder::class,
            StudentEvaluationSeeder::class,

            // Class interaction
            ClassPostSeeder::class,
            ClassPostCommentSeeder::class,
            NotificationSeeder::class,
            ClassPostSeeder::class, // Updated để tạo posts dựa trên teacher assignments
            ClassPostCommentSeeder::class, // Updated để tạo comments realistic
            NotificationSeeder::class, // Updated để tạo notifications dựa trên enrollments
        ]);
                      
    }
}
