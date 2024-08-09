@extends('layouts/layoutMaster')

@section('title', 'Academy Course Details - Apps')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/plyr/plyr.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-academy-details.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/plyr/plyr.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-academy-course-details.js')}}"></script>
@endsection

@section('content')
<div>
    <h4 class="pt-3 mb-0">
        <span class="text-muted fw-light"></span>Kuizi
    </h4>
    <div class="card g-3 mt-5">
        <div class="card-body">
            <h5 class="mb-2">{{ $course->title }}</h5>
            <p>{{ $course->description }}</p>
            <hr class="my-4">
            <h5>Pyetjet</h5>
            <form action="{{ route('submitAnswer', ['id' => $course->id]) }}" method="POST">
                @csrf
                @foreach($course->quizzes as $quiz)
                    <div class="mb-4">
                        <h6>{{ $quiz->title }}</h6>
                        @foreach($quiz->questions as $question)
                            <div class="mb-3">
                                <p>{{ $question->question }}</p>
                                @foreach($question->answers as $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]" id="answer_{{ $answer->id }}" value="{{ $answer->id }}">
                                        <label class="form-check-label" for="answer_{{ $answer->id }}">
                                            {{ $answer->answer }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @if (isset($resultMessage))
                <script>
                    alert('{{ $resultMessage }}');
                </script>
            @endif
        </div>
    </div>
</div>
            

@endsection

