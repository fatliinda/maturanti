<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index(){
        $quizzes = Quiz::with('course')->get();
        return view('content.apps.app-quizzes', compact('quizzes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        Quiz::create([
            'title' => $request->title,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('app-quizzes')->with('success', 'Quiz created successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'quiz' => 'required|string',
        ]);

        $quiz = Quiz::find($id);

        if ($quiz) {
           
            $quiz->title = $request->input('quiz');
            $quiz->course_id = $request->input('course_id');
            $quiz->save();

            return redirect()->route('app-quizzes')->with('success', 'Question updated successfully.');
        } else {
            
            return redirect()->route('app-quizzes')->with('error', 'Question not found.');
        }
    }
    public function destroy($id){
        $quiz = Quiz::find($id);

        if($quiz){
            $quiz->delete();
            return redirect()->route('app-quizzes')->with('success', 'Question deleted successfully.');
        } else {
            return redirect()->route('app-quizzes')->with('error', 'Question not found.');
        }
        
    }
}
