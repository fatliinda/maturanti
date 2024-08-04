@extends('layouts/layoutMaster')

@section('title', 'Quizzes Management - Crud App')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
@endsection

@section('content')
<!-- Users List Table -->
<div class="card-datatable table-responsive">
    

    <table class="datatables-users table">
      <thead class="border-top">
        <tr>
          <th>Kuizi</th>
          <th>Lenda</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($quizzes as $quiz)
          <tr>
            <td>{{ $quiz->title}}</td>
            <td>{{$quiz->course->title}}</td>
            <td>
                <button  class="btn btn-link p-1 m-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditQuiz"><i class="fa-regular fa-pen-to-square"></i></button>
                <button  class="btn btn-link p-1 m-1" data-bs-toggle="modal" data-bs-target="#modalTop"><i class="fa-solid fa-trash"></i></button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
<!-- Offcanvas to edit question -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditQuiz" aria-labelledby="offcanvasEditQuestionLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasEditQuestionLabel" class="offcanvas-title">Edit Quiz</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="edit-question-form pt-0" method="POST" action="{{route('app-quiz-update',[$id = $quiz->id])}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="quiz" class="form-label">Quiz</label>
          <textarea name="quiz" id="quiz" class="form-control" required>{{$quiz->title}}</textarea>
          <div class="mb-3">
        <label for="courseSelect" class="form-label">Select Course</label>
        <select class="form-select" id="courseSelect" name="course_id">
            <option value="">Choose a course</option>
            @foreach($quizzes as $quiz)
                <option value="{{ $quiz->course->id }}">{{ $quiz->course->title }}</option>
            @endforeach
        </select>
    </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal modal-top fade" id="modalTop" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">
          <i class="fa-solid fa-triangle-exclamation text-warning me-2"></i> Confirm Deletion
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
        <form method="POST" action="{{route('app-quiz-destroy',[$id = $quiz->id])}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-primary">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
