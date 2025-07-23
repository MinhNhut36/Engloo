<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use App\Models\LessonPart;

class TA2LevelQuestionsSeeder extends Seeder
{
    public function run()
    {
        // Get TA2 lesson parts
        $ta2LessonParts = LessonPart::where('level', 'TA 2/6')->get();
        
        foreach ($ta2LessonParts as $lessonPart) {
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

        // Lesson 1: Intensive Communication
        if ($lesson == 1) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What phrase starts a formal presentation?',
                        'answers' => [
                            ['text' => 'Distinguished guests, welcome', 'correct' => true],
                            ['text' => 'Hi everyone!', 'correct' => false],
                            ['text' => 'Yo guys', 'correct' => false],
                            ['text' => 'Hey all', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match presentation elements:',
                        'answers' => [
                            ['text' => 'Speaker intro', 'correct' => true, 'match_key' => 'microphone', 'media_url' => 'https://img.freepik.com/free-photo/speaker-presentation-microphone_23-2148721806.jpg'],
                            ['text' => 'Wave', 'correct' => true, 'match_key' => 'wave', 'media_url' => 'https://img.freepik.com/free-photo/hello-greeting-wave_23-2148721756.jpg'],
                            ['text' => 'Thank you', 'correct' => true, 'match_key' => 'thank_you', 'media_url' => 'https://img.freepik.com/free-photo/thank-you-gratitude-gesture_23-2148721807.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'acknowledge', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'distinguished', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'graciously', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'audience', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'I ___ you for coming today.',
                        'answers' => [
                            ['text' => 'thank', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'It\'s', 'correct' => true, 'order' => 1],
                            ['text' => 'an', 'correct' => true, 'order' => 2],
                            ['text' => 'honor', 'correct' => true, 'order' => 3],
                            ['text' => 'to…', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/honor-award-recognition_23-2148721828.jpg',
                        'answers' => [
                            ['text' => 'H', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'N', 'correct' => true, 'order' => 3],
                            ['text' => 'O', 'correct' => true, 'order' => 4],
                            ['text' => 'R', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'commend', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'prestigious', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'sincerely', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'ceremony', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Welcome to this ___ event.',
                        'answers' => [
                            ['text' => 'prestigious', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase invites applause?',
                        'answers' => [
                            ['text' => 'Let\'s give a round of applause.', 'correct' => true],
                            ['text' => 'Let\'s begin.', 'correct' => false],
                            ['text' => 'Please join me.', 'correct' => false],
                            ['text' => 'Stop clapping.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match event elements:',
                        'answers' => [
                            ['text' => 'Applause', 'correct' => true, 'match_key' => 'applause', 'media_url' => 'https://img.freepik.com/free-photo/audience-applause-clapping_23-2148721808.jpg'],
                            ['text' => 'Microphone', 'correct' => true, 'match_key' => 'microphone', 'media_url' => 'https://img.freepik.com/free-photo/speaker-presentation-microphone_23-2148721806.jpg'],
                            ['text' => 'Celebration', 'correct' => true, 'match_key' => 'celebration', 'media_url' => 'https://img.freepik.com/free-photo/people-celebrating-party_23-2148721689.jpg'],
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
                            ['text' => 'background', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'briefly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'highlight', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'professional', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Allow me to ___ my experience.',
                        'answers' => [
                            ['text' => 'highlight', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase signals the end of an introduction?',
                        'answers' => [
                            ['text' => 'Thank you for your attention.', 'correct' => true],
                            ['text' => 'That\'s all.', 'correct' => false],
                            ['text' => 'Let\'s start.', 'correct' => false],
                            ['text' => 'Goodbye.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match professional elements:',
                        'answers' => [
                            ['text' => 'Education', 'correct' => true, 'match_key' => 'education', 'media_url' => 'https://img.freepik.com/free-photo/students-studying-classroom_23-2148721712.jpg'],
                            ['text' => 'Career', 'correct' => true, 'match_key' => 'career', 'media_url' => 'https://img.freepik.com/free-photo/professional-career-development_23-2148721809.jpg'],
                            ['text' => 'Achievement', 'correct' => true, 'match_key' => 'achievement', 'media_url' => 'https://img.freepik.com/free-photo/success-achievement-celebration_23-2148721802.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'I', 'correct' => true, 'order' => 1],
                            ['text' => 'have', 'correct' => true, 'order' => 2],
                            ['text' => 'over', 'correct' => true, 'order' => 3],
                            ['text' => '10', 'correct' => true, 'order' => 4],
                            ['text' => 'years', 'correct' => true, 'order' => 5],
                            ['text' => 'experience.', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/international-connection-network_23-2148721829.jpg',
                        'answers' => [
                            ['text' => 'I', 'correct' => true, 'order' => 1],
                            ['text' => 'N', 'correct' => true, 'order' => 2],
                            ['text' => 'T', 'correct' => true, 'order' => 3],
                            ['text' => 'E', 'correct' => true, 'order' => 4],
                            ['text' => 'R', 'correct' => true, 'order' => 5],
                            ['text' => 'N', 'correct' => true, 'order' => 6],
                            ['text' => 'A', 'correct' => true, 'order' => 7],
                            ['text' => 'T', 'correct' => true, 'order' => 8],
                            ['text' => 'I', 'correct' => true, 'order' => 9],
                            ['text' => 'O', 'correct' => true, 'order' => 10],
                            ['text' => 'N', 'correct' => true, 'order' => 11],
                            ['text' => 'A', 'correct' => true, 'order' => 12],
                            ['text' => 'L', 'correct' => true, 'order' => 13],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase prompts elaboration?',
                        'answers' => [
                            ['text' => 'Could you elaborate?', 'correct' => true],
                            ['text' => 'Is that it?', 'correct' => false],
                            ['text' => 'Stop there.', 'correct' => false],
                            ['text' => 'Move on.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match questioning elements:',
                        'answers' => [
                            ['text' => 'Question', 'correct' => true, 'match_key' => 'question', 'media_url' => 'https://img.freepik.com/free-vector/question-mark-sign-brush-stroke-grunge-style_78370-4632.jpg'],
                            ['text' => 'Probe', 'correct' => true, 'match_key' => 'probe', 'media_url' => 'https://img.freepik.com/free-photo/investigation-probe-concept_23-2148721810.jpg'],
                            ['text' => 'Reflect', 'correct' => true, 'match_key' => 'reflect', 'media_url' => 'https://img.freepik.com/free-photo/reflection-thinking-concept_23-2148721811.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'clarify', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'insightful', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'thoroughly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'inquiry', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'What ___ do you have?',
                        'answers' => [
                            ['text' => 'concerns', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Could', 'correct' => true, 'order' => 1],
                            ['text' => 'you', 'correct' => true, 'order' => 2],
                            ['text' => 'expand', 'correct' => true, 'order' => 3],
                            ['text' => 'on', 'correct' => true, 'order' => 4],
                            ['text' => 'that?', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/adventure-quest-journey_23-2148721830.jpg',
                        'answers' => [
                            ['text' => 'Q', 'correct' => true, 'order' => 1],
                            ['text' => 'U', 'correct' => true, 'order' => 2],
                            ['text' => 'E', 'correct' => true, 'order' => 3],
                            ['text' => 'S', 'correct' => true, 'order' => 4],
                            ['text' => 'T', 'correct' => true, 'order' => 5],
                            ['text' => 'I', 'correct' => true, 'order' => 6],
                            ['text' => 'O', 'correct' => true, 'order' => 7],
                            ['text' => 'N', 'correct' => true, 'order' => 8],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'investigate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'comprehensive', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'diligently', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'analysis', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Please ___ your thoughts further.',
                        'answers' => [
                            ['text' => 'share', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is an open-ended question?',
                        'answers' => [
                            ['text' => 'What did you think?', 'correct' => true],
                            ['text' => 'Did you like it?', 'correct' => false],
                            ['text' => 'Is it good?', 'correct' => false],
                            ['text' => 'Is that correct?', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match thinking processes:',
                        'answers' => [
                            ['text' => 'Record', 'correct' => true, 'match_key' => 'record', 'media_url' => 'https://img.freepik.com/free-photo/recording-document-data_23-2148721812.jpg'],
                            ['text' => 'Checklist', 'correct' => true, 'match_key' => 'checklist', 'media_url' => 'https://img.freepik.com/free-photo/checklist-task-completion_23-2148721813.jpg'],
                            ['text' => 'Brainstorm', 'correct' => true, 'match_key' => 'brainstorm', 'media_url' => 'https://img.freepik.com/free-photo/brainstorming-ideas-concept_23-2148721814.jpg'],
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
                            ['text' => 'restate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'accurate', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'paraphrase', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'understood', 'correct' => true, 'match_key' => 'Adverb'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Let me ___ that.',
                        'answers' => [
                            ['text' => 'restate', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase asks for confirmation?',
                        'answers' => [
                            ['text' => 'Is that correct?', 'correct' => true],
                            ['text' => 'I don\'t know.', 'correct' => false],
                            ['text' => 'Stop.', 'correct' => false],
                            ['text' => 'Whatever.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match clarification elements:',
                        'answers' => [
                            ['text' => 'Paraphrase', 'correct' => true, 'match_key' => 'paraphrase', 'media_url' => 'https://img.freepik.com/free-photo/paraphrase-rewrite-concept_23-2148721815.jpg'],
                            ['text' => 'Confirm', 'correct' => true, 'match_key' => 'confirm', 'media_url' => 'https://img.freepik.com/free-photo/confirmation-checkmark-approval_23-2148721816.jpg'],
                            ['text' => 'Clarify', 'correct' => true, 'match_key' => 'clarify', 'media_url' => 'https://img.freepik.com/free-photo/clarification-explanation-concept_23-2148721817.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'So', 'correct' => true, 'order' => 1],
                            ['text' => 'you\'re', 'correct' => true, 'order' => 2],
                            ['text' => 'saying', 'correct' => true, 'order' => 3],
                            ['text' => 'that…', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/document-review-analysis_23-2148721824.jpg',
                        'answers' => [
                            ['text' => 'R', 'correct' => true, 'order' => 1],
                            ['text' => 'E', 'correct' => true, 'order' => 2],
                            ['text' => 'V', 'correct' => true, 'order' => 3],
                            ['text' => 'I', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                            ['text' => 'W', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'verify', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'precise', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'carefully', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'understanding', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Can you ___ that for me?',
                        'answers' => [
                            ['text' => 'clarify', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a paraphrase prompt?',
                        'answers' => [
                            ['text' => 'In other words…', 'correct' => true],
                            ['text' => 'Repeat exactly.', 'correct' => false],
                            ['text' => 'Never mind.', 'correct' => false],
                            ['text' => 'Stop.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match communication actions:',
                        'answers' => [
                            ['text' => 'Speak again', 'correct' => true, 'match_key' => 'speak_again', 'media_url' => 'https://img.freepik.com/free-photo/person-speaking-microphone_23-2148721760.jpg'],
                            ['text' => 'Restate', 'correct' => true, 'match_key' => 'restate', 'media_url' => 'https://img.freepik.com/free-photo/restate-repeat-concept_23-2148721818.jpg'],
                            ['text' => 'Emphasize', 'correct' => true, 'match_key' => 'emphasize', 'media_url' => 'https://img.freepik.com/free-photo/emphasis-highlight-concept_23-2148721819.jpg'],
                        ]
                    ],
                ];
            }
        }

        // Lesson 2: Project Management & Negotiation
        if ($lesson == 2) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What is the term for dividing a project into smaller parts?',
                        'answers' => [
                            ['text' => 'Decomposition', 'correct' => true],
                            ['text' => 'Aggregation', 'correct' => false],
                            ['text' => 'Integration', 'correct' => false],
                            ['text' => 'Execution', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match project elements:',
                        'answers' => [
                            ['text' => 'Scope', 'correct' => true, 'match_key' => 'scope', 'media_url' => 'https://img.freepik.com/free-photo/project-scope-planning_23-2148721820.jpg'],
                            ['text' => 'Schedule', 'correct' => true, 'match_key' => 'schedule', 'media_url' => 'https://img.freepik.com/free-photo/calendar-date-schedule-planning-concept_53876-120751.jpg'],
                            ['text' => 'Budget', 'correct' => true, 'match_key' => 'budget', 'media_url' => 'https://img.freepik.com/free-photo/budget-financial-planning_23-2148721821.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'audit', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'deliverable', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'sequentially', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'critical', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'The project ___ will be delivered next week.',
                        'answers' => [
                            ['text' => 'deliverable', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'manage', 'correct' => true, 'order' => 3],
                            ['text' => 'stakeholders.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/status-report-dashboard_23-2148721831.jpg',
                        'answers' => [
                            ['text' => 'S', 'correct' => true, 'order' => 1],
                            ['text' => 'T', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                            ['text' => 'U', 'correct' => true, 'order' => 5],
                            ['text' => 'S', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'monitor', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'effective', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'daily', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'milestone', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Please ___ the risk register.',
                        'answers' => [
                            ['text' => 'update', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phase comes after planning?',
                        'answers' => [
                            ['text' => 'Execution', 'correct' => true],
                            ['text' => 'Closing', 'correct' => false],
                            ['text' => 'Initiation', 'correct' => false],
                            ['text' => 'Monitoring', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match project tools:',
                        'answers' => [
                            ['text' => 'Tools', 'correct' => true, 'match_key' => 'tools', 'media_url' => 'https://img.freepik.com/free-photo/project-management-tools_23-2148721822.jpg'],
                            ['text' => 'Progress', 'correct' => true, 'match_key' => 'progress', 'media_url' => 'https://img.freepik.com/free-photo/progress-bar-chart_23-2148721823.jpg'],
                            ['text' => 'Review', 'correct' => true, 'match_key' => 'review', 'media_url' => 'https://img.freepik.com/free-photo/document-review-analysis_23-2148721824.jpg'],
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
                            ['text' => 'leverage', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'mutually', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'tactic', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'beneficial', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We can ___ our position.',
                        'answers' => [
                            ['text' => 'leverage', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase seeks common ground?',
                        'answers' => [
                            ['text' => 'Let\'s find a win-win solution.', 'correct' => true],
                            ['text' => 'This is mine.', 'correct' => false],
                            ['text' => 'Take it or leave it.', 'correct' => false],
                            ['text' => 'No concessions.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match negotiation elements:',
                        'answers' => [
                            ['text' => 'Partnership', 'correct' => true, 'match_key' => 'partnership', 'media_url' => 'https://img.freepik.com/free-photo/business-partnership-handshake_23-2148721825.jpg'],
                            ['text' => 'Concession', 'correct' => true, 'match_key' => 'concession', 'media_url' => 'https://img.freepik.com/free-photo/negotiation-concession-concept_23-2148721826.jpg'],
                            ['text' => 'Dialogue', 'correct' => true, 'match_key' => 'dialogue', 'media_url' => 'https://img.freepik.com/free-photo/business-dialogue-discussion_23-2148721827.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'achieve', 'correct' => true, 'order' => 3],
                            ['text' => 'a', 'correct' => true, 'order' => 4],
                            ['text' => 'common', 'correct' => true, 'order' => 5],
                            ['text' => 'agreement.', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/alignment-organization-concept_23-2148721832.jpg',
                        'answers' => [
                            ['text' => 'A', 'correct' => true, 'order' => 1],
                            ['text' => 'L', 'correct' => true, 'order' => 2],
                            ['text' => 'I', 'correct' => true, 'order' => 3],
                            ['text' => 'G', 'correct' => true, 'order' => 4],
                            ['text' => 'N', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'negotiate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'parallel', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'collaboratively', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'strategy', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We should ___ our offers.',
                        'answers' => [
                            ['text' => 'combine', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which softens a proposal?',
                        'answers' => [
                            ['text' => 'Perhaps we could…', 'correct' => true],
                            ['text' => 'This must work.', 'correct' => false],
                            ['text' => 'Do it now.', 'correct' => false],
                            ['text' => 'No choice.', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match response types:',
                        'answers' => [
                            ['text' => 'Objection', 'correct' => true, 'match_key' => 'objection', 'media_url' => 'https://img.freepik.com/free-photo/objection-disagreement-concept_23-2148721842.jpg'],
                            ['text' => 'Agreement', 'correct' => true, 'match_key' => 'agreement', 'media_url' => 'https://img.freepik.com/free-photo/business-handshake-meeting_23-2148721757.jpg'],
                            ['text' => 'Balance', 'correct' => true, 'match_key' => 'balance', 'media_url' => 'https://img.freepik.com/free-photo/balance-scale-concept_23-2148721843.jpg'],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What model plots impact vs. likelihood?',
                        'answers' => [
                            ['text' => 'Risk matrix', 'correct' => true],
                            ['text' => 'Gantt chart', 'correct' => false],
                            ['text' => 'Kanban board', 'correct' => false],
                            ['text' => 'Fishbone diagram', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match risk levels:',
                        'answers' => [
                            ['text' => 'High risk', 'correct' => true, 'match_key' => 'high_risk', 'media_url' => 'https://img.freepik.com/free-photo/high-risk-warning_23-2148721844.jpg'],
                            ['text' => 'Medium risk', 'correct' => true, 'match_key' => 'medium_risk', 'media_url' => 'https://img.freepik.com/free-photo/medium-risk-assessment_23-2148721845.jpg'],
                            ['text' => 'Low risk', 'correct' => true, 'match_key' => 'low_risk', 'media_url' => 'https://img.freepik.com/free-photo/low-risk-safe_23-2148721846.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'qualitative', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'quantify', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'numerically', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'probability', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Assign a ___ to each risk.',
                        'answers' => [
                            ['text' => 'score', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'analyze', 'correct' => true, 'order' => 3],
                            ['text' => 'risks.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/business-trend-analysis_23-2148721833.jpg',
                        'answers' => [
                            ['text' => 'T', 'correct' => true, 'order' => 1],
                            ['text' => 'R', 'correct' => true, 'order' => 2],
                            ['text' => 'E', 'correct' => true, 'order' => 3],
                            ['text' => 'N', 'correct' => true, 'order' => 4],
                            ['text' => 'D', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'estimate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'significant', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'rapidly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'exposure', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Calculate the ___ score.',
                        'answers' => [
                            ['text' => 'risk', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a data-driven method?',
                        'answers' => [
                            ['text' => 'Delphi technique', 'correct' => true],
                            ['text' => 'Brainstorming', 'correct' => false],
                            ['text' => 'Voting', 'correct' => false],
                            ['text' => 'Interview', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match analysis actions:',
                        'answers' => [
                            ['text' => 'Identify', 'correct' => true, 'match_key' => 'identify', 'media_url' => 'https://img.freepik.com/free-photo/person-identifying-problem_23-2148721916.jpg'],
                            ['text' => 'Document', 'correct' => true, 'match_key' => 'document', 'media_url' => 'https://img.freepik.com/free-photo/business-document-paper_23-2148721772.jpg'],
                            ['text' => 'Review', 'correct' => true, 'match_key' => 'review', 'media_url' => 'https://img.freepik.com/free-photo/document-review-analysis_23-2148721824.jpg'],
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
                            ['text' => 'backup', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'prepare', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'preemptively', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'alternative', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Develop a ___ plan.',
                        'answers' => [
                            ['text' => 'contingency', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which action follows identification?',
                        'answers' => [
                            ['text' => 'Mitigation', 'correct' => true],
                            ['text' => 'Revision', 'correct' => false],
                            ['text' => 'Termination', 'correct' => false],
                            ['text' => 'Assignment', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match system elements:',
                        'answers' => [
                            ['text' => 'Archive', 'correct' => true, 'match_key' => 'archive', 'media_url' => 'https://img.freepik.com/free-photo/archive-storage-system_23-2148721918.jpg'],
                            ['text' => 'Restore', 'correct' => true, 'match_key' => 'restore', 'media_url' => 'https://img.freepik.com/free-photo/system-restore-process_23-2148721920.jpg'],
                            ['text' => 'System', 'correct' => true, 'match_key' => 'system', 'media_url' => 'https://img.freepik.com/free-photo/computer-system-network_23-2148721930.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'activate', 'correct' => true, 'order' => 3],
                            ['text' => 'the', 'correct' => true, 'order' => 4],
                            ['text' => 'contingency', 'correct' => true, 'order' => 5],
                            ['text' => 'plan.', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/alert-warning-notification_23-2148721834.jpg',
                        'answers' => [
                            ['text' => 'A', 'correct' => true, 'order' => 1],
                            ['text' => 'L', 'correct' => true, 'order' => 2],
                            ['text' => 'E', 'correct' => true, 'order' => 3],
                            ['text' => 'R', 'correct' => true, 'order' => 4],
                            ['text' => 'T', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'trigger', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'automated', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'immediately', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'failover', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Activate backup ___.',
                        'answers' => [
                            ['text' => 'systems', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which phrase indicates fallback?',
                        'answers' => [
                            ['text' => 'Fallback option', 'correct' => true],
                            ['text' => 'Primary', 'correct' => false],
                            ['text' => 'Mainstay', 'correct' => false],
                            ['text' => 'Core', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match system actions:',
                        'answers' => [
                            ['text' => 'Secure', 'correct' => true, 'match_key' => 'secure', 'media_url' => 'https://img.freepik.com/free-photo/security-lock-protection_23-2148721921.jpg'],
                            ['text' => 'Switch', 'correct' => true, 'match_key' => 'switch', 'media_url' => 'https://img.freepik.com/free-photo/person-switching-system_23-2148721931.jpg'],
                            ['text' => 'Connect', 'correct' => true, 'match_key' => 'connect', 'media_url' => 'https://img.freepik.com/free-photo/network-connection-cables_23-2148721932.jpg'],
                        ]
                    ],
                ];
            }
        }

        // Lesson 3: Crisis Response & Technical Documentation
        if ($lesson == 3) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which step comes first in a crisis response?',
                        'answers' => [
                            ['text' => 'Identification', 'correct' => true],
                            ['text' => 'Recovery', 'correct' => false],
                            ['text' => 'Communication', 'correct' => false],
                            ['text' => 'Evaluation', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match crisis response actions:',
                        'answers' => [
                            ['text' => 'Alert stakeholders', 'correct' => true, 'match_key' => 'alert', 'media_url' => 'https://img.freepik.com/free-photo/person-alerting-team_23-2148721924.jpg'],
                            ['text' => 'Document incident', 'correct' => true, 'match_key' => 'document', 'media_url' => 'https://img.freepik.com/free-photo/incident-documentation-report_23-2148721933.jpg'],
                            ['text' => 'Notify team', 'correct' => true, 'match_key' => 'notify', 'media_url' => 'https://img.freepik.com/free-photo/person-notifying-team_23-2148721934.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'respond', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'critical', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'swiftly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'protocol', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Initiate the ___ plan immediately.',
                        'answers' => [
                            ['text' => 'response', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'activate', 'correct' => true, 'order' => 3],
                            ['text' => 'communication.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/alert-warning-notification_23-2148721834.jpg',
                        'answers' => [
                            ['text' => 'A', 'correct' => true, 'order' => 1],
                            ['text' => 'L', 'correct' => true, 'order' => 2],
                            ['text' => 'E', 'correct' => true, 'order' => 3],
                            ['text' => 'R', 'correct' => true, 'order' => 4],
                            ['text' => 'T', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'coordinate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'urgent', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'efficiently', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'briefing', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Conduct a quick ___ to the team.',
                        'answers' => [
                            ['text' => 'briefing', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a recovery action?',
                        'answers' => [
                            ['text' => 'Restore backups', 'correct' => true],
                            ['text' => 'Ignore issues', 'correct' => false],
                            ['text' => 'Postpone updates', 'correct' => false],
                            ['text' => 'Delay response', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match recovery actions:',
                        'answers' => [
                            ['text' => 'Repair', 'correct' => true, 'match_key' => 'repair', 'media_url' => 'https://img.freepik.com/free-photo/person-repairing-system_23-2148721927.jpg'],
                            ['text' => 'Restore', 'correct' => true, 'match_key' => 'restore', 'media_url' => 'https://img.freepik.com/free-photo/system-restore-process_23-2148721920.jpg'],
                            ['text' => 'Confirm', 'correct' => true, 'match_key' => 'confirm', 'media_url' => 'https://img.freepik.com/free-photo/confirmation-checkmark-approval_23-2148721816.jpg'],
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
                            ['text' => 'engage', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'stakeholder', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'actively', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'essential', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We should ___ stakeholders early.',
                        'answers' => [
                            ['text' => 'involve', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which technique maps stakeholder influence?',
                        'answers' => [
                            ['text' => 'RACI chart', 'correct' => true],
                            ['text' => 'SWOT', 'correct' => false],
                            ['text' => 'Gantt chart', 'correct' => false],
                            ['text' => 'Kanban', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match stakeholder tools:',
                        'answers' => [
                            ['text' => 'Stakeholder map', 'correct' => true, 'match_key' => 'map', 'media_url' => 'https://img.freepik.com/free-photo/stakeholder-mapping-diagram_23-2148721935.jpg'],
                            ['text' => 'Influence-interest matrix', 'correct' => true, 'match_key' => 'matrix', 'media_url' => 'https://img.freepik.com/free-photo/influence-matrix-chart_23-2148721936.jpg'],
                            ['text' => 'Survey', 'correct' => true, 'match_key' => 'survey', 'media_url' => 'https://img.freepik.com/free-photo/survey-questionnaire-form_23-2148721937.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'Keep', 'correct' => true, 'order' => 1],
                            ['text' => 'communication', 'correct' => true, 'order' => 2],
                            ['text' => 'open.', 'correct' => true, 'order' => 3],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/audit-inspection-concept_23-2148721835.jpg',
                        'answers' => [
                            ['text' => 'A', 'correct' => true, 'order' => 1],
                            ['text' => 'U', 'correct' => true, 'order' => 2],
                            ['text' => 'D', 'correct' => true, 'order' => 3],
                            ['text' => 'I', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                            ['text' => 'N', 'correct' => true, 'order' => 6],
                            ['text' => 'C', 'correct' => true, 'order' => 7],
                            ['text' => 'E', 'correct' => true, 'order' => 8],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a standard doc type?',
                        'answers' => [
                            ['text' => 'API guide', 'correct' => true],
                            ['text' => 'Memo', 'correct' => false],
                            ['text' => 'Newsletter', 'correct' => false],
                            ['text' => 'Invoice', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match documentation types:',
                        'answers' => [
                            ['text' => 'Manual', 'correct' => true, 'match_key' => 'manual', 'media_url' => 'https://img.freepik.com/free-photo/instruction-manual-book_23-2148721938.jpg'],
                            ['text' => 'User guide', 'correct' => true, 'match_key' => 'user_guide', 'media_url' => 'https://img.freepik.com/free-photo/user-guide-handbook_23-2148721939.jpg'],
                            ['text' => 'Technical specs', 'correct' => true, 'match_key' => 'tech_specs', 'media_url' => 'https://img.freepik.com/free-photo/technical-specifications-document_23-2148721940.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'document', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'comprehensive', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'accurately', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'architecture', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Include a ___ section for FAQs.',
                        'answers' => [
                            ['text' => 'dedicated', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'should', 'correct' => true, 'order' => 2],
                            ['text' => 'update', 'correct' => true, 'order' => 3],
                            ['text' => 'regularly.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/topic-subject-discussion_23-2148721836.jpg',
                        'answers' => [
                            ['text' => 'T', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'P', 'correct' => true, 'order' => 3],
                            ['text' => 'I', 'correct' => true, 'order' => 4],
                            ['text' => 'C', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'outline', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'structured', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'clearly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'section', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Use clear ___ headings.',
                        'answers' => [
                            ['text' => 'descriptive', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which denotes a warning?',
                        'answers' => [
                            ['text' => 'Caution:', 'correct' => true],
                            ['text' => 'Note:', 'correct' => false],
                            ['text' => 'Tip:', 'correct' => false],
                            ['text' => 'Optional:', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match documentation symbols:',
                        'answers' => [
                            ['text' => 'Warning', 'correct' => true, 'match_key' => 'warning', 'media_url' => 'https://img.freepik.com/free-photo/caution-warning-sign_23-2148721785.jpg'],
                            ['text' => 'Tip', 'correct' => true, 'match_key' => 'tip', 'media_url' => 'https://img.freepik.com/free-photo/lightbulb-idea-concept_23-2148721763.jpg'],
                            ['text' => 'Info', 'correct' => true, 'match_key' => 'info', 'media_url' => 'https://img.freepik.com/free-photo/information-icon-symbol_23-2148721941.jpg'],
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
                            ['text' => 'automate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'efficient', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'seamlessly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'pipeline', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We can ___ the deployment process.',
                        'answers' => [
                            ['text' => 'automate', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which tool schedules tasks?',
                        'answers' => [
                            ['text' => 'Cron', 'correct' => true],
                            ['text' => 'Excel', 'correct' => false],
                            ['text' => 'PowerPoint', 'correct' => false],
                            ['text' => 'Photoshop', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match automation elements:',
                        'answers' => [
                            ['text' => 'Bot', 'correct' => true, 'match_key' => 'bot', 'media_url' => 'https://img.freepik.com/free-photo/chatbot-robot-automation_23-2148721942.jpg'],
                            ['text' => 'Loop', 'correct' => true, 'match_key' => 'loop', 'media_url' => 'https://img.freepik.com/free-photo/circular-loop-process_23-2148721943.jpg'],
                            ['text' => 'Engine', 'correct' => true, 'match_key' => 'engine', 'media_url' => 'https://img.freepik.com/free-photo/automation-engine-system_23-2148721944.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'define', 'correct' => true, 'order' => 2],
                            ['text' => 'the', 'correct' => true, 'order' => 3],
                            ['text' => 'triggers.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/script-document-writing_23-2148721837.jpg',
                        'answers' => [
                            ['text' => 'S', 'correct' => true, 'order' => 1],
                            ['text' => 'C', 'correct' => true, 'order' => 2],
                            ['text' => 'R', 'correct' => true, 'order' => 3],
                            ['text' => 'I', 'correct' => true, 'order' => 4],
                            ['text' => 'P', 'correct' => true, 'order' => 5],
                            ['text' => 'T', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'schedule', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'automated', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'periodically', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'workflow', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Set ___ to run nightly.',
                        'answers' => [
                            ['text' => 'schedule', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which describes retry logic?',
                        'answers' => [
                            ['text' => 'Repeat on failure', 'correct' => true],
                            ['text' => 'Stop on first error', 'correct' => false],
                            ['text' => 'Ignore errors', 'correct' => false],
                            ['text' => 'Continue anyway', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match process states:',
                        'answers' => [
                            ['text' => 'Retry', 'correct' => true, 'match_key' => 'retry', 'media_url' => 'https://img.freepik.com/free-photo/retry-refresh-button_23-2148721945.jpg'],
                            ['text' => 'Failure', 'correct' => true, 'match_key' => 'failure', 'media_url' => 'https://img.freepik.com/free-photo/failure-disappointment-concept_23-2148721803.jpg'],
                            ['text' => 'Success', 'correct' => true, 'match_key' => 'success', 'media_url' => 'https://img.freepik.com/free-photo/success-achievement-celebration_23-2148721802.jpg'],
                        ]
                    ],
                ];
            }
        }

        // Lesson 4: Strategic Management & Optimization
        if ($lesson == 4) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which term defines future steps?',
                        'answers' => [
                            ['text' => 'Roadmap', 'correct' => true],
                            ['text' => 'Backlog', 'correct' => false],
                            ['text' => 'Archive', 'correct' => false],
                            ['text' => 'Retrospective', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match strategic elements:',
                        'answers' => [
                            ['text' => 'Roadmap', 'correct' => true, 'match_key' => 'roadmap', 'media_url' => 'https://img.freepik.com/free-photo/project-roadmap-timeline_23-2148721946.jpg'],
                            ['text' => 'Launch', 'correct' => true, 'match_key' => 'launch', 'media_url' => 'https://img.freepik.com/free-photo/rocket-launch-startup_23-2148721947.jpg'],
                            ['text' => 'Milestone', 'correct' => true, 'match_key' => 'milestone', 'media_url' => 'https://img.freepik.com/free-photo/milestone-achievement-marker_23-2148721948.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'prioritize', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'strategic', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'quarterly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'target', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Define ___ for each phase.',
                        'answers' => [
                            ['text' => 'objectives', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'align', 'correct' => true, 'order' => 3],
                            ['text' => 'goals.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/route-path-navigation_23-2148721838.jpg',
                        'answers' => [
                            ['text' => 'R', 'correct' => true, 'order' => 1],
                            ['text' => 'O', 'correct' => true, 'order' => 2],
                            ['text' => 'U', 'correct' => true, 'order' => 3],
                            ['text' => 'T', 'correct' => true, 'order' => 4],
                            ['text' => 'E', 'correct' => true, 'order' => 5],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'visualize', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'overall', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'periodically', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'timeline', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Review the ___ weekly.',
                        'answers' => [
                            ['text' => 'roadmap', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which tool creates roadmaps?',
                        'answers' => [
                            ['text' => 'Jira', 'correct' => true],
                            ['text' => 'Word', 'correct' => false],
                            ['text' => 'Notepad', 'correct' => false],
                            ['text' => 'Paint', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match planning actions:',
                        'answers' => [
                            ['text' => 'Pinpoint', 'correct' => true, 'match_key' => 'pinpoint', 'media_url' => 'https://img.freepik.com/free-photo/person-pinpointing-location_23-2148721949.jpg'],
                            ['text' => 'Examine', 'correct' => true, 'match_key' => 'examine', 'media_url' => 'https://img.freepik.com/free-photo/person-examining-data_23-2148721950.jpg'],
                            ['text' => 'Adjust', 'correct' => true, 'match_key' => 'adjust', 'media_url' => 'https://img.freepik.com/free-photo/person-adjusting-settings_23-2148721951.jpg'],
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
                            ['text' => 'transition', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'adopt', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'smoothly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'resistant', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Manage ___ to new processes.',
                        'answers' => [
                            ['text' => 'transition', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which step engages employees?',
                        'answers' => [
                            ['text' => 'Communicate vision', 'correct' => true],
                            ['text' => 'Mandate change', 'correct' => false],
                            ['text' => 'Ignore feedback', 'correct' => false],
                            ['text' => 'Delay rollout', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match change management actions:',
                        'answers' => [
                            ['text' => 'Announce', 'correct' => true, 'match_key' => 'announce', 'media_url' => 'https://img.freepik.com/free-photo/person-making-announcement_23-2148721952.jpg'],
                            ['text' => 'Support', 'correct' => true, 'match_key' => 'support', 'media_url' => 'https://img.freepik.com/free-photo/helping-hand-assistance_23-2148721773.jpg'],
                            ['text' => 'Guide', 'correct' => true, 'match_key' => 'guide', 'media_url' => 'https://img.freepik.com/free-photo/person-guiding-team_23-2148721953.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'involve', 'correct' => true, 'order' => 3],
                            ['text' => 'stakeholders.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/adaptation-flexibility-concept_23-2148721839.jpg',
                        'answers' => [
                            ['text' => 'A', 'correct' => true, 'order' => 1],
                            ['text' => 'D', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'P', 'correct' => true, 'order' => 4],
                            ['text' => 'T', 'correct' => true, 'order' => 5],
                        ]
                    ],
                ];
            }
            if ($part == 3) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which metric shows efficiency?',
                        'answers' => [
                            ['text' => 'Throughput', 'correct' => true],
                            ['text' => 'Downtime', 'correct' => false],
                            ['text' => 'Cost', 'correct' => false],
                            ['text' => 'Compliance', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match performance metrics:',
                        'answers' => [
                            ['text' => 'Response time', 'correct' => true, 'match_key' => 'response_time', 'media_url' => 'https://img.freepik.com/free-photo/response-time-clock_23-2148721847.jpg'],
                            ['text' => 'Throughput', 'correct' => true, 'match_key' => 'throughput', 'media_url' => 'https://img.freepik.com/free-photo/throughput-performance-metric_23-2148721848.jpg'],
                            ['text' => 'Utilization', 'correct' => true, 'match_key' => 'utilization', 'media_url' => 'https://img.freepik.com/free-photo/utilization-efficiency-chart_23-2148721849.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'measure', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'key', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'accurately', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'indicator', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Track ___ over time.',
                        'answers' => [
                            ['text' => 'metrics', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'set', 'correct' => true, 'order' => 3],
                            ['text' => 'baseline.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/performance-metrics-dashboard_23-2148721840.jpg',
                        'answers' => [
                            ['text' => 'M', 'correct' => true, 'order' => 1],
                            ['text' => 'E', 'correct' => true, 'order' => 2],
                            ['text' => 'T', 'correct' => true, 'order' => 3],
                            ['text' => 'R', 'correct' => true, 'order' => 4],
                            ['text' => 'I', 'correct' => true, 'order' => 5],
                            ['text' => 'C', 'correct' => true, 'order' => 6],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'benchmark', 'correct' => true, 'match_key' => 'Noun'],
                            ['text' => 'continuously', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'evaluate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'relevant', 'correct' => true, 'match_key' => 'Adjective'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Define ___ for success.',
                        'answers' => [
                            ['text' => 'criteria', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which indicates decline?',
                        'answers' => [
                            ['text' => 'Downward trend', 'correct' => true],
                            ['text' => 'Upward trend', 'correct' => false],
                            ['text' => 'Stable', 'correct' => false],
                            ['text' => 'Plateau', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match trend directions:',
                        'answers' => [
                            ['text' => 'Decrease', 'correct' => true, 'match_key' => 'decrease', 'media_url' => 'https://img.freepik.com/free-photo/downward-arrow-decrease_23-2148721954.jpg'],
                            ['text' => 'Flat', 'correct' => true, 'match_key' => 'flat', 'media_url' => 'https://img.freepik.com/free-photo/flat-line-chart_23-2148721955.jpg'],
                            ['text' => 'Increase', 'correct' => true, 'match_key' => 'increase', 'media_url' => 'https://img.freepik.com/free-photo/upward-arrow-increase_23-2148721956.jpg'],
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
                            ['text' => 'streamline', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'optimal', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'efficiently', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'throughput', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'We should ___ resource usage.',
                        'answers' => [
                            ['text' => 'optimize', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which method reduces waste?',
                        'answers' => [
                            ['text' => 'Lean', 'correct' => true],
                            ['text' => 'Waterfall', 'correct' => false],
                            ['text' => 'Spiral', 'correct' => false],
                            ['text' => 'Scrum', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match optimization actions:',
                        'answers' => [
                            ['text' => 'Eliminate', 'correct' => true, 'match_key' => 'eliminate', 'media_url' => 'https://img.freepik.com/free-photo/eliminate-remove-action_23-2148721957.jpg'],
                            ['text' => 'Standardize', 'correct' => true, 'match_key' => 'standardize', 'media_url' => 'https://img.freepik.com/free-photo/standardization-process_23-2148721958.jpg'],
                            ['text' => 'Automate', 'correct' => true, 'match_key' => 'automate', 'media_url' => 'https://img.freepik.com/free-photo/automation-robot-process_23-2148721959.jpg'],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'reduce', 'correct' => true, 'order' => 3],
                            ['text' => 'waste.', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'image_word',
                        'question_text' => 'Xếp các chữ cái thành từ phù hợp với hình:',
                        'media_url' => 'https://img.freepik.com/free-photo/lean-methodology-concept_23-2148721841.jpg',
                        'answers' => [
                            ['text' => 'L', 'correct' => true, 'order' => 1],
                            ['text' => 'E', 'correct' => true, 'order' => 2],
                            ['text' => 'A', 'correct' => true, 'order' => 3],
                            ['text' => 'N', 'correct' => true, 'order' => 4],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'evaluate', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'measurable', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'regularly', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'efficiency', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Monitor ___ to improve.',
                        'answers' => [
                            ['text' => 'performance', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'single_choice',
                        'question_text' => 'Which is a continuous improvement cycle?',
                        'answers' => [
                            ['text' => 'PDCA', 'correct' => true],
                            ['text' => 'SWOT', 'correct' => false],
                            ['text' => 'PEST', 'correct' => false],
                            ['text' => 'ROI', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match improvement elements:',
                        'answers' => [
                            ['text' => 'Cycle', 'correct' => true, 'match_key' => 'cycle', 'media_url' => 'https://img.freepik.com/free-photo/circular-loop-process_23-2148721943.jpg'],
                            ['text' => 'Growth', 'correct' => true, 'match_key' => 'growth', 'media_url' => 'https://img.freepik.com/free-photo/growth-chart-upward_23-2148721960.jpg'],
                            ['text' => 'Improve', 'correct' => true, 'match_key' => 'improve', 'media_url' => 'https://img.freepik.com/free-photo/improvement-enhancement-concept_23-2148721961.jpg'],
                        ]
                    ],
                ];
            }
        }

        // Lesson 5: Data Analytics & Advanced Technologies
        if ($lesson == 5) {
            if ($part == 1) {
                return [
                    [
                        'type' => 'single_choice',
                        'question_text' => 'What process cleans data?',
                        'answers' => [
                            ['text' => 'Data cleansing', 'correct' => true],
                            ['text' => 'Data modeling', 'correct' => false],
                            ['text' => 'Visualization', 'correct' => false],
                            ['text' => 'Reporting', 'correct' => false],
                        ]
                    ],
                    [
                        'type' => 'matching',
                        'question_text' => 'Match data processes:',
                        'answers' => [
                            ['text' => 'Clean', 'correct' => true, 'match_key' => 'clean', 'media_url' => 'https://img.freepik.com/free-photo/data-cleaning-process_23-2148721850.jpg'],
                            ['text' => 'Analyze', 'correct' => true, 'match_key' => 'analyze', 'media_url' => 'https://img.freepik.com/free-photo/data-analysis-research_23-2148721851.jpg'],
                            ['text' => 'Visualize', 'correct' => true, 'match_key' => 'visualize', 'media_url' => 'https://img.freepik.com/free-photo/data-visualization-chart_23-2148721852.jpg'],
                        ]
                    ],
                    [
                        'type' => 'classification',
                        'question_text' => 'Phân loại từ:',
                        'answers' => [
                            ['text' => 'transform', 'correct' => true, 'match_key' => 'Verb'],
                            ['text' => 'insightful', 'correct' => true, 'match_key' => 'Adjective'],
                            ['text' => 'accurately', 'correct' => true, 'match_key' => 'Adverb'],
                            ['text' => 'dataset', 'correct' => true, 'match_key' => 'Noun'],
                        ]
                    ],
                    [
                        'type' => 'fill_blank',
                        'question_text' => 'Remove ___ entries.',
                        'answers' => [
                            ['text' => 'duplicate', 'correct' => true],
                        ]
                    ],
                    [
                        'type' => 'arrangement',
                        'question_text' => 'Sắp xếp thành câu:',
                        'answers' => [
                            ['text' => 'We', 'correct' => true, 'order' => 1],
                            ['text' => 'must', 'correct' => true, 'order' => 2],
                            ['text' => 'validate', 'correct' => true, 'order' => 3],
                            ['text' => 'data.', 'correct' => true, 'order' => 4],
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
                ];
            }
        }

        return [];
    }
}
