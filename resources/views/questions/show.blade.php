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

                        @can('update', $question)
                            <div class="card-footer">
                                <form method="post" action="{{ route('questions.destroy', $question) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-sm float-right">DELETE</button>
                                </form>
                            </div>
                        @endcan
                    </div>

                    <answers></answers>
                </div>
            </div>
        </div>
    </question-view>
@endsection
