<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use App\Models\LessonPart;

class A2LevelQuestionsSeeder extends Seeder
{
    public function run()
    {
        // Get A2 lesson parts
        $a2LessonParts = LessonPart::where('level', 'A2')->get();
        
        foreach ($a2LessonParts as $lessonPart) {
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

        // Lesson 1: Greetings & Communication
        if ($lesson == 1) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What do you say when you meet someone for the first time?',
                        'answers' => [
                            ['text' => 'Goodbye', 'correct' => false],
                            ['text' => 'Nice to meet you', 'correct' => true],
                            ['text' => 'See you', 'correct' => false],
                            ['text' => 'Thank you', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match gestures to greetings:',
                        'answers' => [
                            ['text' => 'Hello', 'correct' => true, 'match_key' => 'Hello', 'media_url' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=300&fit=crop'],
                            ['text' => 'Goodbye', 'correct' => true, 'match_key' => 'Goodbye', 'media_url' => 'https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?w=400&h=300&fit=crop'],
                            ['text' => 'Hi', 'correct' => true, 'match_key' => 'Hi', 'media_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'please', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'greet', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'friend', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'nice', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'How would you ___ someone politely?',
                        'answers' => [
                            ['text' => 'greet', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'How', 'correct' => true, 'order' => 1],
                            ['text' => 'do', 'correct' => true, 'order' => 2],
                            ['text' => 'you', 'correct' => true, 'order' => 3],
                            ['text' => 'ask', 'correct' => true, 'order' => 4],
                            ['text' => 'for', 'correct' => true, 'order' => 5],
                            ['text' => 'someone\'s', 'correct' => true, 'order' => 6],
                            ['text' => 'name', 'correct' => true, 'order' => 7],
                            ['text' => 'politely?', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/birthday-party-celebration_23-2148721742.jpg',
                        'answers' => [
                            ['text' => 'P', 'correct' => true, 'order' => 1],
                            ['text' => 'A', 'correct' => true, 'order' => 2],
                            ['text' => 'R', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                            ['text' => 'Y', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What\'s a formal way to say goodbye?',
                        'answers' => [
                            ['text' => 'See ya', 'correct' => false],
                            ['text' => 'Farewell', 'correct' => true],
                            ['text' => 'Yo', 'correct' => false],
                            ['text' => 'Sup', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match symbols to meanings:',
                        'answers' => [
                            ['text' => 'Question', 'correct' => true, 'match_key' => 'question_mark', 'media_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=300&fit=crop'],
                            ['text' => 'Think', 'correct' => true, 'match_key' => 'thinking', 'media_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop'],
                            ['text' => 'Repeat', 'correct' => true, 'match_key' => 'repeat', 'media_url' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=400&h=300&fit=crop'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'ask', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'polite', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'please', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'name', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'If you didn\'t hear someone, you say "___?"',
                        'answers' => [
                            ['text' => 'Sorry', 'correct' => true],
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
                            ['text' => 'types', 'correct' => true, 'order' => 2],
                            ['text' => 'of', 'correct' => true, 'order' => 3],
                            ['text' => 'music', 'correct' => true, 'order' => 4],
                            ['text' => 'do', 'correct' => true, 'order' => 5],
                            ['text' => 'you', 'correct' => true, 'order' => 6],
                            ['text' => 'like?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/headphones-music-listening_23-2148721692.jpg',
                        'answers' => [
                            ['text' => 'M', 'correct' => true, 'order' => 1],
                            ['text' => 'U', 'correct' => true, 'order' => 2],
                            ['text' => 'S', 'correct' => true, 'order' => 3],
                            ['text' => 'I', 'correct' => true, 'order' => 4],
                            ['text' => 'C', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Do you prefer hip hop or rock? Why?',
                        'answers' => [
                            ['text' => 'Because I like the beat.', 'correct' => true],
                            ['text' => 'Because I like to sleep.', 'correct' => false],
                            ['text' => 'Because I like to cook.', 'correct' => false],
                            ['text' => 'Because I like to read.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match music genres:',
                        'answers' => [
                            ['text' => 'Rap', 'correct' => true, 'match_key' => 'microphone', 'media_url' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=400&h=300&fit=crop'],
                            ['text' => 'Rock', 'correct' => true, 'match_key' => 'guitar', 'media_url' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=300&fit=crop'],
                            ['text' => 'Jazz', 'correct' => true, 'match_key' => 'piano', 'media_url' => 'https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=400&h=300&fit=crop'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'dance', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'loud', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'song', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I really ___ hip hop.',
                        'answers' => [
                            ['text' => 'like', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Who', 'correct' => true, 'order' => 1],
                            ['text' => 'is', 'correct' => true, 'order' => 2],
                            ['text' => 'your', 'correct' => true, 'order' => 3],
                            ['text' => 'favorite', 'correct' => true, 'order' => 4],
                            ['text' => 'hip', 'correct' => true, 'order' => 5],
                            ['text' => 'hop', 'correct' => true, 'order' => 6],
                            ['text' => 'artist?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/musical-song-notes_23-2148721743.jpg',
                        'answers' => [
                            ['text' => 'S', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'N', 'correct' => true, 'order' => 3],
                            ['text' => 'G', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which musician do you enjoy listening to the most?',
                        'answers' => [
                            ['text' => 'Eminem', 'correct' => true],
                            ['text' => 'Pizza', 'correct' => false],
                            ['text' => 'Cat', 'correct' => false],
                            ['text' => 'Desk', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match musical elements:',
                        'answers' => [
                            ['text' => 'Melody', 'correct' => true, 'match_key' => 'musical_note', 'media_url' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=300&fit=crop'],
                            ['text' => 'Score', 'correct' => true, 'match_key' => 'sheet_music', 'media_url' => 'https://images.unsplash.com/photo-1507838153414-b4b713384a76?w=400&h=300&fit=crop'],
                            ['text' => 'Violin', 'correct' => true, 'match_key' => 'violin', 'media_url' => 'https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=400&h=300&fit=crop'],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'invite', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'polite', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'later', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'party', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Would you ___ to join us for lunch?',
                        'answers' => [
                            ['text' => 'like', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you invite someone to a party?',
                        'answers' => [
                            ['text' => 'Would you like to come?', 'correct' => true],
                            ['text' => 'Do you cook?', 'correct' => false],
                            ['text' => 'Are you happy?', 'correct' => false],
                            ['text' => 'Where are you?', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match party items:',
                        'answers' => [
                            ['text' => 'Cheers', 'correct' => true, 'match_key' => 'cheers', 'media_url' => 'https://images.unsplash.com/photo-1549027519-05b5d13eedf4?w=400&h=300&fit=crop'],
                            ['text' => 'Cake', 'correct' => true, 'match_key' => 'cake', 'media_url' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&h=300&fit=crop'],
                            ['text' => 'Gift', 'correct' => true, 'match_key' => 'gift', 'media_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=300&fit=crop'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Would', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'like', 'correct' => true, 'order' => 3],
                            ['text' => 'a', 'correct' => true, 'order' => 4],
                            ['text' => 'drink?', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/glass-fresh-juice_23-2148721694.jpg',
                        'answers' => [
                            ['text' => 'D', 'correct' => true, 'order' => 1],
                            ['text' => 'R', 'correct' => true, 'order' => 2],
                            ['text' => 'I', 'correct' => true, 'order' => 3],
                            ['text' => 'N', 'correct' => true, 'order' => 4],
                            ['text' => 'K', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'offer', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'polite', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'later', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'lunch', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'What phrase would you use to ___ an invitation politely?',
                        'answers' => [
                            ['text' => 'decline', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How would you respond if someone invites you out?',
                        'answers' => [
                            ['text' => 'I\'d love to.', 'correct' => true],
                            ['text' => 'I eat lunch.', 'correct' => false],
                            ['text' => 'I read book.', 'correct' => false],
                            ['text' => 'I sleep.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match invitation responses:',
                        'answers' => [
                            ['text' => 'Schedule', 'correct' => true, 'match_key' => 'calendar', 'media_url' => 'https://img.freepik.com/free-photo/calendar-date-schedule-planning-concept_53876-120751.jpg'],
                            ['text' => 'Accept', 'correct' => true, 'match_key' => 'thumbs_up', 'media_url' => 'https://img.freepik.com/free-photo/thumbs-up-gesture-approval_23-2148807438.jpg'],
                            ['text' => 'Decline', 'correct' => true, 'match_key' => 'thumbs_down', 'media_url' => 'https://img.freepik.com/free-photo/thumbs-down-gesture-disapproval_23-2148807439.jpg'],
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
                            ['text' => 'How', 'correct' => true, 'order' => 1],
                            ['text' => 'do', 'correct' => true, 'order' => 2],
                            ['text' => 'you', 'correct' => true, 'order' => 3],
                            ['text' => 'ask', 'correct' => true, 'order' => 4],
                            ['text' => 'for', 'correct' => true, 'order' => 5],
                            ['text' => 'directions?', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/world-map-navigation_23-2148721744.jpg',
                        'answers' => [
                            ['text' => 'M', 'correct' => true, 'order' => 1],
                            ['text' => 'A', 'correct' => true, 'order' => 2],
                            ['text' => 'P', 'correct' => true, 'order' => 3],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What would you say if you didn\'t understand the directions?',
                        'answers' => [
                            ['text' => 'Can you repeat that?', 'correct' => true],
                            ['text' => 'I go home.', 'correct' => false],
                            ['text' => 'I like cats.', 'correct' => false],
                            ['text' => 'I read books.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match direction elements:',
                        'answers' => [
                            ['text' => 'Stop', 'correct' => true, 'match_key' => 'bus_stop', 'media_url' => 'https://img.freepik.com/free-photo/red-stop-sign-traffic_23-2148721880.jpg'],
                            ['text' => 'Turn', 'correct' => true, 'match_key' => 'turn_arrow', 'media_url' => 'https://img.freepik.com/free-photo/person-turning-steering-wheel_23-2148721881.jpg'],
                            ['text' => 'Road', 'correct' => true, 'match_key' => 'road', 'media_url' => 'https://img.freepik.com/free-photo/straight-road-highway_23-2148721882.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'lost', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'ask', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'where', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'help', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'If you are lost, you say "___ help me?"',
                        'answers' => [
                            ['text' => 'Can', 'correct' => true],
                        ]
                    ],
                ];
            }
        }

        // Lesson 2: Past Activities & Experiences
        if ($lesson == 2) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What did you do yesterday?',
                        'answers' => [
                            ['text' => 'I watched TV.', 'correct' => true],
                            ['text' => 'I am happy.', 'correct' => false],
                            ['text' => 'I cooking.', 'correct' => false],
                            ['text' => 'I reading.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match time-related items:',
                        'answers' => [
                            ['text' => 'Time', 'correct' => true, 'match_key' => 'clock', 'media_url' => 'https://img.freepik.com/free-photo/vintage-alarm-clock-wooden-table_23-2148721684.jpg'],
                            ['text' => 'School', 'correct' => true, 'match_key' => 'school', 'media_url' => 'https://img.freepik.com/free-photo/school-building-exterior_23-2148721685.jpg'],
                            ['text' => 'Sleep', 'correct' => true, 'match_key' => 'bed', 'media_url' => 'https://img.freepik.com/free-photo/comfortable-bed-bedroom_23-2148721686.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'played', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'yesterday', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'fun', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'memory', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I ___ up at 7 AM yesterday.',
                        'answers' => [
                            ['text' => 'woke', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Where', 'correct' => true, 'order' => 1],
                            ['text' => 'were', 'correct' => true, 'order' => 2],
                            ['text' => 'you', 'correct' => true, 'order' => 3],
                            ['text' => 'last', 'correct' => true, 'order' => 4],
                            ['text' => 'weekend?', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/tropical-beach-paradise_23-2148721745.jpg',
                        'answers' => [
                            ['text' => 'B', 'correct' => true, 'order' => 1],
                            ['text' => 'E', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'C', 'correct' => true, 'order' => 4],
                            ['text' => 'H', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Did you like where you were yesterday?',
                        'answers' => [
                            ['text' => 'Yes, I did.', 'correct' => true],
                            ['text' => 'No, I am.', 'correct' => false],
                            ['text' => 'Yes, I cooking.', 'correct' => false],
                            ['text' => 'No, I reading.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match emotions:',
                        'answers' => [
                            ['text' => 'Enjoyed', 'correct' => true, 'match_key' => 'happy', 'media_url' => 'https://img.freepik.com/free-photo/person-enjoying-happy-moment_23-2148721883.jpg'],
                            ['text' => 'Didn\'t', 'correct' => true, 'match_key' => 'sad', 'media_url' => 'https://img.freepik.com/free-photo/person-showing-negative-emotion_23-2148721884.jpg'],
                            ['text' => 'Thought', 'correct' => true, 'match_key' => 'thinking', 'media_url' => 'https://img.freepik.com/free-photo/person-deep-in-thought_23-2148721885.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'described', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'favorite', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'time', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'when', 'correct' => true, 'match_key' => 'Adverb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'How would you ___ a fun experience?',
                        'answers' => [
                            ['text' => 'describe', 'correct' => true],
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
                            ['text' => 'fun', 'correct' => true, 'order' => 4],
                            ['text' => 'at', 'correct' => true, 'order' => 5],
                            ['text' => 'the', 'correct' => true, 'order' => 6],
                            ['text' => 'party?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/birthday-party-celebration_23-2148721742.jpg',
                        'answers' => [
                            ['text' => 'P', 'correct' => true, 'order' => 1],
                            ['text' => 'A', 'correct' => true, 'order' => 2],
                            ['text' => 'R', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                            ['text' => 'Y', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you express that you had a good time?',
                        'answers' => [
                            ['text' => 'I had fun.', 'correct' => true],
                            ['text' => 'I have fun.', 'correct' => false],
                            ['text' => 'I have good.', 'correct' => false],
                            ['text' => 'I cooking fun.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match activities:',
                        'answers' => [
                            ['text' => 'Celebrated', 'correct' => true, 'match_key' => 'party', 'media_url' => 'https://img.freepik.com/free-photo/people-celebrating-achievement_23-2148721886.jpg'],
                            ['text' => 'Smiled', 'correct' => true, 'match_key' => 'smile', 'media_url' => 'https://img.freepik.com/free-photo/person-smiling-broadly_23-2148721887.jpg'],
                            ['text' => 'Slept', 'correct' => true, 'match_key' => 'sleep', 'media_url' => 'https://img.freepik.com/free-photo/person-sleeping-peacefully_23-2148721888.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'enjoyed', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'boring', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'recently', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'day', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Did you go out ___ friends last week?',
                        'answers' => [
                            ['text' => 'with', 'correct' => true],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'inquire', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'opinion', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'interesting', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'how', 'correct' => true, 'match_key' => 'Adverb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'How did you ___ the movie?',
                        'answers' => [
                            ['text' => 'find', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What phrase do you use to say you liked a movie?',
                        'answers' => [
                            ['text' => 'I enjoyed it.', 'correct' => true],
                            ['text' => 'I enjoy it.', 'correct' => false],
                            ['text' => 'I enjoying it.', 'correct' => false],
                            ['text' => 'I enjoyable it.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match entertainment types:',
                        'answers' => [
                            ['text' => 'Book', 'correct' => true, 'match_key' => 'book', 'media_url' => 'https://img.freepik.com/free-photo/open-book-library_23-2148721690.jpg'],
                            ['text' => 'Film', 'correct' => true, 'match_key' => 'film', 'media_url' => 'https://img.freepik.com/free-photo/movie-cinema-film-reel_23-2148721691.jpg'],
                            ['text' => 'Music', 'correct' => true, 'match_key' => 'music', 'media_url' => 'https://img.freepik.com/free-photo/headphones-music-listening_23-2148721692.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'A:', 'correct' => true, 'order' => 1],
                            ['text' => 'Did', 'correct' => true, 'order' => 2],
                            ['text' => 'you', 'correct' => true, 'order' => 3],
                            ['text' => 'like', 'correct' => true, 'order' => 4],
                            ['text' => 'your', 'correct' => true, 'order' => 5],
                            ['text' => 'trip?', 'correct' => true, 'order' => 6],
                            ['text' => 'B:', 'correct' => true, 'order' => 7],
                            ['text' => 'Yes,', 'correct' => true, 'order' => 8],
                            ['text' => 'I', 'correct' => true, 'order' => 9],
                            ['text' => 'loved', 'correct' => true, 'order' => 10],
                            ['text' => 'it.', 'correct' => true, 'order' => 11],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/tropical-beach-paradise_23-2148721745.jpg',
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
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'describe', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'favorite', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'place', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'If a friend dislikes something, you say "___ sorry to hear that."',
                        'answers' => [
                            ['text' => 'I\'m', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What question would you ask someone who just finished a meal?',
                        'answers' => [
                            ['text' => 'Did you like it?', 'correct' => true],
                            ['text' => 'Do you eat?', 'correct' => false],
                            ['text' => 'Are you eating?', 'correct' => false],
                            ['text' => 'Will you eat?', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match meal items:',
                        'answers' => [
                            ['text' => 'Meal', 'correct' => true, 'match_key' => 'plate', 'media_url' => 'https://img.freepik.com/free-photo/delicious-meal-plate_23-2148721693.jpg'],
                            ['text' => 'Drink', 'correct' => true, 'match_key' => 'drink', 'media_url' => 'https://img.freepik.com/free-photo/glass-fresh-juice_23-2148721694.jpg'],
                            ['text' => 'Dessert', 'correct' => true, 'match_key' => 'dessert', 'media_url' => 'https://img.freepik.com/free-photo/birthday-cake-with-candles_144627-47294.jpg'],
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
                            ['text' => 'I', 'correct' => true, 'order' => 1],
                            ['text' => 'played', 'correct' => true, 'order' => 2],
                            ['text' => 'soccer,', 'correct' => true, 'order' => 3],
                            ['text' => 'now', 'correct' => true, 'order' => 4],
                            ['text' => 'I', 'correct' => true, 'order' => 5],
                            ['text' => 'play', 'correct' => true, 'order' => 6],
                            ['text' => 'basketball.', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/vintage-alarm-clock-wooden-table_23-2148721684.jpg',
                        'answers' => [
                            ['text' => 'T', 'correct' => true, 'order' => 1],
                            ['text' => 'I', 'correct' => true, 'order' => 2],
                            ['text' => 'M', 'correct' => true, 'order' => 3],
                            ['text' => 'E', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What tense do we use to describe past events?',
                        'answers' => [
                            ['text' => 'Past Simple', 'correct' => true],
                            ['text' => 'Present Simple', 'correct' => false],
                            ['text' => 'Future Simple', 'correct' => false],
                            ['text' => 'Present Perfect', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match time periods:',
                        'answers' => [
                            ['text' => 'Yesterday', 'correct' => true, 'match_key' => 'yesterday', 'media_url' => 'https://img.freepik.com/free-photo/calendar-yesterday-date_23-2148721695.jpg'],
                            ['text' => 'Today', 'correct' => true, 'match_key' => 'today', 'media_url' => 'https://img.freepik.com/free-photo/calendar-today-date_23-2148721696.jpg'],
                            ['text' => 'Tomorrow', 'correct' => true, 'match_key' => 'tomorrow', 'media_url' => 'https://img.freepik.com/free-photo/calendar-tomorrow-date_23-2148721697.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'compare', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'changes', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'over', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'time', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'How do you talk about something you did ___ year?',
                        'answers' => [
                            ['text' => 'last', 'correct' => true],
                        ]
                    ],
                ];
            }
        }

        // Lesson 3: Food and Drink
        if ($lesson == 3) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What would you say if you were ordering at a restaurant?',
                        'answers' => [
                            ['text' => 'I\'d like the steak, please.', 'correct' => true],
                            ['text' => 'I run every day.', 'correct' => false],
                            ['text' => 'I read books.', 'correct' => false],
                            ['text' => 'I drive a car.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match dining utensils:',
                        'answers' => [
                            ['text' => 'Plate', 'correct' => true, 'match_key' => 'plate', 'media_url' => 'https://img.freepik.com/free-photo/white-dinner-plate_23-2148721698.jpg'],
                            ['text' => 'Fork', 'correct' => true, 'match_key' => 'fork', 'media_url' => 'https://img.freepik.com/free-photo/silver-fork-utensil_23-2148721699.jpg'],
                            ['text' => 'Chopsticks', 'correct' => true, 'match_key' => 'chopsticks', 'media_url' => 'https://img.freepik.com/free-photo/wooden-chopsticks-asian_23-2148721700.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'order', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'delicious', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'together', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'dish', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'How do you ask someone what they want ___ eat?',
                        'answers' => [
                            ['text' => 'to', 'correct' => true],
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
                            ['text' => 'dish?', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/delicious-noodle-dish_23-2148721746.jpg',
                        'answers' => [
                            ['text' => 'N', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'O', 'correct' => true, 'order' => 3],
                            ['text' => 'D', 'correct' => true, 'order' => 4],
                            ['text' => 'L', 'correct' => true, 'order' => 5],
                            ['text' => 'E', 'correct' => true, 'order' => 6],
                            ['text' => 'S', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you express dislike for a certain food?',
                        'answers' => [
                            ['text' => 'I don\'t like mushrooms.', 'correct' => true],
                            ['text' => 'I am mushrooms.', 'correct' => false],
                            ['text' => 'I have mushrooms.', 'correct' => false],
                            ['text' => 'I read mushrooms.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match beverages:',
                        'answers' => [
                            ['text' => 'Milk', 'correct' => true, 'match_key' => 'milk', 'media_url' => 'https://img.freepik.com/free-photo/glass-fresh-milk_23-2148721701.jpg'],
                            ['text' => 'Coffee', 'correct' => true, 'match_key' => 'coffee', 'media_url' => 'https://img.freepik.com/free-photo/cup-hot-coffee_23-2148721702.jpg'],
                            ['text' => 'Juice', 'correct' => true, 'match_key' => 'juice', 'media_url' => 'https://img.freepik.com/free-photo/glass-fresh-juice_23-2148721694.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'prefer', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'spicy', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'rarely', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'drink', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I\'d like ___ water, please.',
                        'answers' => [
                            ['text' => 'some', 'correct' => true],
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
                            ['text' => 'Is', 'correct' => true, 'order' => 1],
                            ['text' => 'there', 'correct' => true, 'order' => 2],
                            ['text' => 'a', 'correct' => true, 'order' => 3],
                            ['text' => 'discount?', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/price-tag-shopping_23-2148721747.jpg',
                        'answers' => [
                            ['text' => 'P', 'correct' => true, 'order' => 1],
                            ['text' => 'R', 'correct' => true, 'order' => 2],
                            ['text' => 'I', 'correct' => true, 'order' => 3],
                            ['text' => 'C', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'cost', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'expensive', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'hardly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'money', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'How do you ask ___ the price?',
                        'answers' => [
                            ['text' => 'for', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What is a reasonable price for a meal?',
                        'answers' => [
                            ['text' => 'Twenty dollars.', 'correct' => true],
                            ['text' => 'I like apples.', 'correct' => false],
                            ['text' => 'She is happy.', 'correct' => false],
                            ['text' => 'They run.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match payment methods:',
                        'answers' => [
                            ['text' => 'Receipt', 'correct' => true, 'match_key' => 'receipt', 'media_url' => 'https://img.freepik.com/free-photo/shopping-receipt-paper_23-2148721703.jpg'],
                            ['text' => 'Cash', 'correct' => true, 'match_key' => 'cash', 'media_url' => 'https://img.freepik.com/free-photo/money-cash-bills_23-2148721704.jpg'],
                            ['text' => 'Card', 'correct' => true, 'match_key' => 'card', 'media_url' => 'https://img.freepik.com/free-photo/credit-card-payment_23-2148721705.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you express hunger?',
                        'answers' => [
                            ['text' => 'I\'m hungry.', 'correct' => true],
                            ['text' => 'I\'m tired.', 'correct' => false],
                            ['text' => 'I\'m thirsty.', 'correct' => false],
                            ['text' => 'I\'m happy.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match food-related items:',
                        'answers' => [
                            ['text' => 'Eat', 'correct' => true, 'match_key' => 'plate', 'media_url' => 'https://img.freepik.com/free-photo/person-eating-with-fork_23-2148721889.jpg'],
                            ['text' => 'Tasty', 'correct' => true, 'match_key' => 'tasty', 'media_url' => 'https://img.freepik.com/free-photo/person-enjoying-tasty-food_23-2148721890.jpg'],
                            ['text' => 'Fork', 'correct' => true, 'match_key' => 'fork', 'media_url' => 'https://img.freepik.com/free-photo/fork-ready-to-eat_23-2148721891.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'prefer', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'delicious', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'quickly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'snack', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I ___ prefer pasta.',
                        'answers' => [
                            ['text' => 'would', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Your', 'correct' => true, 'order' => 1],
                            ['text' => 'food', 'correct' => true, 'order' => 2],
                            ['text' => 'is', 'correct' => true, 'order' => 3],
                            ['text' => 'delicious.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/vanilla-ice-cream-cone_23-2148721748.jpg',
                        'answers' => [
                            ['text' => 'I', 'correct' => true, 'order' => 1],
                            ['text' => 'C', 'correct' => true, 'order' => 2],
                            ['text' => 'E', 'correct' => true, 'order' => 3],
                            ['text' => 'C', 'correct' => true, 'order' => 4],
                            ['text' => 'R', 'correct' => true, 'order' => 5],
                            ['text' => 'E', 'correct' => true, 'order' => 6],
                            ['text' => 'A', 'correct' => true, 'order' => 7],
                            ['text' => 'M', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What would you order for dessert?',
                        'answers' => [
                            ['text' => 'Ice cream.', 'correct' => true],
                            ['text' => 'I run.', 'correct' => false],
                            ['text' => 'I drink.', 'correct' => false],
                            ['text' => 'I cook.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match dessert items:',
                        'answers' => [
                            ['text' => 'Strawberry', 'correct' => true, 'match_key' => 'strawberry', 'media_url' => 'https://img.freepik.com/free-photo/fresh-strawberry-fruit_23-2148721708.jpg'],
                            ['text' => 'Chocolate', 'correct' => true, 'match_key' => 'chocolate', 'media_url' => 'https://img.freepik.com/free-photo/dark-chocolate-pieces_23-2148721709.jpg'],
                            ['text' => 'Cookie', 'correct' => true, 'match_key' => 'cookie', 'media_url' => 'https://img.freepik.com/free-photo/chocolate-chip-cookies_23-2148721710.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'share', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'sweet', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'fondly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'allergy', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'If asked about allergies, you say "I am allergic ___ nuts."',
                        'answers' => [
                            ['text' => 'to', 'correct' => true],
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
                            ['text' => 'Waiter:', 'correct' => true, 'order' => 1],
                            ['text' => 'May', 'correct' => true, 'order' => 2],
                            ['text' => 'I', 'correct' => true, 'order' => 3],
                            ['text' => 'take', 'correct' => true, 'order' => 4],
                            ['text' => 'your', 'correct' => true, 'order' => 5],
                            ['text' => 'order?', 'correct' => true, 'order' => 6],
                            ['text' => 'Customer:', 'correct' => true, 'order' => 7],
                            ['text' => 'Yes,', 'correct' => true, 'order' => 8],
                            ['text' => 'please.', 'correct' => true, 'order' => 9],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/restaurant-order-menu_23-2148721749.jpg',
                        'answers' => [
                            ['text' => 'O', 'correct' => true, 'order' => 1],
                            ['text' => 'R', 'correct' => true, 'order' => 2],
                            ['text' => 'D', 'correct' => true, 'order' => 3],
                            ['text' => 'E', 'correct' => true, 'order' => 4],
                            ['text' => 'R', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What phrase may you use when offering a menu?',
                        'answers' => [
                            ['text' => 'Here is the menu.', 'correct' => true],
                            ['text' => 'I like the menu.', 'correct' => false],
                            ['text' => 'I read the menu.', 'correct' => false],
                            ['text' => 'I cook the menu.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match menu items:',
                        'answers' => [
                            ['text' => 'Dessert', 'correct' => true, 'match_key' => 'dessert', 'media_url' => 'https://img.freepik.com/free-photo/birthday-cake-with-candles_144627-47294.jpg'],
                            ['text' => 'Coffee', 'correct' => true, 'match_key' => 'coffee', 'media_url' => 'https://img.freepik.com/free-photo/cup-hot-coffee_23-2148721702.jpg'],
                            ['text' => 'Salad', 'correct' => true, 'match_key' => 'salad', 'media_url' => 'https://img.freepik.com/free-photo/fresh-green-salad_23-2148721711.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'confirm', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'satisfied', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'politely', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'request', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'If a customer changes their mind, you say "___ you like anything else?"',
                        'answers' => [
                            ['text' => 'Would', 'correct' => true],
                        ]
                    ],
                ];
            }
        }

        // Lesson 4: Experiences & Travel
        if ($lesson == 4) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'ever', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'experience', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'tried', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'excited', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Have you ever ___ a new skill?',
                        'answers' => [
                            ['text' => 'learned', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you ask someone about their life experiences?',
                        'answers' => [
                            ['text' => 'Have you ever…?', 'correct' => true],
                            ['text' => 'Do you ever…?', 'correct' => false],
                            ['text' => 'Will you ever…?', 'correct' => false],
                            ['text' => 'Are you ever…?', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match activities:',
                        'answers' => [
                            ['text' => 'Education', 'correct' => true, 'match_key' => 'education', 'media_url' => 'https://img.freepik.com/free-photo/students-studying-classroom_23-2148721712.jpg'],
                            ['text' => 'Art', 'correct' => true, 'match_key' => 'art', 'media_url' => 'https://img.freepik.com/free-photo/artist-painting-canvas_23-2148721713.jpg'],
                            ['text' => 'Game', 'correct' => true, 'match_key' => 'game', 'media_url' => 'https://img.freepik.com/free-photo/people-playing-football_23-2148721714.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Have', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'ever', 'correct' => true, 'order' => 3],
                            ['text' => 'played', 'correct' => true, 'order' => 4],
                            ['text' => 'soccer?', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/surfing-ocean-waves_23-2148721750.jpg',
                        'answers' => [
                            ['text' => 'S', 'correct' => true, 'order' => 1],
                            ['text' => 'U', 'correct' => true, 'order' => 2],
                            ['text' => 'R', 'correct' => true, 'order' => 3],
                            ['text' => 'F', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'shared', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'unique', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'story', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'If someone has never traveled, you say "You should ___ it!"',
                        'answers' => [
                            ['text' => 'try', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What experiences do you want to try in the future?',
                        'answers' => [
                            ['text' => 'Skydiving', 'correct' => true],
                            ['text' => 'Reading', 'correct' => false],
                            ['text' => 'Cooking', 'correct' => false],
                            ['text' => 'Sleeping', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match travel activities:',
                        'answers' => [
                            ['text' => 'Travel', 'correct' => true, 'match_key' => 'travel', 'media_url' => 'https://img.freepik.com/free-photo/person-traveling-with-luggage_23-2148721892.jpg'],
                            ['text' => 'Climb', 'correct' => true, 'match_key' => 'climb', 'media_url' => 'https://img.freepik.com/free-photo/person-climbing-mountain_23-2148721893.jpg'],
                            ['text' => 'Relax', 'correct' => true, 'match_key' => 'relax', 'media_url' => 'https://img.freepik.com/free-photo/person-relaxing-comfortably_23-2148721894.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 2) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How would you confirm a shared experience with someone?',
                        'answers' => [
                            ['text' => 'Actually, I have.', 'correct' => true],
                            ['text' => 'Actually, you have.', 'correct' => false],
                            ['text' => 'Actually, they have.', 'correct' => false],
                            ['text' => 'Actually, we have.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match response types:',
                        'answers' => [
                            ['text' => 'Correct', 'correct' => true, 'match_key' => 'correct', 'media_url' => 'https://img.freepik.com/free-photo/green-check-mark-symbol_23-2148721895.jpg'],
                            ['text' => 'Question', 'correct' => true, 'match_key' => 'question', 'media_url' => 'https://img.freepik.com/free-photo/person-asking-question_23-2148721896.jpg'],
                            ['text' => 'Surprise', 'correct' => true, 'match_key' => 'surprise', 'media_url' => 'https://img.freepik.com/free-photo/person-showing-surprise_23-2148721897.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'confirm', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'surprising', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'recently', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'fact', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I ___ seen that movie.',
                        'answers' => [
                            ['text' => 'have', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Actually,', 'correct' => true, 'order' => 1],
                            ['text' => 'I', 'correct' => true, 'order' => 2],
                            ['text' => 'have!', 'correct' => true, 'order' => 3],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/movie-cinema-film-reel_23-2148721691.jpg',
                        'answers' => [
                            ['text' => 'M', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'V', 'correct' => true, 'order' => 3],
                            ['text' => 'I', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'A:', 'correct' => true, 'order' => 1],
                            ['text' => 'That\'s', 'correct' => true, 'order' => 2],
                            ['text' => 'a', 'correct' => true, 'order' => 3],
                            ['text' => 'very', 'correct' => true, 'order' => 4],
                            ['text' => 'exciting', 'correct' => true, 'order' => 5],
                            ['text' => 'place!', 'correct' => true, 'order' => 6],
                            ['text' => 'B:', 'correct' => true, 'order' => 7],
                            ['text' => 'I', 'correct' => true, 'order' => 8],
                            ['text' => 'know,', 'correct' => true, 'order' => 9],
                            ['text' => 'right?', 'correct' => true, 'order' => 10],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/modern-city-skyline_23-2148721723.jpg',
                        'answers' => [
                            ['text' => 'C', 'correct' => true, 'order' => 1],
                            ['text' => 'I', 'correct' => true, 'order' => 2],
                            ['text' => 'T', 'correct' => true, 'order' => 3],
                            ['text' => 'Y', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'exciting', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'describe', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'enthusiastically', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'destination', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'It\'s a very ___ place!',
                        'answers' => [
                            ['text' => 'exciting', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What questions would you ask about a new city?',
                        'answers' => [
                            ['text' => 'What\'s the culture like?', 'correct' => true],
                            ['text' => 'What\'s your name?', 'correct' => false],
                            ['text' => 'How old are you?', 'correct' => false],
                            ['text' => 'Where is the store?', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match city features:',
                        'answers' => [
                            ['text' => 'Landmark', 'correct' => true, 'match_key' => 'landmark', 'media_url' => 'https://img.freepik.com/free-photo/famous-landmark-building_23-2148721720.jpg'],
                            ['text' => 'Transport', 'correct' => true, 'match_key' => 'transport', 'media_url' => 'https://img.freepik.com/free-photo/city-bus-transportation_23-2148721721.jpg'],
                            ['text' => 'Cuisine', 'correct' => true, 'match_key' => 'cuisine', 'media_url' => 'https://img.freepik.com/free-photo/local-cuisine-restaurant_23-2148721722.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 4) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How would you recommend a big city?',
                        'answers' => [
                            ['text' => 'It\'s a fairly big city.', 'correct' => true],
                            ['text' => 'It\'s a small city.', 'correct' => false],
                            ['text' => 'It\'s a narrow city.', 'correct' => false],
                            ['text' => 'It\'s a tiny city.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match city elements:',
                        'answers' => [
                            ['text' => 'City', 'correct' => true, 'match_key' => 'city', 'media_url' => 'https://img.freepik.com/free-photo/modern-city-skyline_23-2148721723.jpg'],
                            ['text' => 'Park', 'correct' => true, 'match_key' => 'park', 'media_url' => 'https://img.freepik.com/free-photo/green-city-park_23-2148721724.jpg'],
                            ['text' => 'Skyscraper', 'correct' => true, 'match_key' => 'skyscraper', 'media_url' => 'https://img.freepik.com/free-photo/tall-skyscraper-building_23-2148721725.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'compare', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'atmosphere', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'fairly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'modern', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'It\'s a fairly ___ city.',
                        'answers' => [
                            ['text' => 'big', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'A:', 'correct' => true, 'order' => 1],
                            ['text' => 'Which', 'correct' => true, 'order' => 2],
                            ['text' => 'city', 'correct' => true, 'order' => 3],
                            ['text' => 'do', 'correct' => true, 'order' => 4],
                            ['text' => 'you', 'correct' => true, 'order' => 5],
                            ['text' => 'prefer?', 'correct' => true, 'order' => 6],
                            ['text' => 'B:', 'correct' => true, 'order' => 7],
                            ['text' => 'I', 'correct' => true, 'order' => 8],
                            ['text' => 'prefer', 'correct' => true, 'order' => 9],
                            ['text' => 'the', 'correct' => true, 'order' => 10],
                            ['text' => 'big', 'correct' => true, 'order' => 11],
                            ['text' => 'city.', 'correct' => true, 'order' => 12],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/subway-train-station_23-2148721751.jpg',
                        'answers' => [
                            ['text' => 'S', 'correct' => true, 'order' => 1],
                            ['text' => 'U', 'correct' => true, 'order' => 2],
                            ['text' => 'B', 'correct' => true, 'order' => 3],
                            ['text' => 'W', 'correct' => true, 'order' => 4],
                            ['text' => 'A', 'correct' => true, 'order' => 5],
                            ['text' => 'Y', 'correct' => true, 'order' => 6],
                        ]
                    ],
                ];
            }
        }

        // Lesson 5: Numbers and Measurements
        if ($lesson == 5) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'add', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'subtraction', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'quickly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'easy', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'What is ten ___ fifteen?',
                        'answers' => [
                            ['text' => 'plus', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What\'s the perimeter of a rectangle?',
                        'answers' => [
                            ['text' => '2×(length+width)', 'correct' => true],
                            ['text' => 'length×width', 'correct' => false],
                            ['text' => 'length+width', 'correct' => false],
                            ['text' => 'length²', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match math operations:',
                        'answers' => [
                            ['text' => 'Divide', 'correct' => true, 'match_key' => 'divide', 'media_url' => 'https://img.freepik.com/free-photo/division-sign-mathematics_23-2148721898.jpg'],
                            ['text' => 'Multiply', 'correct' => true, 'match_key' => 'multiply', 'media_url' => 'https://img.freepik.com/free-photo/multiplication-sign-math_23-2148721899.jpg'],
                            ['text' => 'Subtract', 'correct' => true, 'match_key' => 'subtract', 'media_url' => 'https://img.freepik.com/free-photo/minus-sign-subtraction_23-2148721900.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => '2x=10,', 'correct' => true, 'order' => 1],
                            ['text' => 'x=5.', 'correct' => true, 'order' => 2],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/numbers-mathematics-concept_23-2148721752.jpg',
                        'answers' => [
                            ['text' => 'N', 'correct' => true, 'order' => 1],
                            ['text' => 'U', 'correct' => true, 'order' => 2],
                            ['text' => 'M', 'correct' => true, 'order' => 3],
                            ['text' => 'B', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                            ['text' => 'R', 'correct' => true, 'order' => 6],
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
                            ['text' => 'How', 'correct' => true, 'order' => 1],
                            ['text' => 'long', 'correct' => true, 'order' => 2],
                            ['text' => 'is', 'correct' => true, 'order' => 3],
                            ['text' => 'it?', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/wooden-ruler-measurement_23-2148721734.jpg',
                        'answers' => [
                            ['text' => 'R', 'correct' => true, 'order' => 1],
                            ['text' => 'U', 'correct' => true, 'order' => 2],
                            ['text' => 'L', 'correct' => true, 'order' => 3],
                            ['text' => 'E', 'correct' => true, 'order' => 4],
                            ['text' => 'R', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'inquire', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'length', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'precisely', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'long', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'What units do you use for measuring ___?',
                        'answers' => [
                            ['text' => 'distance', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Can you explain the order of operations?',
                        'answers' => [
                            ['text' => 'PEMDAS', 'correct' => true],
                            ['text' => 'ABCD', 'correct' => false],
                            ['text' => 'WXYZ', 'correct' => false],
                            ['text' => 'QWERT', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match measurement tools:',
                        'answers' => [
                            ['text' => 'Scale', 'correct' => true, 'match_key' => 'scale', 'media_url' => 'https://img.freepik.com/free-photo/digital-kitchen-scale_23-2148721729.jpg'],
                            ['text' => 'Compass', 'correct' => true, 'match_key' => 'compass', 'media_url' => 'https://img.freepik.com/free-photo/navigation-compass-tool_23-2148721730.jpg'],
                            ['text' => 'Clock', 'correct' => true, 'match_key' => 'clock', 'media_url' => 'https://img.freepik.com/free-photo/vintage-alarm-clock-wooden-table_23-2148721684.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'describe', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'unit', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'precise', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'How would you confirm the ___ of a measurement?',
                        'answers' => [
                            ['text' => 'accuracy', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'A:', 'correct' => true, 'order' => 1],
                            ['text' => 'How', 'correct' => true, 'order' => 2],
                            ['text' => 'much', 'correct' => true, 'order' => 3],
                            ['text' => 'flour', 'correct' => true, 'order' => 4],
                            ['text' => 'do', 'correct' => true, 'order' => 5],
                            ['text' => 'we', 'correct' => true, 'order' => 6],
                            ['text' => 'need?', 'correct' => true, 'order' => 7],
                            ['text' => 'B:', 'correct' => true, 'order' => 8],
                            ['text' => 'Two', 'correct' => true, 'order' => 9],
                            ['text' => 'cups.', 'correct' => true, 'order' => 10],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/silver-spoon-utensil_23-2148721753.jpg',
                        'answers' => [
                            ['text' => 'S', 'correct' => true, 'order' => 1],
                            ['text' => 'P', 'correct' => true, 'order' => 2],
                            ['text' => 'O', 'correct' => true, 'order' => 3],
                            ['text' => 'O', 'correct' => true, 'order' => 4],
                            ['text' => 'N', 'correct' => true, 'order' => 5],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What is a common unit for measuring liquid?',
                        'answers' => [
                            ['text' => 'Liter', 'correct' => true],
                            ['text' => 'Meter', 'correct' => false],
                            ['text' => 'Gram', 'correct' => false],
                            ['text' => 'Celsius', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match liquid measurement tools:',
                        'answers' => [
                            ['text' => 'Thermometer', 'correct' => true, 'match_key' => 'thermometer', 'media_url' => 'https://img.freepik.com/free-photo/medical-thermometer-temperature_23-2148721731.jpg'],
                            ['text' => 'Cup', 'correct' => true, 'match_key' => 'cup', 'media_url' => 'https://img.freepik.com/free-photo/measuring-cup-kitchen_23-2148721732.jpg'],
                            ['text' => 'Milliliter', 'correct' => true, 'match_key' => 'milliliter', 'media_url' => 'https://img.freepik.com/free-photo/graduated-cylinder-measurement_23-2148721733.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'convert', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'liquid', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'easily', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'wet', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'How do you convert ___ units?',
                        'answers' => [
                            ['text' => 'temperature', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'What', 'correct' => true, 'order' => 1],
                            ['text' => 'is', 'correct' => true, 'order' => 2],
                            ['text' => 'the', 'correct' => true, 'order' => 3],
                            ['text' => 'volume', 'correct' => true, 'order' => 4],
                            ['text' => 'of', 'correct' => true, 'order' => 5],
                            ['text' => 'this', 'correct' => true, 'order' => 6],
                            ['text' => 'container?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/glass-bottle-container_23-2148721754.jpg',
                        'answers' => [
                            ['text' => 'B', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'T', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                            ['text' => 'L', 'correct' => true, 'order' => 5],
                            ['text' => 'E', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'measure', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'many', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'size', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'round', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Describe a situation involving measuring for ___.',
                        'answers' => [
                            ['text' => 'shopping', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How often do you use a thermometer?',
                        'answers' => [
                            ['text' => 'Every day', 'correct' => true],
                            ['text' => 'Never', 'correct' => false],
                            ['text' => 'Sometimes', 'correct' => false],
                            ['text' => 'Rarely', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match measurement tools:',
                        'answers' => [
                            ['text' => 'Ruler', 'correct' => true, 'match_key' => 'ruler', 'media_url' => 'https://img.freepik.com/free-photo/wooden-ruler-measurement_23-2148721734.jpg'],
                            ['text' => 'Protractor', 'correct' => true, 'match_key' => 'protractor', 'media_url' => 'https://img.freepik.com/free-photo/geometry-protractor-tool_23-2148721735.jpg'],
                            ['text' => 'Graph', 'correct' => true, 'match_key' => 'graph', 'media_url' => 'https://img.freepik.com/free-photo/mathematical-graph-chart_23-2148721736.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 4) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'differentiate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'mass', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'clearly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'heavy', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'What\'s the difference between weight and ___?',
                        'answers' => [
                            ['text' => 'mass', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you ask for multiple measurements?',
                        'answers' => [
                            ['text' => 'Can I have more sizes?', 'correct' => true],
                            ['text' => 'Can I have more books?', 'correct' => false],
                            ['text' => 'Can I have more water?', 'correct' => false],
                            ['text' => 'Can I have more time?', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match measurement concepts:',
                        'answers' => [
                            ['text' => 'Convert', 'correct' => true, 'match_key' => 'convert', 'media_url' => 'https://img.freepik.com/free-photo/person-converting-units_23-2148721901.jpg'],
                            ['text' => 'Measure', 'correct' => true, 'match_key' => 'measure', 'media_url' => 'https://img.freepik.com/free-photo/person-measuring-with-ruler_23-2148721902.jpg'],
                            ['text' => 'Angle', 'correct' => true, 'match_key' => 'angle', 'media_url' => 'https://img.freepik.com/free-photo/geometric-angle-drawing_23-2148721903.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'A:', 'correct' => true, 'order' => 1],
                            ['text' => 'What', 'correct' => true, 'order' => 2],
                            ['text' => 'shapes', 'correct' => true, 'order' => 3],
                            ['text' => 'do', 'correct' => true, 'order' => 4],
                            ['text' => 'you', 'correct' => true, 'order' => 5],
                            ['text' => 'need?', 'correct' => true, 'order' => 6],
                            ['text' => 'B:', 'correct' => true, 'order' => 7],
                            ['text' => 'Circles', 'correct' => true, 'order' => 8],
                            ['text' => 'and', 'correct' => true, 'order' => 9],
                            ['text' => 'squares.', 'correct' => true, 'order' => 10],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/geometric-triangle-shape_23-2148721755.jpg',
                        'answers' => [
                            ['text' => 'T', 'correct' => true, 'order' => 1],
                            ['text' => 'R', 'correct' => true, 'order' => 2],
                            ['text' => 'I', 'correct' => true, 'order' => 3],
                            ['text' => 'A', 'correct' => true, 'order' => 4],
                            ['text' => 'N', 'correct' => true, 'order' => 5],
                            ['text' => 'G', 'correct' => true, 'order' => 6],
                            ['text' => 'L', 'correct' => true, 'order' => 7],
                            ['text' => 'E', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'ensure', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'often', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'accuracy', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'precise', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'If you need precise information, you ___ ask.',
                        'answers' => [
                            ['text' => 'must', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you express confusion about measurements?',
                        'answers' => [
                            ['text' => 'I\'m not sure.', 'correct' => true],
                            ['text' => 'I\'m not want.', 'correct' => false],
                            ['text' => 'I\'m not read.', 'correct' => false],
                            ['text' => 'I\'m not cook.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match response types:',
                        'answers' => [
                            ['text' => 'Confusion', 'correct' => true, 'match_key' => 'confusion', 'media_url' => 'https://img.freepik.com/free-photo/confused-person-expression_23-2148721740.jpg'],
                            ['text' => 'Question', 'correct' => true, 'match_key' => 'question', 'media_url' => 'https://img.freepik.com/free-vector/question-mark-sign-brush-stroke-grunge-style_78370-4632.jpg'],
                            ['text' => 'Notes', 'correct' => true, 'match_key' => 'notes', 'media_url' => 'https://img.freepik.com/free-photo/notebook-writing-notes_23-2148721741.jpg'],
                        ]
                    ],
                ];
            }
        }

        return [];
    }
}
