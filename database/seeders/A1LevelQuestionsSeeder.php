<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use App\Models\LessonPart;

class A1LevelQuestionsSeeder extends Seeder
{
    public function run()
    {
        // Get A1 lesson parts
        //file NÀY Update mới nhất
        $a1LessonParts = LessonPart::where('level', 'A1')->get();
        
        foreach ($a1LessonParts as $lessonPart) {
            $questions = $this->getQuestionsForLessonPart($lessonPart);
            
            foreach ($questions as $index => $questionData) {
                $question = Question::create([
                    'lesson_part_id' => $lessonPart->lesson_part_id,
                    'question_type' => $questionData['type'],
                    'question_text' => $questionData['question_text'],
                    'media_url' => $questionData['media_url'] ?? null,
                    'order_index' => $index + 1,
                ]);

                foreach ($questionData['answers'] as $answerIndex => $answerData) {
                    Answer::create([
                        'questions_id' => $question->questions_id,
                        'answer_text' => $answerData['text'],
                        'is_correct' => $answerData['correct'],
                        'order_index' => $answerData['order'] ?? ($answerIndex + 1),
                        'match_key' => $answerData['match_key'] ?? null,
                        'media_url' => $answerData['media_url'] ?? null,
                    ]);
                }
            }
        }
    }

