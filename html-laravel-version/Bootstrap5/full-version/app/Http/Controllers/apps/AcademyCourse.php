<?php

namespace App\Http\Controllers\apps;


use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AcademyCourse extends Controller
{
  public function index()
  {
    $courses = Course::all();
    return view('content.apps.app-academy-course',compact('courses'));
  }
}
