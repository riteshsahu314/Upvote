@extends('questions._questions')

@section('heading')
    <div class="row justify-content-between align-items-center mb-3">
        <h2>Search Results</h2>
        <a href="{{ route('questions.create') }}" class="btn btn-primary">Ask Question</a>
    </div>
    <div class="row justify-content-between">
        <span class="fs-2 lead">Results for {{ $query }}</span>
        <span class="fs-2">{{ $questions->total() }} questions</span>
    </div>
@endsection

@section('pager')
    <div class="pager float-right">
        {{ $questions->appends(request()->except('page'))->links() }}
    </div>
@endsection
