<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class AcademyCourseDetails extends Controller
{
  public function index($id)
  {
    $course = Course::with('quizzes.questions.answers')->findOrFail($id);
    return view('content.apps.app-academy-course-details',compact('course'));
  }
 public function submitAnswer(Request $request, $id)
    {
        $course = Course::with('quizzes.questions.answers')->findOrFail($id);
        $answers = $request->input('answer');

        $results = [];
        $correctCount = 0;

        foreach ($course->quizzes as $quiz) {
            foreach ($quiz->questions as $question) {
                $selectedAnswerId = $answers[$question->id] ?? null;
                $correctAnswer = $question->answers->where('is_correct', true)->first();
                $selectedAnswer = $question->answers->where('id', $selectedAnswerId)->first();

                $isCorrect = $selectedAnswer && $selectedAnswer->is_correct;

                if ($isCorrect) {
                    $correctCount++;
                }

                $results[$question->id] = [
                    'question' => $question->text,
                    'selected_answer' => $selectedAnswer ? $selectedAnswer->text : null,
                    'correct_answer' => $correctAnswer ? $correctAnswer->text : null,
                    'is_correct' => $isCorrect,
                ];
            }
        }

        $resultMessage = "You got $correctCount out of " . count($course->quizzes->first()->questions) . " questions right.";

        return view('content.apps.app-academy-course-details', compact('course', 'results', 'resultMessage'));
    }
}

