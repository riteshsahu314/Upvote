@extends('layouts.app')

@section('content')
    <question-view :question="{{ $question }}" inline-template>
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

                    <answers :answers="{{ $question->answers }}"></answers>
                </div>
            </div>
        </div>
    </question-view>
@endsection