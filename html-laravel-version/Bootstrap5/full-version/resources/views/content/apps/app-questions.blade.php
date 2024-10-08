@extends('layouts/layoutMaster')

@section('title', 'questions Management - Crud App')

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

<div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead class="border-top">
        <tr>
          <th>Pyetja</th>
          <th>Lenda</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($questions as $question)
          <tr>
            <td>{{ $question->question }}</td>
            <td>{{ $question->quiz->title }}</td>
            <td>
                <button class="btn btn-link p-1 m-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditQuestion{{ $question->id }}"><i class="fa-regular fa-pen-to-square"></i></button>
                <button class="btn btn-link p-1 m-1" data-bs-toggle="modal" data-bs-target="#modalTop{{ $question->id }}"><i class="fa-solid fa-trash"></i></button>
            </td>
          </tr>

          <!-- Offcanvas to edit question -->
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditQuestion{{ $question->id }}" aria-labelledby="offcanvasEditquestionLabel">
              <div class="offcanvas-header">
                <h5 id="offcanvasEditquestionLabel" class="offcanvas-title">Edit question</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="edit-question-form pt-0" method="POST" action="{{route('questions-update',[$id=$question->id])}}">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label for="question" class="form-label">question</label>
                    <input type="text" name="question" id="question{{ $question->id }}" class="form-control" value="{{ $question->question }}" required>
                  </div>
                  <div class="mb-3">
                  <label for="quizSelect" class="form-label">Select Quiz</label>
        <select class="form-select" id="quizSelect" name="quiz_id">
            <option value="">Choose a quiz</option>
            @foreach($quizzes as $quiz)
                <option value="{{ $quiz->id}}">{{ $quiz->title }}</option>
            @endforeach
        </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
              </div>
          </div>

          <!-- Modal for delete confirmation -->
          <div class="modal modal-top fade" id="modalTop{{ $question->id }}" tabindex="-1">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTopTitle{{ $question->id }}">
                    <i class="fa-solid fa-triangle-exclamation text-warning me-2"></i> Confirm Deletion
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                  <form method="POST" action="{{route('questions-destroy',[$id = $question->id])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </tbody>
    </table>
</div>

<!-- Offcanvas to add question -->


@endsection
