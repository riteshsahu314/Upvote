@extends('questions._questions')

@section('heading')
    <div class="row justify-content-between align-items-center mb-3">
        <h2>All Questions</h2>
        <a href="{{ route('questions.create') }}" class="btn btn-primary">Ask Question</a>
    </div>
    <div class="row justify-content-between">
        <span class="fs-2">{{ $questions->total() }} questions</span>
        <div class="btn-group">
            <a class="btn {{ Request::input('sortBy') == 'new' ? 'btn-secondary' : 'btn-outline-secondary' }}"
               href="?sortBy=new">New</a>

            <a class="btn {{ Request::input('sortBy') == 'popular' ? 'btn-secondary' : 'btn-outline-secondary' }}"
               href="?sortBy=popular">Popular</a>

            <a class="btn {{ Request::input('sortBy') == 'votes' ? 'btn-secondary' : 'btn-outline-secondary' }}"
               href="?sortBy=votes">Votes</a>
        </div>
    </div>
@endsection

@section('pager')
    <div class="pager float-right">
        {{ $questions->appends(request()->except('page'))->links() }}
    </div>
@endsection
