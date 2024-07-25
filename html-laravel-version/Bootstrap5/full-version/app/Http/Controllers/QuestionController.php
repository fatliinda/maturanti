<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;

class QuestionController extends Controller
{
    public function index()
  {
    $quizzes = Quiz::all();
    return view('content.apps.app-ecommerce-product-add', compact('quizzes'));
  }
    public function create(Request $request){
        

        $validated = $request->validate([
            'question-text' => 'required|string|max:255',
            'quiz_id' => 'required',
            'answers.*.answer-text' => 'required|string|max:255', // Each answer text
        'answers.*.is_correct' => 'sometimes|boolean',
        ]);

        $question = Question::create([
            'question' => $validated['question-text'],
            'quiz_id' => $validated['quiz_id'],
        ]);

        
        foreach ($request->input('answers', []) as $answer) {
            $question->answers()->create([
                'answer' => $answer['answer-text'],
                'is_correct' => isset($answer['is_correct']) ? (bool)$answer['is_correct'] : false,
            ]);
        }
        

        return redirect()->route('app-ecommerce-product-add')->with('success', 'Question added successfully.');
    }

    }

