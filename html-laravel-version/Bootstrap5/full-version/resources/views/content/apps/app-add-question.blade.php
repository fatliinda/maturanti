@extends('layouts/layoutMaster')

@section('title', 'Add Questions - Admin Panel')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-0">
  <span class="text-muted fw-light">Admin Panel /</span><span class="fw-medium"> Add Questions</span>
</h4>

<div class="app-ecommerce">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
    <div class="d-flex flex-column justify-content-center">
      <h4 class="mb-1 mt-3">Add New Questions</h4>
      <p class="text-muted">Manage your quizzes and questions</p>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-lg-10">
      <!-- Question Form -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title mb-0">Question Information</h5>
        </div>
        <div class="card-body">
          <form id="question-form" action="{{ route('question-create') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="question-text">Question Text</label>
              <input type="text" class="form-control" id="question-text" name="question-text" placeholder="Enter the question text" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="quiz-id">Select Quiz</label>
              <select class="form-control select2" id="quiz-id" name="quiz_id" required>
                @foreach($quizzes as $quiz)
                  <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                @endforeach
              </select>
            </div>

            @for($i = 0; $i < 4; $i++)
            <div class="mb-3">
              <label class="form-label" for="answer-text-{{ $i }}">Answer Text {{ $i + 1 }}</label>
              <input type="text" class="form-control" id="answer-text-{{ $i }}" name="answers[{{ $i }}][answer-text]" placeholder="Enter the answer text" required>
              <input type="checkbox" id="is-correct-{{ $i }}" name="answers[{{ $i }}][is_correct]" value="1"> Correct Answer
            </div>
            @endfor

            <button type="submit" class="btn btn-primary">Add Question</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
