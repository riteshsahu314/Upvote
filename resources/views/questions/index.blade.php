@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                @forelse($questions as $question)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>
                                <a href="{{ $question->path() }}">{{ $question->title }}</a>
                            </h4>
                            <h5>Asked By: {{ $question->owner->name }}</h5>
                            <p>
                                <a href="{{ $question->path() }}">
                                    {{ $question->answers_count }} {{ Str::plural('answer', $question->answers_count) }}
                                </a>
                            </p>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $question->body }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p>There is no questions at this time.</p>
                @endforelse

                {{ $questions->render() }}
            </div>
        </div>
    </div>
@endsection
