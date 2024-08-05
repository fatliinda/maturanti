<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::all();
        return view('content.apps.app-courses', compact('courses'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('app-courses')->with('success', 'Course created successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $course = Course::find($id);

        if ($course) {
           
            $course->title = $request->input('title');
            $course->description = $request->input('description');
            $course->save();

            return redirect()->route('app-courses')->with('success', 'Course updated successfully.');
        } else {
            
            return redirect()->route('app-course')->with('error', 'Course not found.');
        }
    }
    public function destroy($id){
        $course=Course::find($id);

        if($course){
            $course->delete();
            return redirect()->route('app-quizzes')->with('success', 'Question deleted successfully.');
        } else {
            return redirect()->route('app-quizzes')->with('error', 'Question not found.');
        }
        
    }
}
