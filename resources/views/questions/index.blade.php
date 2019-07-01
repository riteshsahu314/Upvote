@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-end mb-2">
            <ul class="nav nav-pills" id="tabs">
                <li class="nav-item">
                    <a class="nav-link" href="?sortBy=new">New</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?sortBy=popular">Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?sortBy=votes">Votes</a>
                </li>
            </ul>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                @forelse($questions as $question)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>
                                <a href="{{ $question->path() }}">{{ $question->title }}</a>
                            </h4>
                            <h5>
                                Asked By:
                                <a href="{{ route('users.show', $question->owner) }}">
                                    {{ $question->owner->name }}
                                </a>
                            </h5>
                            <p>
                                <a href="{{ $question->path() }}">
                                    {{ $question->answers_count }} {{ Str::plural('answer', $question->answers_count) }}
                                </a>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                {!! $question->body !!}
                            </div>

                            <div>
                                @foreach($question->tags as $tag)
                                    <a href="{{ route('tags.show', $tag) }}" class="bg-info text-white p-1 text-decoration-none">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <p>There is no questions at this time.</p>
                @endforelse

                {{ $questions->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
@endsection
