<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LessonPart;

class LessonPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            1 => 'A1',
            2 => 'A2',
            3 => 'A3',
            4 => 'TA 2/6',
        ];

        foreach ($levels as $lesson_id => $level) {
            $parts = [];
            // Tạo các LessonPart từ Lesson 1-1 đến Lesson 5-4
            for ($lesson = 1; $lesson <= 5; $lesson++) {
                for ($sub = 1; $sub <= 4; $sub++) {
                    $title = sprintf('Lesson %d-%d', $lesson, $sub);
                    $desc = '';

                    switch ($level) {
                        case 'A1':
                            $desc = sprintf('Bài học %s trình độ %s - Làm quen với từ vựng và mẫu câu cơ bản qua các tình huống hàng ngày.', $title, $level);
                            break;
                        case 'A2':
                            $desc = sprintf('Bài học %s trình độ %s - Mở rộng vốn từ và cấu trúc câu, nâng cao khả năng giao tiếp hàng ngày.', $title, $level);
                            break;
                        case 'A3':
                            $desc = sprintf('Bài học %s trình độ %s - Tập trung phát triển kỹ năng viết, nói và hiểu văn bản phức tạp hơn.', $title, $level);
                            break;
                        case 'TA 2/6':
                            $desc = sprintf('Bài học %s trình độ %s - Tổng hợp luyện tập với các dạng bài trắc nghiệm, nối từ, nghe hiểu và viết.', $title, $level);
                            break;
                        default:
                            $desc = sprintf('Bài học %s trình độ %s.', $title, $level);
                    }

                    $parts[] = [
                        'title' => $title,
                        'desc'  => $desc,
                    ];
                }
            }

            // Tạo bản ghi vào cơ sở dữ liệu
            foreach ($parts as $index => $part) {
                LessonPart::create([
                    'level'       => $level,
                    'part_type'   => $part['title'],
                    'content'     => $part['desc'],
                    'order_index' => $index + 1,
                ]);
            }
        }
    }
}
