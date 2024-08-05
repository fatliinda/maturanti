@extends('layouts/layoutMaster')

@section('title', 'Courses Management - Crud App')

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
<div class="d-flex justify-content-end mb-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddCourse">Create Course</button>
</div>
<div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead class="border-top">
        <tr>
          <th>Lenda</th>
          <th>Pershkrimi</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($courses as $course)
          <tr>
            <td>{{ $course->title }}</td>
            <td>{{ $course->description }}</td>
            <td>
                <button class="btn btn-link p-1 m-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditCourse{{ $course->id }}"><i class="fa-regular fa-pen-to-square"></i></button>
                <button class="btn btn-link p-1 m-1" data-bs-toggle="modal" data-bs-target="#modalTop{{ $course->id }}"><i class="fa-solid fa-trash"></i></button>
            </td>
          </tr>

          <!-- Offcanvas to edit course -->
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditCourse{{ $course->id }}" aria-labelledby="offcanvasEditCourseLabel">
              <div class="offcanvas-header">
                <h5 id="offcanvasEditCourseLabel" class="offcanvas-title">Edit Course</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="edit-course-form pt-0" method="POST" action="{{route('app-course-update',[$id=$course->id])}}">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label for="title" class="form-label">Course</label>
                    <input type="text" name="title" id="course{{ $course->id }}" class="form-control" value="{{ $course->title }}" required>
                  </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Course</label>
                    <input type="text" name="description" id="description{{ $course->id }}" class="form-control" value="{{ $course->description }}" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
              </div>
          </div>

          <!-- Modal for delete confirmation -->
          <div class="modal modal-top fade" id="modalTop{{ $course->id }}" tabindex="-1">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTopTitle{{ $course->id }}">
                    <i class="fa-solid fa-triangle-exclamation text-warning me-2"></i> Confirm Deletion
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                  <form method="POST" action="{{route('app-course-destroy',[$id = $course->id])}}">
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

<!-- Offcanvas to add course -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddCourse" aria-labelledby="offcanvasAddCourseLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddCourseLabel" class="offcanvas-title">Add Course</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-course-form pt-0" method="POST" action="{{route('course-create')}}">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Course</label>
          <input type="text" name="title" id="course" class="form-control" placeholder="Emri i kursit" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Course</label>
          <input type="text" name="description" id="description" class="form-control" placeholder="Pershkrimi i kursit" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Course</button>
      </form>
    </div>
</div>
@endsection