    private function getQuestionsForLessonPart($lessonPart)
    {
        // Extract lesson and part numbers from part_type (e.g., "Lesson 1-2" -> lesson=1, part=2)
        if (preg_match('/Lesson (\d+)-(\d+)/', $lessonPart->part_type, $matches)) {
            $lesson = (int)$matches[1];
            $part = (int)$matches[2];
        } else {
            return [];
        }

        // Lesson 1: Basic Greetings & Introductions
        if ($lesson == 1) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What is your name?',
                        'answers' => [
                            ['text' => 'I am from...', 'correct' => false],
                            ['text' => 'My name is...', 'correct' => true],
                            ['text' => 'I live in...', 'correct' => false],
                            ['text' => 'I like...', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match each picture to the correct word:',
                        'answers' => [
                            ['text' => 'Cat', 'correct' => true, 'match_key' => 'cat', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/Cat03.jpg/640px-Cat03.jpg'],
                            ['text' => 'Dog', 'correct' => true, 'match_key' => 'dog', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Golde33443.jpg/640px-Golde33443.jpg'],
                            ['text' => 'Rabbit', 'correct' => true, 'match_key' => 'rabbit', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/39/Lapin_blanc.jpg/640px-Lapin_blanc.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ sau vào nhóm:',
                        'answers' => [
                            ['text' => 'run', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'happy', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'quickly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'book', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I ___ from Vietnam.',
                        'answers' => [
                            ['text' => 'am', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu đúng:',
                        'answers' => [
                            ['text' => 'I', 'correct' => true, 'order' => 1],
                            ['text' => 'am', 'correct' => true, 'order' => 2],
                            ['text' => 'a', 'correct' => true, 'order' => 3],
                            ['text' => 'student', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Golde33443.jpg/640px-Golde33443.jpg',
                        'answers' => [
                            ['text' => 'D', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'G', 'correct' => true, 'order' => 3],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Where are you from?',
                        'answers' => [
                            ['text' => 'My name is...', 'correct' => false],
                            ['text' => 'I am from...', 'correct' => true],
                            ['text' => 'I like...', 'correct' => false],
                            ['text' => 'I have...', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match picture → word:',
                        'answers' => [
                            ['text' => 'Apple', 'correct' => true, 'match_key' => 'apple', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Red_Apple.jpg/640px-Red_Apple.jpg'],
                            ['text' => 'Banana', 'correct' => true, 'match_key' => 'banana', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8a/Banana-Single.jpg/640px-Banana-Single.jpg'],
                            ['text' => 'Grapes', 'correct' => true, 'match_key' => 'grapes', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bb/Table_grapes_on_white.jpg/640px-Table_grapes_on_white.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'eat', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'red', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'tree', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'She ___ a student.',
                        'answers' => [
                            ['text' => 'is', 'correct' => true],
                        ]
                    ],
                ];
            }
            if ($part == 2) {
                return [
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Can', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'introduce', 'correct' => true, 'order' => 3],
                            ['text' => 'yourself?', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/4/4f/Birthday_cake.jpg',
                        'answers' => [
                            ['text' => 'B', 'correct' => true, 'order' => 1],
                            ['text' => 'I', 'correct' => true, 'order' => 2],
                            ['text' => 'R', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                            ['text' => 'H', 'correct' => true, 'order' => 5],
                            ['text' => 'D', 'correct' => true, 'order' => 6],
                            ['text' => 'A', 'correct' => true, 'order' => 7],
                            ['text' => 'Y', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What hobbies do you enjoy?',
                        'answers' => [
                            ['text' => 'I am a student.', 'correct' => false],
                            ['text' => 'I enjoy...', 'correct' => true],
                            ['text' => 'I have...', 'correct' => false],
                            ['text' => 'I like to be.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Music', 'correct' => true, 'match_key' => 'music', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/c/c9/Musical_Dice_%2814511348413%29.jpg'],
                            ['text' => 'Movie', 'correct' => true, 'match_key' => 'movie', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Konvas-automat_wide_screen.jpg/640px-Konvas-automat_wide_screen.jpg'],
                            ['text' => 'Book', 'correct' => true, 'match_key' => 'book', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Dresden_Edition_overall.JPG/640px-Dresden_Edition_overall.JPG'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'read', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'beautiful', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'well', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'pen', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I ___ traveling.',
                        'answers' => [
                            ['text' => 'like', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'What', 'correct' => true, 'order' => 1],
                            ['text' => 'is', 'correct' => true, 'order' => 2],
                            ['text' => 'your', 'correct' => true, 'order' => 3],
                            ['text' => 'favorite', 'correct' => true, 'order' => 4],
                            ['text' => 'food?', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Golde33443.jpg/640px-Golde33443.jpg',
                        'answers' => [
                            ['text' => 'D', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'G', 'correct' => true, 'order' => 3],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Do you like traveling?',
                        'answers' => [
                            ['text' => 'Yes, I do', 'correct' => true],
                            ['text' => 'No, I isn\'t', 'correct' => false],
                            ['text' => 'Yes, I am', 'correct' => false],
                            ['text' => 'No, I don\'t', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Pizza', 'correct' => true, 'match_key' => 'pizza', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Eq_it-na_pizza-margherita_sep2005_sml.jpg/640px-Eq_it-na_pizza-margherita_sep2005_sml.jpg'],
                            ['text' => 'Noodles', 'correct' => true, 'match_key' => 'noodles', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Mutton_hakka_noodles.jpg/640px-Mutton_hakka_noodles.jpg'],
                            ['text' => 'Sushi', 'correct' => true, 'match_key' => 'sushi', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/60/Sushi_platter.jpg/640px-Sushi_platter.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Who is your best friend?',
                        'answers' => [
                            ['text' => 'My best friend is Nam.', 'correct' => true],
                            ['text' => 'I like pizza.', 'correct' => false],
                            ['text' => 'I go to school.', 'correct' => false],
                            ['text' => 'She reads books.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match picture → word:',
                        'answers' => [
                            ['text' => 'Movie', 'correct' => true, 'match_key' => 'movie', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Konvas-automat_wide_screen.jpg/640px-Konvas-automat_wide_screen.jpg'],
                            ['text' => 'Soccer', 'correct' => true, 'match_key' => 'soccer', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/1alessandromartinelli2015.jpg/640px-1alessandromartinelli2015.jpg'],
                            ['text' => 'Basketball', 'correct' => true, 'match_key' => 'basketball', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/Basketball.png/640px-Basketball.png'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'watch', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'fun', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'always', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'weekend', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'What\'s the last movie you ___?',
                        'answers' => [
                            ['text' => 'watched', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Do', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'play', 'correct' => true, 'order' => 3],
                            ['text' => 'any', 'correct' => true, 'order' => 4],
                            ['text' => 'sports?', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e9/Mara_Friton_2006.jpg/640px-Mara_Friton_2006.jpg',
                        'answers' => [
                            ['text' => 'S', 'correct' => true, 'order' => 1],
                            ['text' => 'P', 'correct' => true, 'order' => 2],
                            ['text' => 'O', 'correct' => true, 'order' => 3],
                            ['text' => 'R', 'correct' => true, 'order' => 4],
                            ['text' => 'T', 'correct' => true, 'order' => 5],
                            ['text' => 'S', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What do you like to cook?',
                        'answers' => [
                            ['text' => 'I eat pizza.', 'correct' => false],
                            ['text' => 'I like cooking noodles.', 'correct' => true],
                            ['text' => 'I go home.', 'correct' => false],
                            ['text' => 'I have a pet.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Soup', 'correct' => true, 'match_key' => 'soup', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/Kuey_Teow_Soup_in_Tokyo_20230921.jpg'],
                            ['text' => 'Egg', 'correct' => true, 'match_key' => 'egg', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/f/fb/Chicken_Egg_without_Eggshell_5859.jpg'],
                            ['text' => 'Salad', 'correct' => true, 'match_key' => 'salad', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/94/Salad_platter.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'cook', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'delicious', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'slowly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'kitchen', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'They ___ dinner last night.',
                        'answers' => [
                            ['text' => 'had', 'correct' => true],
                        ]
                    ],
                ];
            }
            if ($part == 4) {
                return [
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'When', 'correct' => true, 'order' => 1],
                            ['text' => 'is', 'correct' => true, 'order' => 2],
                            ['text' => 'your', 'correct' => true, 'order' => 3],
                            ['text' => 'birthday?', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/4/4f/Birthday_cake.jpg',
                        'answers' => [
                            ['text' => 'B', 'correct' => true, 'order' => 1],
                            ['text' => 'I', 'correct' => true, 'order' => 2],
                            ['text' => 'R', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                            ['text' => 'H', 'correct' => true, 'order' => 5],
                            ['text' => 'D', 'correct' => true, 'order' => 6],
                            ['text' => 'A', 'correct' => true, 'order' => 7],
                            ['text' => 'Y', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you celebrate it?',
                        'answers' => [
                            ['text' => 'I have cake.', 'correct' => true],
                            ['text' => 'I go school.', 'correct' => false],
                            ['text' => 'I read book.', 'correct' => false],
                            ['text' => 'I sleep.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Christmas', 'correct' => true, 'match_key' => 'christmas', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/Christmas_tree_sxc_hu.jpg/640px-Christmas_tree_sxc_hu.jpg'],
                            ['text' => 'New Year', 'correct' => true, 'match_key' => 'newyear', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Bratislava_New_Year_Fireworks.jpg/640px-Bratislava_New_Year_Fireworks.jpg'],
                            ['text' => 'Mid-Autumn', 'correct' => true, 'match_key' => 'midautumn', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/12/Festival_de_la_Lluna_MMXXIV_55.jpg'],
                        ]
                    ],
                ];
            }
        }

        // Lesson 2: Past Activities
        if ($lesson == 2) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'went', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'yesterday', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'school', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'happy', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Where ___ you yesterday?',
                        'answers' => [
                            ['text' => 'were', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What did you do last weekend?',
                        'answers' => [
                            ['text' => 'I play soccer.', 'correct' => false],
                            ['text' => 'I went shopping.', 'correct' => true],
                            ['text' => 'I am happy.', 'correct' => false],
                            ['text' => 'I have lunch.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Shopping', 'correct' => true, 'match_key' => 'shopping', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Large_interior_view_of_Plaza_Singapura_Shopping_mall_Orchard_Road_Singapore.jpg/640px-Large_interior_view_of_Plaza_Singapura_Shopping_mall_Orchard_Road_Singapore.jpg'],
                            ['text' => 'Cinema', 'correct' => true, 'match_key' => 'cinema', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Berlin_Filmtheater_am_Friedrichshain_asv2024-06_img6.jpg/640px-Berlin_Filmtheater_am_Friedrichshain_asv2024-06_img6.jpg'],
                            ['text' => 'Beach', 'correct' => true, 'match_key' => 'beach', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Havelock_Island%2C_Mangrove_tree_on_the_beach%2C_Andaman_Islands.jpg/640px-Havelock_Island%2C_Mangrove_tree_on_the_beach%2C_Andaman_Islands.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'When', 'correct' => true, 'order' => 1],
                            ['text' => 'did', 'correct' => true, 'order' => 2],
                            ['text' => 'you', 'correct' => true, 'order' => 3],
                            ['text' => 'last', 'correct' => true, 'order' => 4],
                            ['text' => 'go', 'correct' => true, 'order' => 5],
                            ['text' => 'on', 'correct' => true, 'order' => 6],
                            ['text' => 'a', 'correct' => true, 'order' => 7],
                            ['text' => 'vacation?', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Seal_Rocks%2C_Ocean_Beach%2C_San_Francisco.jpg/640px-Seal_Rocks%2C_Ocean_Beach%2C_San_Francisco.jpg',
                        'answers' => [
                            ['text' => 'B', 'correct' => true, 'order' => 1],
                            ['text' => 'E', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'C', 'correct' => true, 'order' => 4],
                            ['text' => 'H', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'met', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'last', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'weekend', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'together', 'correct' => true, 'match_key' => 'Adverb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'How did you ___ your last holiday?',
                        'answers' => [
                            ['text' => 'spend', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What\'s the best trip you\'ve ever taken?',
                        'answers' => [
                            ['text' => 'To Da Nang.', 'correct' => true],
                            ['text' => 'She is teacher.', 'correct' => false],
                            ['text' => 'They cook.', 'correct' => false],
                            ['text' => 'I read book.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Bus', 'correct' => true, 'match_key' => 'bus', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/26/LiAZ-5292.20_in_Seversk.jpg/640px-LiAZ-5292.20_in_Seversk.jpg'],
                            ['text' => 'Car', 'correct' => true, 'match_key' => 'car', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Austin_7_Ulster.jpg/640px-Austin_7_Ulster.jpg'],
                            ['text' => 'Plane', 'correct' => true, 'match_key' => 'plane', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/2013_Porsche_911_Carrera_4S_%28991%29_%289626546987%29.jpg/640px-2013_Porsche_911_Carrera_4S_%28991%29_%289626546987%29.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 2) {
                return [
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Did', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'have', 'correct' => true, 'order' => 3],
                            ['text' => 'any', 'correct' => true, 'order' => 4],
                            ['text' => 'fun', 'correct' => true, 'order' => 5],
                            ['text' => 'last', 'correct' => true, 'order' => 6],
                            ['text' => 'night?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Cooks_050918_154402.jpg/640px-Cooks_050918_154402.jpg',
                        'answers' => [
                            ['text' => 'C', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'O', 'correct' => true, 'order' => 3],
                            ['text' => 'K', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                            ['text' => 'D', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What did you cook last Sunday?',
                        'answers' => [
                            ['text' => 'Rice.', 'correct' => true],
                            ['text' => 'I happy.', 'correct' => false],
                            ['text' => 'She go.', 'correct' => false],
                            ['text' => 'They read.', 'correct' => false],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'visited', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'friend', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'last', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'recently', 'correct' => true, 'match_key' => 'Adverb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'When did you ___ a friend?',
                        'answers' => [
                            ['text' => 'visit', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Did you go shopping last weekend?',
                        'answers' => [
                            ['text' => 'Yes, I did', 'correct' => true],
                            ['text' => 'No, I weren\'t', 'correct' => false],
                            ['text' => 'Yes, I am', 'correct' => false],
                            ['text' => 'No, I don\'t', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Shopping', 'correct' => true, 'match_key' => 'shopping', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Large_interior_view_of_Plaza_Singapura_Shopping_mall_Orchard_Road_Singapore.jpg/640px-Large_interior_view_of_Plaza_Singapura_Shopping_mall_Orchard_Road_Singapore.jpg'],
                            ['text' => 'Birthday', 'correct' => true, 'match_key' => 'birthday', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Birthday_cake.jpg/640px-Birthday_cake.jpg'],
                            ['text' => 'Match', 'correct' => true, 'match_key' => 'match', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Safety_matches_Union_Match_3.jpg/640px-Safety_matches_Union_Match_3.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'What', 'correct' => true, 'order' => 1],
                            ['text' => 'did', 'correct' => true, 'order' => 2],
                            ['text' => 'you', 'correct' => true, 'order' => 3],
                            ['text' => 'do', 'correct' => true, 'order' => 4],
                            ['text' => 'on', 'correct' => true, 'order' => 5],
                            ['text' => 'your', 'correct' => true, 'order' => 6],
                            ['text' => 'last', 'correct' => true, 'order' => 7],
                            ['text' => 'birthday?', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Balloon_bright_%286908691068%29.jpg/640px-Balloon_bright_%286908691068%29.jpg',
                        'answers' => [
                            ['text' => 'B', 'correct' => true, 'order' => 1],
                            ['text' => 'A', 'correct' => true, 'order' => 2],
                            ['text' => 'L', 'correct' => true, 'order' => 3],
                            ['text' => 'L', 'correct' => true, 'order' => 4],
                            ['text' => 'O', 'correct' => true, 'order' => 5],
                            ['text' => 'O', 'correct' => true, 'order' => 6],
                            ['text' => 'N', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'watched', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'sports', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'favorite', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'recently', 'correct' => true, 'match_key' => 'Adverb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'They ___ any photos during the trip.',
                        'answers' => [
                            ['text' => 'took', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Who did you spend your last holiday with?',
                        'answers' => [
                            ['text' => 'With my family.', 'correct' => true],
                            ['text' => 'With my happy.', 'correct' => false],
                            ['text' => 'With my cook.', 'correct' => false],
                            ['text' => 'With my morning.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Camera', 'correct' => true, 'match_key' => 'camera', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Chinon_CP_9_AF_BW_1.JPG/640px-Chinon_CP_9_AF_BW_1.JPG'],
                            ['text' => 'Sunset', 'correct' => true, 'match_key' => 'sunset', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Sunset_2007-1.jpg/640px-Sunset_2007-1.jpg'],
                            ['text' => 'Beach', 'correct' => true, 'match_key' => 'beach', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Seal_Rocks%2C_Ocean_Beach%2C_San_Francisco.jpg/640px-Seal_Rocks%2C_Ocean_Beach%2C_San_Francisco.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 4) {
                return [
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'What', 'correct' => true, 'order' => 1],
                            ['text' => 'was', 'correct' => true, 'order' => 2],
                            ['text' => 'your', 'correct' => true, 'order' => 3],
                            ['text' => 'favorite', 'correct' => true, 'order' => 4],
                            ['text' => 'subject', 'correct' => true, 'order' => 5],
                            ['text' => 'in', 'correct' => true, 'order' => 6],
                            ['text' => 'school', 'correct' => true, 'order' => 7],
                            ['text' => 'last', 'correct' => true, 'order' => 8],
                            ['text' => 'year?', 'correct' => true, 'order' => 9],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Walter_johnson_hs_20200812_094105_1_crop16x9.jpg/640px-Walter_johnson_hs_20200812_094105_1_crop16x9.jpg',
                        'answers' => [
                            ['text' => 'S', 'correct' => true, 'order' => 1],
                            ['text' => 'C', 'correct' => true, 'order' => 2],
                            ['text' => 'H', 'correct' => true, 'order' => 3],
                            ['text' => 'O', 'correct' => true, 'order' => 4],
                            ['text' => 'O', 'correct' => true, 'order' => 5],
                            ['text' => 'L', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Did you volunteer for any cause recently?',
                        'answers' => [
                            ['text' => 'Yes, I did', 'correct' => true],
                            ['text' => 'No, I weren\'t', 'correct' => false],
                            ['text' => 'Yes, I am', 'correct' => false],
                            ['text' => 'No, I don\'t', 'correct' => false],
                        ]
                    ],
                ];
            }
        }

        // Lesson 3: Food & Eating
        if ($lesson == 3) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'eat', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'coffee', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'hot', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'slowly', 'correct' => true, 'match_key' => 'Adverb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'What is your favorite ___?',
                        'answers' => [
                            ['text' => 'food', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Do you drink coffee or tea?',
                        'answers' => [
                            ['text' => 'I drink coffee.', 'correct' => true],
                            ['text' => 'I run fast.', 'correct' => false],
                            ['text' => 'I read books.', 'correct' => false],
                            ['text' => 'I sing.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Coffee', 'correct' => true, 'match_key' => 'coffee', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/A_small_cup_of_coffee.JPG/640px-A_small_cup_of_coffee.JPG'],
                            ['text' => 'Tea', 'correct' => true, 'match_key' => 'tea', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Lipton-mug-tea.jpg/640px-Lipton-mug-tea.jpg'],
                            ['text' => 'Juice', 'correct' => true, 'match_key' => 'juice', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Orange_juice_1_edit1.jpg/640px-Orange_juice_1_edit1.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Do', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'have', 'correct' => true, 'order' => 3],
                            ['text' => 'any', 'correct' => true, 'order' => 4],
                            ['text' => 'dietary', 'correct' => true, 'order' => 5],
                            ['text' => 'restrictions?', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Red_Apple.jpg/640px-Red_Apple.jpg',
                        'answers' => [
                            ['text' => 'A', 'correct' => true, 'order' => 1],
                            ['text' => 'P', 'correct' => true, 'order' => 2],
                            ['text' => 'P', 'correct' => true, 'order' => 3],
                            ['text' => 'L', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'drink', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'sweet', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'water', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I ___ out twice a week.',
                        'answers' => [
                            ['text' => 'eat', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What\'s your go-to snack?',
                        'answers' => [
                            ['text' => 'Chips', 'correct' => true],
                            ['text' => 'Run', 'correct' => false],
                            ['text' => 'Sing', 'correct' => false],
                            ['text' => 'Read', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Chocolate', 'correct' => true, 'match_key' => 'chocolate', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Chocolate_%28blue_background%29.jpg/640px-Chocolate_%28blue_background%29.jpg'],
                            ['text' => 'Popcorn', 'correct' => true, 'match_key' => 'popcorn', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Popcorn_9.jpg/640px-Popcorn_9.jpg'],
                            ['text' => 'Nuts', 'correct' => true, 'match_key' => 'nuts', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Nuts_chocolate_bar_01.jpg/640px-Nuts_chocolate_bar_01.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 2) {
                return [
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'What', 'correct' => true, 'order' => 1],
                            ['text' => 'was', 'correct' => true, 'order' => 2],
                            ['text' => 'the', 'correct' => true, 'order' => 3],
                            ['text' => 'best', 'correct' => true, 'order' => 4],
                            ['text' => 'meal', 'correct' => true, 'order' => 5],
                            ['text' => 'you', 'correct' => true, 'order' => 6],
                            ['text' => 'ever', 'correct' => true, 'order' => 7],
                            ['text' => 'had?', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Eq_it-na_pizza-margherita_sep2005_sml.jpg/640px-Eq_it-na_pizza-margherita_sep2005_sml.jpg',
                        'answers' => [
                            ['text' => 'P', 'correct' => true, 'order' => 1],
                            ['text' => 'I', 'correct' => true, 'order' => 2],
                            ['text' => 'Z', 'correct' => true, 'order' => 3],
                            ['text' => 'Z', 'correct' => true, 'order' => 4],
                            ['text' => 'A', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'sweet', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'bite', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'together', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'dessert', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I prefer ___ snacks.',
                        'answers' => [
                            ['text' => 'salty', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Do you enjoy baking?',
                        'answers' => [
                            ['text' => 'Yes, I do', 'correct' => true],
                            ['text' => 'No, I doesn\'t', 'correct' => false],
                            ['text' => 'Yes, I am', 'correct' => false],
                            ['text' => 'No, I don\'t', 'correct' => true],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What\'s your favorite restaurant?',
                        'answers' => [
                            ['text' => 'City Bistro', 'correct' => true],
                            ['text' => 'I eat steak.', 'correct' => false],
                            ['text' => 'She sings.', 'correct' => false],
                            ['text' => 'They run.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Spicy', 'correct' => true, 'match_key' => 'spicy', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Samyang_Ramen_Spicy_20210827_003.jpg/640px-Samyang_Ramen_Spicy_20210827_003.jpg'],
                            ['text' => 'Dessert', 'correct' => true, 'match_key' => 'dessert', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/Piece_of_chocolate_cake_on_a_white_plate_decorated_with_chocolate_sauce.jpg/640px-Piece_of_chocolate_cake_on_a_white_plate_decorated_with_chocolate_sauce.jpg'],
                            ['text' => 'Sushi', 'correct' => true, 'match_key' => 'sushi', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/60/Sushi_platter.jpg/640px-Sushi_platter.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'order', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'delicious', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'politely', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'menu', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I usually ___ breakfast at 7.',
                        'answers' => [
                            ['text' => 'eat', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Do', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'prefer', 'correct' => true, 'order' => 3],
                            ['text' => 'home-cooked', 'correct' => true, 'order' => 4],
                            ['text' => 'meals', 'correct' => true, 'order' => 5],
                            ['text' => 'or', 'correct' => true, 'order' => 6],
                            ['text' => 'dining', 'correct' => true, 'order' => 7],
                            ['text' => 'out?', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/RedDot_Burger.jpg/640px-RedDot_Burger.jpg',
                        'answers' => [
                            ['text' => 'B', 'correct' => true, 'order' => 1],
                            ['text' => 'U', 'correct' => true, 'order' => 2],
                            ['text' => 'R', 'correct' => true, 'order' => 3],
                            ['text' => 'G', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                            ['text' => 'R', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'prefer', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'healthy', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'quickly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'food', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'He ___ to cook dinner yesterday.',
                        'answers' => [
                            ['text' => 'tried', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What do you order when eating out?',
                        'answers' => [
                            ['text' => 'Steak', 'correct' => true],
                            ['text' => 'I sing.', 'correct' => false],
                            ['text' => 'They run.', 'correct' => false],
                            ['text' => 'She studies.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Noodles', 'correct' => true, 'match_key' => 'noodles', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Noodles_6.jpg/640px-Noodles_6.jpg'],
                            ['text' => 'Curry', 'correct' => true, 'match_key' => 'curry', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Meen_curry_2.JPG/640px-Meen_curry_2.JPG'],
                            ['text' => 'Stew', 'correct' => true, 'match_key' => 'stew', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Lamb-stew.jpg/640px-Lamb-stew.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 4) {
                return [
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Does', 'correct' => true, 'order' => 1],
                            ['text' => 'your', 'correct' => true, 'order' => 2],
                            ['text' => 'family', 'correct' => true, 'order' => 3],
                            ['text' => 'have', 'correct' => true, 'order' => 4],
                            ['text' => 'a', 'correct' => true, 'order' => 5],
                            ['text' => 'signature', 'correct' => true, 'order' => 6],
                            ['text' => 'dish?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Okro_stew_in_a_bowl.jpg/640px-Okro_stew_in_a_bowl.jpg',
                        'answers' => [
                            ['text' => 'S', 'correct' => true, 'order' => 1],
                            ['text' => 'T', 'correct' => true, 'order' => 2],
                            ['text' => 'E', 'correct' => true, 'order' => 3],
                            ['text' => 'W', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'share', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'favorite', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'recipe', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'My comfort food ___ soup.',
                        'answers' => [
                            ['text' => 'is', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Do you enjoy cooking for friends?',
                        'answers' => [
                            ['text' => 'Yes, I do', 'correct' => true],
                            ['text' => 'No, I isn\'t', 'correct' => false],
                            ['text' => 'Yes, I am', 'correct' => false],
                            ['text' => 'No, I don\'t', 'correct' => true],
                        ]
                    ],
                ];
            }
        }

        // Lesson 4: Experiences
        if ($lesson == 4) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'traveled', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'exciting', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'country', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Have you ever ___ abroad?',
                        'answers' => [
                            ['text' => 'traveled', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What is an adventure you want to experience?',
                        'answers' => [
                            ['text' => 'Skydiving', 'correct' => true],
                            ['text' => 'Reading', 'correct' => false],
                            ['text' => 'Sleeping', 'correct' => false],
                            ['text' => 'Studying', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Camping', 'correct' => true, 'match_key' => 'camping', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Camping_tent_on_tarp.jpg/640px-Camping_tent_on_tarp.jpg'],
                            ['text' => 'Surfing', 'correct' => true, 'match_key' => 'surfing', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/La_horde_-_Surfers_riding_a_wave_in_Paea%2C_Tahiti.jpg/640px-La_horde_-_Surfers_riding_a_wave_in_Paea%2C_Tahiti.jpg'],
                            ['text' => 'Climbing', 'correct' => true, 'match_key' => 'climbing', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Flo_dans_Juvs%C3%B8yla_%C3%A0_Rjukan%2C_Norv%C3%A8ge-rotated.jpg/640px-Flo_dans_Juvs%C3%B8yla_%C3%A0_Rjukan%2C_Norv%C3%A8ge-rotated.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Have', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'ever', 'correct' => true, 'order' => 3],
                            ['text' => 'volunteered', 'correct' => true, 'order' => 4],
                            ['text' => 'for', 'correct' => true, 'order' => 5],
                            ['text' => 'a', 'correct' => true, 'order' => 6],
                            ['text' => 'cause?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Handshake_icon.svg/640px-Handshake_icon.svg.png',
                        'answers' => [
                            ['text' => 'F', 'correct' => true, 'order' => 1],
                            ['text' => 'R', 'correct' => true, 'order' => 2],
                            ['text' => 'I', 'correct' => true, 'order' => 3],
                            ['text' => 'E', 'correct' => true, 'order' => 4],
                            ['text' => 'N', 'correct' => true, 'order' => 5],
                            ['text' => 'D', 'correct' => true, 'order' => 6],
                            ['text' => 'S', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'met', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'celebrity', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'really', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'nervous', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I ___ met a celebrity once.',
                        'answers' => [
                            ['text' => 'have', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Have you ever gone on a road trip?',
                        'answers' => [
                            ['text' => 'Yes, I have', 'correct' => true],
                            ['text' => 'No, I am', 'correct' => false],
                            ['text' => 'Yes, I did', 'correct' => false],
                            ['text' => 'No, I do', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Car', 'correct' => true, 'match_key' => 'car', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Auto_Union_streamliner_concept_1923_-_replica_-_rear.jpg/640px-Auto_Union_streamliner_concept_1923_-_replica_-_rear.jpg'],
                            ['text' => 'Road', 'correct' => true, 'match_key' => 'road', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Road_CS-240_at_Coll_d%27Ordino_%282%29.jpg/640px-Road_CS-240_at_Coll_d%27Ordino_%282%29.jpg'],
                            ['text' => 'Beach', 'correct' => true, 'match_key' => 'beach', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Seal_Rocks%2C_Ocean_Beach%2C_San_Francisco.jpg/640px-Seal_Rocks%2C_Ocean_Beach%2C_San_Francisco.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 2) {
                return [
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Have', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'ever', 'correct' => true, 'order' => 3],
                            ['text' => 'done', 'correct' => true, 'order' => 4],
                            ['text' => 'something', 'correct' => true, 'order' => 5],
                            ['text' => 'really', 'correct' => true, 'order' => 6],
                            ['text' => 'challenging?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/CH.VD.Bex_2007-09-02_Airshow_396_16x9-R_5120x2880_%28cropped%29.jpg/640px-CH.VD.Bex_2007-09-02_Airshow_396_16x9-R_5120x2880_%28cropped%29.jpg',
                        'answers' => [
                            ['text' => 'P', 'correct' => true, 'order' => 1],
                            ['text' => 'A', 'correct' => true, 'order' => 2],
                            ['text' => 'R', 'correct' => true, 'order' => 3],
                            ['text' => 'A', 'correct' => true, 'order' => 4],
                            ['text' => 'C', 'correct' => true, 'order' => 5],
                            ['text' => 'H', 'correct' => true, 'order' => 6],
                            ['text' => 'U', 'correct' => true, 'order' => 7],
                            ['text' => 'T', 'correct' => true, 'order' => 8],
                            ['text' => 'E', 'correct' => true, 'order' => 9],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'learned', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'entirely', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'concert', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'memorable', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'What experience ___ you changed?',
                        'answers' => [
                            ['text' => 'has', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Have you ever gone skydiving?',
                        'answers' => [
                            ['text' => 'Yes, I have', 'correct' => true],
                            ['text' => 'No, I do', 'correct' => false],
                            ['text' => 'Yes, I did', 'correct' => false],
                            ['text' => 'No, I am', 'correct' => false],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What\'s the best vacation you\'ve ever had?',
                        'answers' => [
                            ['text' => 'Beach trip', 'correct' => true],
                            ['text' => 'I read.', 'correct' => false],
                            ['text' => 'I cook.', 'correct' => false],
                            ['text' => 'I jump.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Theme park', 'correct' => true, 'match_key' => 'themepark', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Illuminated_Ferris_wheel%2C_bouncing_castle_and_carousel_at_night_in_a_funfair_in_Vientiane%2C_Laos.jpg/640px-Illuminated_Ferris_wheel%2C_bouncing_castle_and_carousel_at_night_in_a_funfair_in_Vientiane%2C_Laos.jpg'],
                            ['text' => 'Historical site', 'correct' => true, 'match_key' => 'historical', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/Himeji_Castle_The_Keep_Towers.jpg/640px-Himeji_Castle_The_Keep_Towers.jpg'],
                            ['text' => 'Festival', 'correct' => true, 'match_key' => 'festival', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fd/Festival_%28food%2901.jpg/640px-Festival_%28food%2901.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'visited', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'coolest', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'place', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I want to visit that site ___.',
                        'answers' => [
                            ['text' => 'soon', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Have', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'tried', 'correct' => true, 'order' => 3],
                            ['text' => 'exotic', 'correct' => true, 'order' => 4],
                            ['text' => 'foods?', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Pineapple_and_cross_section.jpg/640px-Pineapple_and_cross_section.jpg',
                        'answers' => [
                            ['text' => 'P', 'correct' => true, 'order' => 1],
                            ['text' => 'I', 'correct' => true, 'order' => 2],
                            ['text' => 'N', 'correct' => true, 'order' => 3],
                            ['text' => 'E', 'correct' => true, 'order' => 4],
                            ['text' => 'A', 'correct' => true, 'order' => 5],
                            ['text' => 'P', 'correct' => true, 'order' => 6],
                            ['text' => 'P', 'correct' => true, 'order' => 7],
                            ['text' => 'L', 'correct' => true, 'order' => 8],
                            ['text' => 'E', 'correct' => true, 'order' => 9],
                        ]
                    ],
                ];
            }
            if ($part == 4) {
                return [
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Have', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'ever', 'correct' => true, 'order' => 3],
                            ['text' => 'participated', 'correct' => true, 'order' => 4],
                            ['text' => 'in', 'correct' => true, 'order' => 5],
                            ['text' => 'a', 'correct' => true, 'order' => 6],
                            ['text' => 'marathon?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Berlin_marathon.jpg/640px-Berlin_marathon.jpg',
                        'answers' => [
                            ['text' => 'M', 'correct' => true, 'order' => 1],
                            ['text' => 'A', 'correct' => true, 'order' => 2],
                            ['text' => 'R', 'correct' => true, 'order' => 3],
                            ['text' => 'A', 'correct' => true, 'order' => 4],
                            ['text' => 'T', 'correct' => true, 'order' => 5],
                            ['text' => 'H', 'correct' => true, 'order' => 6],
                            ['text' => 'O', 'correct' => true, 'order' => 7],
                            ['text' => 'N', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'participated', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'longest', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'ever', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'time', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'What\'s the longest you\'ve been ___ from home?',
                        'answers' => [
                            ['text' => 'away', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Have you ever had a near-death experience?',
                        'answers' => [
                            ['text' => 'Yes, I have', 'correct' => true],
                            ['text' => 'No, I do', 'correct' => false],
                            ['text' => 'Yes, I did', 'correct' => false],
                            ['text' => 'No, I am', 'correct' => false],
                        ]
                    ],
                ];
            }
        }

        // Lesson 5: Measurements & Math
        if ($lesson == 5) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you measure ingredients when cooking?',
                        'answers' => [
                            ['text' => 'With a scale', 'correct' => true],
                            ['text' => 'With a book', 'correct' => false],
                            ['text' => 'With a cat', 'correct' => false],
                            ['text' => 'With a movie', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match →',
                        'answers' => [
                            ['text' => 'Ruler', 'correct' => true, 'match_key' => 'ruler', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Measurement_unit.jpg/640px-Measurement_unit.jpg'],
                            ['text' => 'Scale', 'correct' => true, 'match_key' => 'scale', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Diatonic_and_Pentatonic_scale_intervals.svg/640px-Diatonic_and_Pentatonic_scale_intervals.svg.png'],
                            ['text' => 'Timer', 'correct' => true, 'match_key' => 'timer', 'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/2023_Minutnik_Baseus.jpg/640px-2023_Minutnik_Baseus.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại:',
                        'answers' => [
                            ['text' => 'meter', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'measure', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'exactly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'accurate', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I prefer ___ measurements.',
                        'answers' => [
                            ['text' => 'metric', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Can', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'explain', 'correct' => true, 'order' => 3],
                            ['text' => 'volume?', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Volume_element.jpg/640px-Volume_element.jpg',
                        'answers' => [
                            ['text' => 'V', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'L', 'correct' => true, 'order' => 3],
                            ['text' => 'U', 'correct' => true, 'order' => 4],
                            ['text' => 'M', 'correct' => true, 'order' => 5],
                            ['text' => 'E', 'correct' => true, 'order' => 6],
                        ]
                    ],
                ];
            }
        }

        return [];
    }
}
