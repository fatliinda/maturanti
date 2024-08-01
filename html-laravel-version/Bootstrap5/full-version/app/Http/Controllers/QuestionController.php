<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Facades\Log;


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
    public function manage(Request $request){
        $quizzes = Quiz::all();
        $selectedQuizId = $request->get('quiz_id');

        $questions = Question::when($selectedQuizId, function ($query, $selectedQuizId) {
            return $query->where('quiz_id', $selectedQuizId);
        })->get();
        return view('content.laravel-example.question-management',compact('quizzes','questions'));
    }
    public function destroy($id)
    {
        $question = Question::find($id);
    
        if ($question) {
            $question->delete();
            return redirect()->route('question-managment')->with('success', 'Question deleted successfully.');
        } else {
            return redirect()->route('question-managment')->with('error', 'Question not found.');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
        ]);

        $question = Question::find($id);

        if ($question) {
           
            $question->question = $request->input('question');
            $question->save();

            return redirect()->route('question-managment')->with('success', 'Question updated successfully.');
        } else {
            
            return redirect()->route('question-managment')->with('error', 'Question not found.');
        }
    }
}

