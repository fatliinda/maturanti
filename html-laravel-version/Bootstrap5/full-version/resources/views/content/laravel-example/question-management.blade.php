@extends('layouts/layoutMaster')

@section('title', 'Questions Management - Crud App')

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
<script>
  $(document).ready(function() {
    $('.select2').select2({
      placeholder: $(this).data('placeholder')
    });

    // Auto-submit form on select change
    $('select[name="quiz_id"]').on('change', function() {
      $(this).closest('form').submit();
    });
  });
</script>
@endsection

@section('content')
<!-- Users List Table -->
<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Search Filter</h5>
  </div>
  <div class="card-datatable table-responsive">
    <form method="GET" action="{{ route('question-managment') }}">
      <div class="d-flex justify-content-md-end align-items-center gap-4 flex-wrap mb-4">
        <select name="quiz_id" class="select2 form-select" data-placeholder="All Quizzes">
          <option value="">All Quizzes</option>
          @foreach($quizzes as $quiz)
            <option value="{{ $quiz->id }}" {{ request('quiz_id') == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}</option>
          @endforeach
        </select>
      </div>
    </form>
    <table class="datatables-users table">
      <thead class="border-top">
        <tr>
          <th>Pyetja</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($questions as $question)
          <tr>
            <td>{{ $question->question }}</td>
            <td>
                <button  class="btn btn-link p-1 m-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditQuestion"><i class="fa-regular fa-pen-to-square"></i></button>
                <button  class="btn btn-link p-1 m-1" data-bs-toggle="modal" data-bs-target="#modalTop"><i class="fa-solid fa-trash"></i></button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
<!-- Offcanvas to edit question -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditQuestion" aria-labelledby="offcanvasEditQuestionLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasEditQuestionLabel" class="offcanvas-title">Edit Question</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="edit-question-form pt-0" method="POST" action="{{route('questions-update',[$id=$question->id])}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="question" class="form-label">Question</label>
          <textarea name="question" id="question" class="form-control" required>{{$question->question}}</textarea>
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
        <form method="POST" action="{{ route('questions-destroy', ['id' => $question->id]) }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-primary">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
