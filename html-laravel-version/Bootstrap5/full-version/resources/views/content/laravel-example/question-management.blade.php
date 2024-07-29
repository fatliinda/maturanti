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
<script src="{{ asset('js/laravel-user-management.js') }}"></script>
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
          <th>Kuizi</th>
          <th>Pyetja</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($questions as $question)
          <tr>
            <td>{{ $question->quiz->title }}</td>
            <td>{{ $question->question }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
 
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-user pt-0" id="addNewUserForm">
        <!-- Form fields for adding a new user -->
      </form>
    </div>
  </div>
</div>
@endsection
