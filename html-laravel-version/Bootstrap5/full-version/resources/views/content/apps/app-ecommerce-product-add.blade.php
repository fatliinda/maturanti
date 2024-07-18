@extends('layouts/layoutMaster')

@section('title', 'Add Questions - Admin Panel')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/app-ecommerce-product-add.js') }}"></script>
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
          <form action="" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="question-text">Question Text</label>
              <input type="text" class="form-control" id="question-text" name="text" placeholder="Enter the question text" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="quiz-id">Select Quiz</label>
              <select class="form-control select2" id="quiz-id" name="quiz_id" required>
                @foreach($quizzes as $quiz)
                  <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="answers">Answers</label>
              <div class="repeater">
                <div data-repeater-list="answers">
                  <div data-repeater-item class="mb-3">
                    <input type="text" name="text" class="form-control mb-2" placeholder="Answer text" required>
                    <input type="checkbox" name="is_correct" class="form-check-input" value="1"> Correct Answer
                    <div class="mt-2">
                      <button data-repeater-delete type="button" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                  </div>
                </div>
                <button data-repeater-create type="button" class="btn btn-primary btn-sm mt-3">Add Answer</button>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Question</button>
          </form>
        </div>
      </div>
      <!-- /Question Form -->
    </div>
  </div>
</div>
@endsection
