@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>{{ $question->title }}</h4>
                        <h5>Asked By: {{ $question->owner->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $question->body }}
                        </p>
                    </div>
                </div>

                @foreach($question->answers as $answer)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>{{ $answer->owner->name }} answered {{ $answer->created_at->diffForHumans() }}</h5>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $answer->body }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
