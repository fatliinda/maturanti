@extends('layouts/layoutMaster')
@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Academy Course - Apps')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/plyr/plyr.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-academy.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/plyr/plyr.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-academy-course.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Kuizet</span></h4>
<div class="card bg-transparent shadow-none my-4 border-0">
  <div class="card-body row p-0 pb-3">
    <div class="col-12 col-md-8 card-separator">
      <h3>Mireseerdhe, {{auth()->user()->name}}👋🏻 </h3>
</div>
  </div>
</div>
<div class="app-academy">
  <div class="card p-0 mb-4">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-4">
      <div class="app-academy-md-25 card-body py-0">
        <img src="{{asset('assets/img/illustrations/bulb-'.$configData['style'].'.png') }}" class="img-fluid app-academy-img-height scaleX-n1-rtl" alt="Bulb in hand" data-app-light-img="illustrations/bulb-light.png" data-app-dark-img="illustrations/bulb-dark.png" height="90" />
      </div>
      <div class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center">
        <h3 class="card-title mb-4 lh-sm px-md-5 lh-lg">
        Më trego dhe unë harroj. Më mëso dhe mbaj mend.
          <span class="text-primary fw-medium text-nowrap">Më përfshij dhe mësoj.</span>
        </h3>
        <p class="mb-3">
        Dituria rritet në mënyrë eksponenciale. Sa më shumë që dimë, është më e madhe aftësia jonë për të mësuar dhe më shpejtë zgjerojmë bazën e diturisë sonë.
        </p>
        
      </div>
      <div class="app-academy-md-25 d-flex align-items-end justify-content-end">
        <img src="{{asset('assets/img/illustrations/pencil-rocket.png') }}" alt="pencil rocket" height="188" class="scaleX-n1-rtl" />
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header d-flex flex-wrap justify-content-between gap-3">
      <div class="card-title mb-0 me-1">
        <h5 class="mb-1">Kuizet e mia</h5>
        <p class="text-muted mb-0">Kuizet nga lendet mesimore</p>
      </div>
    
    </div>
    <div class="card-body">
  <div class="row gy-4 mb-4">
    @foreach ($courses as $course)
    <div class="col-sm-6 col-lg-4">
      <div class="card p-2 h-100 shadow-none border">
        <div class="rounded-2 text-center mb-3">
          <a href="{{ route('app-academy-course-details', ['id' => $course->id]) }}"><img class="img-fluid" src="{{asset('assets/img/pages/app-academy-tutor-'.$loop->iteration.'.png')}}" alt="tutor image {{$loop->iteration}}" /></a>
        </div>
        <div class="card-body p-3 pt-2">
          
          <h5>{{ $course->title }}</h5>
          <p class="mt-2">{{ $course->description }}</p>
          <p class="d-flex align-items-center"><i class="ti ti-clock me-2 mt-n1"></i>{{ $course->duration }}</p>
          <div class="d-flex flex-column flex-md-row gap-2 text-nowrap">
            <a class="app-academy-md-50 btn btn-label-primary d-flex align-items-center" href="{{ route('app-academy-course-details', ['id' => $course->id]) }}">
              <span class="me-2">Fillo</span><i class="ti ti-chevron-right scaleX-n1-rtl ti-sm"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
      <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
        <ul class="pagination">
          <li class="page-item prev">
            <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevron-left ti-xs scaleX-n1-rtl"></i></a>
          </li>
          <li class="page-item active">
            <a class="page-link" href="javascript:void(0);">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">2</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">4</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">5</a>
          </li>
          <li class="page-item next">
            <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevron-right ti-xs scaleX-n1-rtl"></i></a>
          </li>
        </ul>
      </nav>
    </div>    
  </div>

@endsection
