<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use App\Models\LessonPart;

class A3LevelQuestionsSeeder extends Seeder
{
    public function run()
    {
        // Get A3 lesson parts
        $a3LessonParts = LessonPart::where('level', 'A3')->get();
        
        foreach ($a3LessonParts as $lessonPart) {
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

        // Lesson 1: Advanced Greetings & Communication
        if ($lesson == 1) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which greeting is formal?',
                        'answers' => [
                            ['text' => 'Good morning, Sir.', 'correct' => true],
                            ['text' => 'Yo!', 'correct' => false],
                            ['text' => 'Hey!', 'correct' => false],
                            ['text' => 'Hiya!', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match greetings:',
                        'answers' => [
                            ['text' => 'Hello', 'correct' => true, 'match_key' => 'wave', 'media_url' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=300&fit=crop'],
                            ['text' => 'Hi', 'correct' => true, 'match_key' => 'person_raising_hand', 'media_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop'],
                            ['text' => 'Nice to meet you', 'correct' => true, 'match_key' => 'handshake', 'media_url' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=400&h=300&fit=crop'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'greet', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'formal', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'politely', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'salutation', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => '___ morning, everyone.',
                        'answers' => [
                            ['text' => 'Good', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Pleasure', 'correct' => true, 'order' => 1],
                            ['text' => 'to', 'correct' => true, 'order' => 2],
                            ['text' => 'meet', 'correct' => true, 'order' => 3],
                            ['text' => 'you.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/business-meeting-handshake_23-2148721786.jpg',
                        'answers' => [
                            ['text' => 'M', 'correct' => true, 'order' => 1],
                            ['text' => 'E', 'correct' => true, 'order' => 2],
                            ['text' => 'E', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'introduce', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'courteous', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'formally', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'introduction', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'It\'s ___ to see you again.',
                        'answers' => [
                            ['text' => 'nice', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase closes a formal letter?',
                        'answers' => [
                            ['text' => 'Sincerely', 'correct' => true],
                            ['text' => 'Yo', 'correct' => false],
                            ['text' => 'See ya', 'correct' => false],
                            ['text' => 'Cheers', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match communication types:',
                        'answers' => [
                            ['text' => 'Email', 'correct' => true, 'match_key' => 'email', 'media_url' => 'https://images.unsplash.com/photo-1596526131083-e8c633c948d2?w=400&h=300&fit=crop'],
                            ['text' => 'Letter', 'correct' => true, 'match_key' => 'letter', 'media_url' => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=400&h=300&fit=crop'],
                            ['text' => 'Note', 'correct' => true, 'match_key' => 'note', 'media_url' => 'https://images.unsplash.com/photo-1517842645767-c639042777db?w=400&h=300&fit=crop'],
                        ]
                    ],
                ];
            }
            if ($part == 2) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What\'s a polite way to share an opinion?',
                        'answers' => [
                            ['text' => 'I believe that…', 'correct' => true],
                            ['text' => 'You must…', 'correct' => false],
                            ['text' => 'Do this!', 'correct' => false],
                            ['text' => 'Listen to me!', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match communication actions:',
                        'answers' => [
                            ['text' => 'Speak', 'correct' => true, 'match_key' => 'speak', 'media_url' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=400&h=300&fit=crop'],
                            ['text' => 'Think', 'correct' => true, 'match_key' => 'think', 'media_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop'],
                            ['text' => 'Opinion', 'correct' => true, 'match_key' => 'opinion', 'media_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=300&fit=crop'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'state', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'different', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'clearly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'thought', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'In my ___, this is best.',
                        'answers' => [
                            ['text' => 'opinion', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'I', 'correct' => true, 'order' => 1],
                            ['text' => 'think', 'correct' => true, 'order' => 2],
                            ['text' => 'so.', 'correct' => true, 'order' => 3],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/lightbulb-idea-concept_23-2148721763.jpg',
                        'answers' => [
                            ['text' => 'I', 'correct' => true, 'order' => 1],
                            ['text' => 'D', 'correct' => true, 'order' => 2],
                            ['text' => 'E', 'correct' => true, 'order' => 3],
                            ['text' => 'A', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'argue', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'honest', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'frankly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'belief', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I totally ___.',
                        'answers' => [
                            ['text' => 'agree', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'How do you disagree politely?',
                        'answers' => [
                            ['text' => 'I see your point, but…', 'correct' => true],
                            ['text' => 'You\'re wrong!', 'correct' => false],
                            ['text' => 'Shut up!', 'correct' => false],
                            ['text' => 'No!', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match opinion responses:',
                        'answers' => [
                            ['text' => 'Agree', 'correct' => true, 'match_key' => 'thumbs_up', 'media_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop'],
                            ['text' => 'Disagree', 'correct' => true, 'match_key' => 'thumbs_down', 'media_url' => 'https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?w=400&h=300&fit=crop'],
                            ['text' => 'Neutral', 'correct' => true, 'match_key' => 'shrug', 'media_url' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=300&fit=crop'],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase suggests an idea?',
                        'answers' => [
                            ['text' => 'How about we…', 'correct' => true],
                            ['text' => 'You must…', 'correct' => false],
                            ['text' => 'You will…', 'correct' => false],
                            ['text' => 'I order you to…', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match suggestion elements:',
                        'answers' => [
                            ['text' => 'Suggestion', 'correct' => true, 'match_key' => 'lightbulb', 'media_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop'],
                            ['text' => 'Plan', 'correct' => true, 'match_key' => 'plan', 'media_url' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=400&h=300&fit=crop'],
                            ['text' => 'Cooperation', 'correct' => true, 'match_key' => 'handshake', 'media_url' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=400&h=300&fit=crop'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'recommend', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'helpful', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'usefully', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'proposal', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => '___ we try this?',
                        'answers' => [
                            ['text' => 'Shall', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Shall', 'correct' => true, 'order' => 1],
                            ['text' => 'we', 'correct' => true, 'order' => 2],
                            ['text' => 'go', 'correct' => true, 'order' => 3],
                            ['text' => 'out?', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/business-planning-strategy_23-2148721764.jpg',
                        'answers' => [
                            ['text' => 'P', 'correct' => true, 'order' => 1],
                            ['text' => 'L', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'N', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'encourage', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'practical', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'actively', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'idea', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I ___ we leave early.',
                        'answers' => [
                            ['text' => 'suggest', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is NOT a suggestion?',
                        'answers' => [
                            ['text' => 'You must!', 'correct' => true],
                            ['text' => 'Why don\'t we…?', 'correct' => false],
                            ['text' => 'Let\'s…', 'correct' => false],
                            ['text' => 'How about…?', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match suggestion actions:',
                        'answers' => [
                            ['text' => 'Offer', 'correct' => true, 'match_key' => 'offer', 'media_url' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&h=300&fit=crop'],
                            ['text' => 'Guide', 'correct' => true, 'match_key' => 'guide', 'media_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop'],
                            ['text' => 'Schedule', 'correct' => true, 'match_key' => 'schedule', 'media_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop'],
                        ]
                    ],
                ];
            }
            if ($part == 4) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a first conditional?',
                        'answers' => [
                            ['text' => 'If it rains, I\'ll stay home.', 'correct' => true],
                            ['text' => 'I go home.', 'correct' => false],
                            ['text' => 'It rain, I stay.', 'correct' => false],
                            ['text' => 'When it raining.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match weather conditions:',
                        'answers' => [
                            ['text' => 'Rain', 'correct' => true, 'match_key' => 'rain', 'media_url' => 'https://images.unsplash.com/photo-1515694346937-94d85e41e6f0?w=400&h=300&fit=crop'],
                            ['text' => 'Home', 'correct' => true, 'match_key' => 'home', 'media_url' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=400&h=300&fit=crop'],
                            ['text' => 'Sun', 'correct' => true, 'match_key' => 'sun', 'media_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'depend', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'conditional', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'probably', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'situation', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => '___ you call, I\'ll answer.',
                        'answers' => [
                            ['text' => 'If', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'If', 'correct' => true, 'order' => 1],
                            ['text' => 'she', 'correct' => true, 'order' => 2],
                            ['text' => 'comes,', 'correct' => true, 'order' => 3],
                            ['text' => 'I', 'correct' => true, 'order' => 4],
                            ['text' => 'will', 'correct' => true, 'order' => 5],
                            ['text' => 'help.', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/metal-chain-links_23-2148721787.jpg',
                        'answers' => [
                            ['text' => 'C', 'correct' => true, 'order' => 1],
                            ['text' => 'H', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'I', 'correct' => true, 'order' => 4],
                            ['text' => 'N', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'connect', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'possible', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'possibly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'result', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'If you ___ hard, you\'ll pass.',
                        'answers' => [
                            ['text' => 'study', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a zero conditional?',
                        'answers' => [
                            ['text' => 'If you heat ice, it melts.', 'correct' => true],
                            ['text' => 'If you heated ice, it would melt.', 'correct' => false],
                            ['text' => 'If you heat ice, it melting.', 'correct' => false],
                            ['text' => 'If you heat ice, it melt.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match states of matter:',
                        'answers' => [
                            ['text' => 'Ice', 'correct' => true, 'match_key' => 'ice', 'media_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop'],
                            ['text' => 'Heat', 'correct' => true, 'match_key' => 'heat', 'media_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop'],
                            ['text' => 'Water', 'correct' => true, 'match_key' => 'water', 'media_url' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400&h=300&fit=crop'],
                        ]
                    ],
                ];
            }
        }

        // Lesson 2: Professional Communication
        if ($lesson == 2) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is the most polite way to ask for information?',
                        'answers' => [
                            ['text' => 'Could you please send the report?', 'correct' => true],
                            ['text' => 'Give me the report.', 'correct' => false],
                            ['text' => 'Send the report now.', 'correct' => false],
                            ['text' => 'I want the report.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match formal request elements:',
                        'answers' => [
                            ['text' => 'Please', 'correct' => true, 'match_key' => 'please', 'media_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop'],
                            ['text' => 'Document', 'correct' => true, 'match_key' => 'document', 'media_url' => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=400&h=300&fit=crop'],
                            ['text' => 'Email', 'correct' => true, 'match_key' => 'email', 'media_url' => 'https://images.unsplash.com/photo-1596526131083-e8c633c948d2?w=400&h=300&fit=crop'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'could', 'correct' => true, 'match_key' => 'Modal Verb'],
                            ['text' => 'kindly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'request', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'provide', 'correct' => true, 'match_key' => 'Verb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Would you ___ me your feedback?',
                        'answers' => [
                            ['text' => 'share', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Could', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'please', 'correct' => true, 'order' => 3],
                            ['text' => 'send', 'correct' => true, 'order' => 4],
                            ['text' => 'me', 'correct' => true, 'order' => 5],
                            ['text' => 'the', 'correct' => true, 'order' => 6],
                            ['text' => 'file?', 'correct' => true, 'order' => 7],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/computer-file-document_23-2148721788.jpg',
                        'answers' => [
                            ['text' => 'F', 'correct' => true, 'order' => 1],
                            ['text' => 'I', 'correct' => true, 'order' => 2],
                            ['text' => 'L', 'correct' => true, 'order' => 3],
                            ['text' => 'E', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'submit', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'urgent', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'promptly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'deadline', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Please ___ this by Friday.',
                        'answers' => [
                            ['text' => 'complete', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase offers assistance?',
                        'answers' => [
                            ['text' => 'Let me know if you need help.', 'correct' => true],
                            ['text' => 'Do it yourself.', 'correct' => false],
                            ['text' => 'I don\'t care.', 'correct' => false],
                            ['text' => 'Figure it out.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match assistance elements:',
                        'answers' => [
                            ['text' => 'Help', 'correct' => true, 'match_key' => 'help', 'media_url' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=400&h=300&fit=crop'],
                            ['text' => 'Call', 'correct' => true, 'match_key' => 'call', 'media_url' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&h=300&fit=crop'],
                            ['text' => 'Stop', 'correct' => true, 'match_key' => 'stop', 'media_url' => 'https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?w=400&h=300&fit=crop'],
                        ]
                    ],
                ];
            }
            if ($part == 2) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a good opening in negotiation?',
                        'answers' => [
                            ['text' => 'I appreciate your proposal.', 'correct' => true],
                            ['text' => 'We must accept your price.', 'correct' => false],
                            ['text' => 'This is unacceptable.', 'correct' => false],
                            ['text' => 'No room for discussion.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match negotiation elements:',
                        'answers' => [
                            ['text' => 'Agreement', 'correct' => true, 'match_key' => 'agreement', 'media_url' => 'https://img.freepik.com/free-photo/business-handshake-meeting_23-2148721757.jpg'],
                            ['text' => 'Business', 'correct' => true, 'match_key' => 'business', 'media_url' => 'https://img.freepik.com/free-photo/business-meeting-office_23-2148721775.jpg'],
                            ['text' => 'Price', 'correct' => true, 'match_key' => 'price', 'media_url' => 'https://img.freepik.com/free-photo/price-tag-shopping_23-2148721747.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'offer', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'counter', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'flexible', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'honestly', 'correct' => true, 'match_key' => 'Adverb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We are ___ to adjust terms.',
                        'answers' => [
                            ['text' => 'willing', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'can', 'correct' => true, 'order' => 2],
                            ['text' => 'reach', 'correct' => true, 'order' => 3],
                            ['text' => 'agreeable', 'correct' => true, 'order' => 4],
                            ['text' => 'terms.', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/business-chart-graph_23-2148721789.jpg',
                        'answers' => [
                            ['text' => 'C', 'correct' => true, 'order' => 1],
                            ['text' => 'H', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'R', 'correct' => true, 'order' => 4],
                            ['text' => 'T', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'negotiate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'mutual', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'tactfully', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'benefit', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Let\'s ___ on a fair price.',
                        'answers' => [
                            ['text' => 'settle', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase softens a refusal?',
                        'answers' => [
                            ['text' => 'I\'m afraid that won\'t be possible.', 'correct' => true],
                            ['text' => 'No way.', 'correct' => false],
                            ['text' => 'Never.', 'correct' => false],
                            ['text' => 'Impossible.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match response types:',
                        'answers' => [
                            ['text' => 'Refuse', 'correct' => true, 'match_key' => 'refuse', 'media_url' => 'https://img.freepik.com/free-photo/thumbs-down-gesture-disapproval_23-2148807439.jpg'],
                            ['text' => 'Accept', 'correct' => true, 'match_key' => 'accept', 'media_url' => 'https://img.freepik.com/free-photo/thumbs-up-gesture-approval_23-2148807438.jpg'],
                            ['text' => 'Maybe', 'correct' => true, 'match_key' => 'maybe', 'media_url' => 'https://img.freepik.com/free-photo/uncertain-maybe-gesture_23-2148721776.jpg'],
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
                            ['text' => 'convince', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'persuasive', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'compellingly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'argument', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'The data ___ the importance of change.',
                        'answers' => [
                            ['text' => 'highlights', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which opening draws the reader?',
                        'answers' => [
                            ['text' => 'Imagine a world where…', 'correct' => true],
                            ['text' => 'Once upon a time…', 'correct' => false],
                            ['text' => 'Dear Sir/Madam.', 'correct' => false],
                            ['text' => 'I hope this finds you well.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match persuasive elements:',
                        'answers' => [
                            ['text' => 'Logic', 'correct' => true, 'match_key' => 'logic', 'media_url' => 'https://img.freepik.com/free-photo/logical-thinking-concept_23-2148721777.jpg'],
                            ['text' => 'Emotion', 'correct' => true, 'match_key' => 'emotion', 'media_url' => 'https://img.freepik.com/free-photo/emotional-expression-face_23-2148721778.jpg'],
                            ['text' => 'Evidence', 'correct' => true, 'match_key' => 'evidence', 'media_url' => 'https://img.freepik.com/free-photo/evidence-data-chart_23-2148721779.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'What', 'correct' => true, 'order' => 1],
                            ['text' => 'would', 'correct' => true, 'order' => 2],
                            ['text' => 'you', 'correct' => true, 'order' => 3],
                            ['text' => 'believe', 'correct' => true, 'order' => 4],
                            ['text' => 'if', 'correct' => true, 'order' => 5],
                            ['text' => 'I', 'correct' => true, 'order' => 6],
                            ['text' => 'told', 'correct' => true, 'order' => 7],
                            ['text' => 'you?', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/writing-document-paper_23-2148721790.jpg',
                        'answers' => [
                            ['text' => 'W', 'correct' => true, 'order' => 1],
                            ['text' => 'R', 'correct' => true, 'order' => 2],
                            ['text' => 'I', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'elaborate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'concise', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'clearly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'persuasion', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Please consider the ___ above.',
                        'answers' => [
                            ['text' => 'reasons', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase emphasizes urgency?',
                        'answers' => [
                            ['text' => 'Time is of the essence.', 'correct' => true],
                            ['text' => 'At your convenience.', 'correct' => false],
                            ['text' => 'There\'s no rush.', 'correct' => false],
                            ['text' => 'Whenever possible.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match writing elements:',
                        'answers' => [
                            ['text' => 'Urgency', 'correct' => true, 'match_key' => 'urgency', 'media_url' => 'https://img.freepik.com/free-photo/urgent-alarm-clock_23-2148721780.jpg'],
                            ['text' => 'Detail', 'correct' => true, 'match_key' => 'detail', 'media_url' => 'https://img.freepik.com/free-photo/detailed-information-document_23-2148721781.jpg'],
                            ['text' => 'Tone', 'correct' => true, 'match_key' => 'tone', 'media_url' => 'https://img.freepik.com/free-photo/communication-tone-voice_23-2148721782.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 4) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase is diplomatic when disagreeing?',
                        'answers' => [
                            ['text' => 'I see your point, however…', 'correct' => true],
                            ['text' => 'You\'re wrong.', 'correct' => false],
                            ['text' => 'That makes no sense.', 'correct' => false],
                            ['text' => 'Stop it.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match diplomatic elements:',
                        'answers' => [
                            ['text' => 'Diplomacy', 'correct' => true, 'match_key' => 'diplomacy', 'media_url' => 'https://img.freepik.com/free-photo/diplomatic-meeting-handshake_23-2148721783.jpg'],
                            ['text' => 'Respect', 'correct' => true, 'match_key' => 'respect', 'media_url' => 'https://img.freepik.com/free-photo/respectful-bow-gesture_23-2148721784.jpg'],
                            ['text' => 'Caution', 'correct' => true, 'match_key' => 'caution', 'media_url' => 'https://img.freepik.com/free-photo/caution-warning-sign_23-2148721785.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'However', 'correct' => true, 'match_key' => 'Conjunction'],
                            ['text' => 'politeness', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'tactfully', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'acknowledge', 'correct' => true, 'match_key' => 'Verb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We ___ appreciate your feedback.',
                        'answers' => [
                            ['text' => 'sincerely', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'appreciate', 'correct' => true, 'order' => 2],
                            ['text' => 'and', 'correct' => true, 'order' => 3],
                            ['text' => 'understand', 'correct' => true, 'order' => 4],
                            ['text' => 'your', 'correct' => true, 'order' => 5],
                            ['text' => 'concerns.', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/peace-dove-symbol_23-2148721791.jpg',
                        'answers' => [
                            ['text' => 'P', 'correct' => true, 'order' => 1],
                            ['text' => 'E', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'C', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'mediate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'neutral', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'discreetly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'compromise', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Let\'s ___ find a solution together.',
                        'answers' => [
                            ['text' => 'collaboratively', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which closing is diplomatic?',
                        'answers' => [
                            ['text' => 'Kind regards', 'correct' => true],
                            ['text' => 'Bye.', 'correct' => false],
                            ['text' => 'Later.', 'correct' => false],
                            ['text' => 'See ya.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match formal elements:',
                        'answers' => [
                            ['text' => 'Document', 'correct' => true, 'match_key' => 'document', 'media_url' => 'https://img.freepik.com/free-photo/business-document-paper_23-2148721772.jpg'],
                            ['text' => 'Signature', 'correct' => true, 'match_key' => 'signature', 'media_url' => 'https://img.freepik.com/free-photo/signature-document-signing_23-2148721799.jpg'],
                            ['text' => 'Date', 'correct' => true, 'match_key' => 'date', 'media_url' => 'https://img.freepik.com/free-photo/calendar-date-schedule-planning-concept_53876-120751.jpg'],
                        ]
                    ],
                ];
            }
        }

        // Lesson 3: Business Communication
        if ($lesson == 3) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which subject line is appropriate for a formal email?',
                        'answers' => [
                            ['text' => 'Meeting Agenda for March 5', 'correct' => true],
                            ['text' => 'Hey, check this out', 'correct' => false],
                            ['text' => 'What\'s up?', 'correct' => false],
                            ['text' => 'Yo!', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match email elements:',
                        'answers' => [
                            ['text' => 'Email', 'correct' => true, 'match_key' => 'email', 'media_url' => 'https://img.freepik.com/free-photo/email-communication-technology_23-2148721758.jpg'],
                            ['text' => 'Attachment', 'correct' => true, 'match_key' => 'attachment', 'media_url' => 'https://img.freepik.com/free-photo/file-attachment-document_23-2148721800.jpg'],
                            ['text' => 'Location', 'correct' => true, 'match_key' => 'location', 'media_url' => 'https://img.freepik.com/free-photo/map-location-pin_23-2148721801.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'Dear', 'correct' => true, 'match_key' => 'Greeting'],
                            ['text' => 'Sincerely', 'correct' => true, 'match_key' => 'Closing'],
                            ['text' => 'Kindly', 'correct' => true, 'match_key' => 'Tone adverb'],
                            ['text' => 'Cc', 'correct' => true, 'match_key' => 'Email function'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Please find the report ___.',
                        'answers' => [
                            ['text' => 'attached', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Would', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'kindly', 'correct' => true, 'order' => 3],
                            ['text' => 'review', 'correct' => true, 'order' => 4],
                            ['text' => 'this,', 'correct' => true, 'order' => 5],
                            ['text' => 'please?', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/document-file-format_23-2148721792.jpg',
                        'answers' => [
                            ['text' => 'D', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'C', 'correct' => true, 'order' => 3],
                            ['text' => 'X', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'forward', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'urgent', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'promptly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'recipient', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I look forward to your ___.',
                        'answers' => [
                            ['text' => 'response', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which sign-off is most formal?',
                        'answers' => [
                            ['text' => 'Regards,', 'correct' => true],
                            ['text' => 'Cheers', 'correct' => false],
                            ['text' => 'Best,', 'correct' => false],
                            ['text' => 'Thanks!', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match business elements:',
                        'answers' => [
                            ['text' => 'Agenda', 'correct' => true, 'match_key' => 'agenda', 'media_url' => 'https://img.freepik.com/free-photo/business-agenda-meeting-plan_23-2148721853.jpg'],
                            ['text' => 'Schedule', 'correct' => true, 'match_key' => 'schedule', 'media_url' => 'https://img.freepik.com/free-photo/calendar-date-schedule-planning-concept_53876-120751.jpg'],
                            ['text' => 'Note', 'correct' => true, 'match_key' => 'note', 'media_url' => 'https://img.freepik.com/free-photo/notebook-writing-notes_23-2148721741.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 2) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'slides', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'engage', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'professionally', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'dynamic', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Let me ___ your attention to this chart.',
                        'answers' => [
                            ['text' => 'draw', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase introduces a topic?',
                        'answers' => [
                            ['text' => 'Moving on to…', 'correct' => true],
                            ['text' => 'Stop that.', 'correct' => false],
                            ['text' => 'No comment.', 'correct' => false],
                            ['text' => 'Whatever.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match presentation elements:',
                        'answers' => [
                            ['text' => 'Present', 'correct' => true, 'match_key' => 'present', 'media_url' => 'https://img.freepik.com/free-photo/person-presenting-to-audience_23-2148721913.jpg'],
                            ['text' => 'Data', 'correct' => true, 'match_key' => 'data', 'media_url' => 'https://img.freepik.com/free-photo/data-charts-on-screen_23-2148721914.jpg'],
                            ['text' => 'Visual', 'correct' => true, 'match_key' => 'visual', 'media_url' => 'https://img.freepik.com/free-photo/visual-chart-presentation_23-2148721915.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'As', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'can', 'correct' => true, 'order' => 3],
                            ['text' => 'see.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/business-chart-graph_23-2148721789.jpg',
                        'answers' => [
                            ['text' => 'C', 'correct' => true, 'order' => 1],
                            ['text' => 'H', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'R', 'correct' => true, 'order' => 4],
                            ['text' => 'T', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'highlight', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'significant', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'clearly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'overview', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'This slide ___ our quarterly results.',
                        'answers' => [
                            ['text' => 'shows', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase invites questions?',
                        'answers' => [
                            ['text' => 'Any questions?', 'correct' => true],
                            ['text' => 'Stop asking.', 'correct' => false],
                            ['text' => 'Nope.', 'correct' => false],
                            ['text' => 'We\'re done.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match interaction elements:',
                        'answers' => [
                            ['text' => 'Question', 'correct' => true, 'match_key' => 'question', 'media_url' => 'https://img.freepik.com/free-photo/person-asking-question-meeting_23-2148721910.jpg'],
                            ['text' => 'Listen', 'correct' => true, 'match_key' => 'listen', 'media_url' => 'https://img.freepik.com/free-photo/person-listening-attentively_23-2148721911.jpg'],
                            ['text' => 'Raise hand', 'correct' => true, 'match_key' => 'raise_hand', 'media_url' => 'https://img.freepik.com/free-photo/student-raising-hand-class_23-2148721912.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which header is typical for a report section?',
                        'answers' => [
                            ['text' => 'Executive Summary', 'correct' => true],
                            ['text' => 'The Fun Stuff', 'correct' => false],
                            ['text' => 'Random Notes', 'correct' => false],
                            ['text' => 'Todo', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match report elements:',
                        'answers' => [
                            ['text' => 'Summary', 'correct' => true, 'match_key' => 'summary', 'media_url' => 'https://img.freepik.com/free-photo/business-summary-report_23-2148721859.jpg'],
                            ['text' => 'Trends', 'correct' => true, 'match_key' => 'trends', 'media_url' => 'https://img.freepik.com/free-photo/business-trend-analysis_23-2148721833.jpg'],
                            ['text' => 'Insights', 'correct' => true, 'match_key' => 'insights', 'media_url' => 'https://img.freepik.com/free-photo/lightbulb-idea-concept_23-2148721763.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'analyze', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'comprehensive', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'thoroughly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'conclusion', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'The data ___ a clear pattern.',
                        'answers' => [
                            ['text' => 'reveals', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Present', 'correct' => true, 'order' => 1],
                            ['text' => 'the', 'correct' => true, 'order' => 2],
                            ['text' => 'key', 'correct' => true, 'order' => 3],
                            ['text' => 'findings.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/statistical-graph-chart_23-2148721793.jpg',
                        'answers' => [
                            ['text' => 'G', 'correct' => true, 'order' => 1],
                            ['text' => 'R', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'P', 'correct' => true, 'order' => 4],
                            ['text' => 'H', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'evaluate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'relevant', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'sparingly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'appendix', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Refer to the ___ for details.',
                        'answers' => [
                            ['text' => 'appendix', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which sentence is passive?',
                        'answers' => [
                            ['text' => 'The audit was completed.', 'correct' => true],
                            ['text' => 'We completed the audit.', 'correct' => false],
                            ['text' => 'We are completing the audit.', 'correct' => false],
                            ['text' => 'We will complete the audit.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match evaluation symbols:',
                        'answers' => [
                            ['text' => 'Correct', 'correct' => true, 'match_key' => 'correct', 'media_url' => 'https://img.freepik.com/free-photo/thumbs-up-gesture-approval_23-2148807438.jpg'],
                            ['text' => 'Incorrect', 'correct' => true, 'match_key' => 'incorrect', 'media_url' => 'https://img.freepik.com/free-photo/thumbs-down-gesture-disapproval_23-2148807439.jpg'],
                            ['text' => 'Warning', 'correct' => true, 'match_key' => 'warning', 'media_url' => 'https://img.freepik.com/free-photo/caution-warning-sign_23-2148721785.jpg'],
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
                            ['text' => 'bargain', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'advantage', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'tactfully', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'strategic', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We can ___ a compromise.',
                        'answers' => [
                            ['text' => 'reach', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which opens a counteroffer?',
                        'answers' => [
                            ['text' => 'Could we propose…', 'correct' => true],
                            ['text' => 'Take it or leave it.', 'correct' => false],
                            ['text' => 'No agreement.', 'correct' => false],
                            ['text' => 'We refuse.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match negotiation elements:',
                        'answers' => [
                            ['text' => 'Offer', 'correct' => true, 'match_key' => 'offer', 'media_url' => 'https://img.freepik.com/free-photo/business-offer-proposal_23-2148721765.jpg'],
                            ['text' => 'Terms', 'correct' => true, 'match_key' => 'terms', 'media_url' => 'https://img.freepik.com/free-photo/contract-terms-document_23-2148721860.jpg'],
                            ['text' => 'Deal', 'correct' => true, 'match_key' => 'deal', 'media_url' => 'https://img.freepik.com/free-photo/business-deal-handshake_23-2148721794.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'negotiate', 'correct' => true, 'order' => 2],
                            ['text' => 'in', 'correct' => true, 'order' => 3],
                            ['text' => 'good', 'correct' => true, 'order' => 4],
                            ['text' => 'faith.', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/business-deal-handshake_23-2148721794.jpg',
                        'answers' => [
                            ['text' => 'D', 'correct' => true, 'order' => 1],
                            ['text' => 'E', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'L', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'counterpart', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'amicably', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'negotiate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'fair', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Let\'s ___ terms.',
                        'answers' => [
                            ['text' => 'finalize', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a polite refusal?',
                        'answers' => [
                            ['text' => 'Thank you, but I must decline.', 'correct' => true],
                            ['text' => 'No.', 'correct' => false],
                            ['text' => 'Never.', 'correct' => false],
                            ['text' => 'Impossible.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match decision types:',
                        'answers' => [
                            ['text' => 'Refusal', 'correct' => true, 'match_key' => 'refusal', 'media_url' => 'https://img.freepik.com/free-photo/thumbs-down-gesture-disapproval_23-2148807439.jpg'],
                            ['text' => 'Acceptance', 'correct' => true, 'match_key' => 'acceptance', 'media_url' => 'https://img.freepik.com/free-photo/thumbs-up-gesture-approval_23-2148807438.jpg'],
                            ['text' => 'Consideration', 'correct' => true, 'match_key' => 'consideration', 'media_url' => 'https://img.freepik.com/free-vector/thinking-concept-illustration_114360-1421.jpg'],
                        ]
                    ],
                ];
            }
        }

        // Lesson 4: Leadership & Management
        if ($lesson == 4) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase best describes long-term goals?',
                        'answers' => [
                            ['text' => 'Strategic objectives', 'correct' => true],
                            ['text' => 'Short-term', 'correct' => false],
                            ['text' => 'Quick wins', 'correct' => false],
                            ['text' => 'Ad hoc tasks', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match planning elements:',
                        'answers' => [
                            ['text' => 'Objective', 'correct' => true, 'match_key' => 'objective', 'media_url' => 'https://img.freepik.com/free-photo/business-objective-target_23-2148721861.jpg'],
                            ['text' => 'Timeline', 'correct' => true, 'match_key' => 'timeline', 'media_url' => 'https://img.freepik.com/free-photo/project-timeline-schedule_23-2148721862.jpg'],
                            ['text' => 'Metrics', 'correct' => true, 'match_key' => 'metrics', 'media_url' => 'https://img.freepik.com/free-photo/performance-metrics-dashboard_23-2148721840.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'implement', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'sustainable', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'periodically', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'framework', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We need to ___ the new system by Q3.',
                        'answers' => [
                            ['text' => 'deploy', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Ensure', 'correct' => true, 'order' => 1],
                            ['text' => 'we', 'correct' => true, 'order' => 2],
                            ['text' => 'align', 'correct' => true, 'order' => 3],
                            ['text' => 'stakeholders.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/business-planning-strategy_23-2148721764.jpg',
                        'answers' => [
                            ['text' => 'P', 'correct' => true, 'order' => 1],
                            ['text' => 'L', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'N', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'evaluate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'feasible', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'closely', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'roadmap', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Let\'s ___ risks before proceeding.',
                        'answers' => [
                            ['text' => 'assess', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which best expresses readiness?',
                        'answers' => [
                            ['text' => 'We are prepared.', 'correct' => true],
                            ['text' => 'We will see.', 'correct' => false],
                            ['text' => 'Maybe later.', 'correct' => false],
                            ['text' => 'Not yet.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match management tools:',
                        'answers' => [
                            ['text' => 'Tools', 'correct' => true, 'match_key' => 'tools', 'media_url' => 'https://img.freepik.com/free-photo/project-management-tools_23-2148721822.jpg'],
                            ['text' => 'Checklist', 'correct' => true, 'match_key' => 'checklist', 'media_url' => 'https://img.freepik.com/free-photo/checklist-task-completion_23-2148721813.jpg'],
                            ['text' => 'Deadline', 'correct' => true, 'match_key' => 'deadline', 'media_url' => 'https://img.freepik.com/free-photo/deadline-time-pressure_23-2148721863.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 2) {
                return [
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'mitigate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'critical', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'promptly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'emergency', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We must ___ the issue immediately.',
                        'answers' => [
                            ['text' => 'address', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a containment strategy?',
                        'answers' => [
                            ['text' => 'Isolate the problem.', 'correct' => true],
                            ['text' => 'Let it escalate.', 'correct' => false],
                            ['text' => 'Ignore it.', 'correct' => false],
                            ['text' => 'Postpone.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match crisis elements:',
                        'answers' => [
                            ['text' => 'Alert', 'correct' => true, 'match_key' => 'alert', 'media_url' => 'https://img.freepik.com/free-photo/alert-warning-notification_23-2148721834.jpg'],
                            ['text' => 'Hotline', 'correct' => true, 'match_key' => 'hotline', 'media_url' => 'https://img.freepik.com/free-photo/emergency-hotline-phone_23-2148721864.jpg'],
                            ['text' => 'Report', 'correct' => true, 'match_key' => 'report', 'media_url' => 'https://img.freepik.com/free-photo/business-report-document_23-2148721865.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'coordinate', 'correct' => true, 'order' => 2],
                            ['text' => 'all', 'correct' => true, 'order' => 3],
                            ['text' => 'teams.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/crisis-emergency-alert_23-2148721795.jpg',
                        'answers' => [
                            ['text' => 'C', 'correct' => true, 'order' => 1],
                            ['text' => 'R', 'correct' => true, 'order' => 2],
                            ['text' => 'I', 'correct' => true, 'order' => 3],
                            ['text' => 'S', 'correct' => true, 'order' => 4],
                            ['text' => 'I', 'correct' => true, 'order' => 5],
                            ['text' => 'S', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'contain', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'urgent', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'effectively', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'protocol', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Follow the ___ for this scenario.',
                        'answers' => [
                            ['text' => 'protocol', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which expresses assurance?',
                        'answers' => [
                            ['text' => 'We\'ll handle it.', 'correct' => true],
                            ['text' => 'I doubt it.', 'correct' => false],
                            ['text' => 'Not sure.', 'correct' => false],
                            ['text' => 'Too late.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match outcome types:',
                        'answers' => [
                            ['text' => 'Success', 'correct' => true, 'match_key' => 'success', 'media_url' => 'https://img.freepik.com/free-photo/success-achievement-celebration_23-2148721802.jpg'],
                            ['text' => 'Warning', 'correct' => true, 'match_key' => 'warning', 'media_url' => 'https://img.freepik.com/free-photo/caution-warning-sign_23-2148721785.jpg'],
                            ['text' => 'Failure', 'correct' => true, 'match_key' => 'failure', 'media_url' => 'https://img.freepik.com/free-photo/failure-disappointment-concept_23-2148721803.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which describes participative leadership?',
                        'answers' => [
                            ['text' => 'Inclusive decision-making', 'correct' => true],
                            ['text' => 'Top-down orders', 'correct' => false],
                            ['text' => 'Autocratic rule', 'correct' => false],
                            ['text' => 'Laissez-faire', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match leadership styles:',
                        'answers' => [
                            ['text' => 'Autocratic', 'correct' => true, 'match_key' => 'autocratic', 'media_url' => 'https://img.freepik.com/free-photo/authoritarian-leadership-style_23-2148721866.jpg'],
                            ['text' => 'Collaborative', 'correct' => true, 'match_key' => 'collaborative', 'media_url' => 'https://img.freepik.com/free-photo/team-collaboration-meeting_23-2148721867.jpg'],
                            ['text' => 'Laissez-faire', 'correct' => true, 'match_key' => 'laissez_faire', 'media_url' => 'https://img.freepik.com/free-photo/relaxed-leadership-style_23-2148721868.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'empower', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'visionary', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'actively', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'influence', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Good leaders ___ trust.',
                        'answers' => [
                            ['text' => 'inspire', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'By', 'correct' => true, 'order' => 1],
                            ['text' => 'example,', 'correct' => true, 'order' => 2],
                            ['text' => 'demonstrate', 'correct' => true, 'order' => 3],
                            ['text' => 'leadership.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/leadership-concept-image_23-2148721796.jpg',
                        'answers' => [
                            ['text' => 'L', 'correct' => true, 'order' => 1],
                            ['text' => 'E', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'D', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'mentor', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'assertive', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'clearly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'strategy', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Leaders must ___ decisions swiftly.',
                        'answers' => [
                            ['text' => 'make', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which style delegates most?',
                        'answers' => [
                            ['text' => 'Laissez-faire', 'correct' => true],
                            ['text' => 'Micromanagement', 'correct' => false],
                            ['text' => 'Directive', 'correct' => false],
                            ['text' => 'Transactional', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match leadership qualities:',
                        'answers' => [
                            ['text' => 'Goal-oriented', 'correct' => true, 'match_key' => 'goal_oriented', 'media_url' => 'https://img.freepik.com/free-photo/goal-target-achievement_23-2148721869.jpg'],
                            ['text' => 'Adaptive', 'correct' => true, 'match_key' => 'adaptive', 'media_url' => 'https://img.freepik.com/free-photo/adaptation-flexibility-concept_23-2148721839.jpg'],
                            ['text' => 'Innovative', 'correct' => true, 'match_key' => 'innovative', 'media_url' => 'https://img.freepik.com/free-photo/lightbulb-idea-concept_23-2148721763.jpg'],
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
                            ['text' => 'collaborate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'cohesive', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'regularly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'bonding', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Let\'s ___ a workshop next week.',
                        'answers' => [
                            ['text' => 'organize', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which activity builds trust?',
                        'answers' => [
                            ['text' => 'Problem-solving tasks', 'correct' => true],
                            ['text' => 'Solo work', 'correct' => false],
                            ['text' => 'Ignoring feedback', 'correct' => false],
                            ['text' => 'Late arrivals', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match team activities:',
                        'answers' => [
                            ['text' => 'Exercise', 'correct' => true, 'match_key' => 'exercise', 'media_url' => 'https://img.freepik.com/free-photo/team-building-exercise_23-2148721870.jpg'],
                            ['text' => 'Games', 'correct' => true, 'match_key' => 'games', 'media_url' => 'https://img.freepik.com/free-photo/team-games-activity_23-2148721871.jpg'],
                            ['text' => 'Discussion', 'correct' => true, 'match_key' => 'discussion', 'media_url' => 'https://img.freepik.com/free-photo/team-discussion-meeting_23-2148721872.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Encourage', 'correct' => true, 'order' => 1],
                            ['text' => 'open', 'correct' => true, 'order' => 2],
                            ['text' => 'communication.', 'correct' => true, 'order' => 3],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/team-unity-concept_23-2148721797.jpg',
                        'answers' => [
                            ['text' => 'U', 'correct' => true, 'order' => 1],
                            ['text' => 'N', 'correct' => true, 'order' => 2],
                            ['text' => 'I', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                            ['text' => 'Y', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'facilitate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'interactive', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'periodically', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'workshop', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Share ___ to improve teamwork.',
                        'answers' => [
                            ['text' => 'feedback', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase promotes inclusion?',
                        'answers' => [
                            ['text' => 'Everyone\'s input matters.', 'correct' => true],
                            ['text' => 'Only managers decide.', 'correct' => false],
                            ['text' => 'You must follow me.', 'correct' => false],
                            ['text' => 'I decide.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match team elements:',
                        'answers' => [
                            ['text' => 'Success', 'correct' => true, 'match_key' => 'success', 'media_url' => 'https://img.freepik.com/free-photo/success-achievement-celebration_23-2148721802.jpg'],
                            ['text' => 'Tools', 'correct' => true, 'match_key' => 'tools', 'media_url' => 'https://img.freepik.com/free-photo/project-management-tools_23-2148721822.jpg'],
                            ['text' => 'Voice', 'correct' => true, 'match_key' => 'voice', 'media_url' => 'https://img.freepik.com/free-photo/voice-communication-concept_23-2148721873.jpg'],
                        ]
                    ],
                ];
            }
        }

        // Lesson 5: Advanced Business Topics
        if ($lesson == 5) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which term means "income from investments"?',
                        'answers' => [
                            ['text' => 'Dividend', 'correct' => true],
                            ['text' => 'Equity', 'correct' => false],
                            ['text' => 'Liability', 'correct' => false],
                            ['text' => 'Asset', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match financial terms:',
                        'answers' => [
                            ['text' => 'Revenue', 'correct' => true, 'match_key' => 'revenue', 'media_url' => 'https://img.freepik.com/free-photo/money-cash-currency_23-2148721798.jpg'],
                            ['text' => 'Loss', 'correct' => true, 'match_key' => 'loss', 'media_url' => 'https://img.freepik.com/free-photo/financial-loss-chart_23-2148721804.jpg'],
                            ['text' => 'Profit', 'correct' => true, 'match_key' => 'profit', 'media_url' => 'https://img.freepik.com/free-photo/profit-growth-chart_23-2148721805.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'invest', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'equity', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'volatile', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'steadily', 'correct' => true, 'match_key' => 'Adverb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Our costs ___ by 10%.',
                        'answers' => [
                            ['text' => 'increased', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'optimize', 'correct' => true, 'order' => 3],
                            ['text' => 'capital.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/money-cash-currency_23-2148721798.jpg',
                        'answers' => [
                            ['text' => 'M', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'N', 'correct' => true, 'order' => 3],
                            ['text' => 'E', 'correct' => true, 'order' => 4],
                            ['text' => 'Y', 'correct' => true, 'order' => 5],
                        ]
                    ],
                ];
            }
        }

        return [];
    }
}
