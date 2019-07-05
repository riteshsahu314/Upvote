@extends('questions._questions')

@section('heading')
    <div class="row justify-content-between align-items-center mb-3">
        <h2>Top Questions</h2>
        <a href="{{ route('questions.create') }}" class="btn btn-primary">Ask Question</a>
    </div>
@endsection
