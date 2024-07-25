<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;

class EcommerceProductAdd extends Controller
{
  public function index()
  {
    $quizzes = Quiz::all();
    return view('content.apps.app-ecommerce-product-add', compact('quizzes'));
  }
}
