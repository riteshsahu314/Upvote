@extends('layouts.app')

@section('content')
    <div class="row p-5 mx-0">
        <div class="col">
            <div class="p-3">
                @yield('heading')
            </div>

            <div id="questions" class="pb-3">
                @forelse($questions as $question)
                    <div class="row question-summary border-bottom mx-0">
                        <div class="col-1 states">
                            <div class="d-flex flex-column align-items-center mb-2">
                                <strong>{{ $question->score }}</strong>
                                <span>{{ Str::plural('vote', $question->answers_count) }}</span>
                            </div>

                            <div class="d-flex flex-column align-items-center mb-2">
                                <strong>{{ $question->answers_count }}</strong>
                                <span>{{ Str::plural('answer', $question->answers_count) }}</span>
                            </div>

                            <div class="text-center mb-2 text-nowrap">
                                <strong>{{ $question->view_count }}</strong>
                                <span>{{ Str::plural('view', $question->view_count) }}</span>
                            </div>
                        </div>

                        <div class="col">
                            <h4>
                                <a href="{{ $question->path() }}">{{ $question->title }}</a>
                            </h4>

                            <div class="mb-2">
                                {!! Str::limit($question->body, 200) !!}
                            </div>

                            <div class="float-left">
                                @foreach($question->tags as $tag)
                                    <a href="{{ route('tags.show', $tag) }}"
                                       class="tag">{{ $tag->name }}</a>
                                @endforeach
                            </div>

                            <div class="float-right">
                                <div class="small text-secondary text-left ml-1">Asked {{ $question->created_at->diffForHumans() }}</div>
                                <div class="user-box">
                                    <a href="{{ route('users.show', $question->owner) }}">
                                        <img class="user-avatar" src="{{ $question->owner->avatar_path }}" alt="Avatar" width="30"
                                             height="30">
                                        <span class="user-name">{{ $question->owner->name }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 fs-2">
                        <p>Nothing Found.</p>
                    </div>
                @endforelse
            </div>

            @yield('pager')
        </div>

        <div class="col-3">
            @include('partials._hot-questions')
        </div>
    </div>
@endsection
