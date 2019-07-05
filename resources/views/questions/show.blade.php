@extends('layouts.app')

@section('content')
    <question-view :question="{{ $question }}" inline-template>
        <div v-cloak class="p-5">
            <div class="border-bottom mb-3">
                <input type="text" v-if="editing" v-model="form.title" placeholder="Question Title"
                       class="form-control mb-3">
                <div v-else class="d-flex justify-content-between align-items-start">
                    <h1 v-text="title" class="font-weight-normal"></h1>
                    <a href="{{ route('questions.create') }}" class="btn btn-primary">Ask Question</a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="row mb-3">
                        @include('questions._question-left')

                        @include('questions._question-right')
                    </div>

                    <div>
                        <div class="border-bottom pb-1 mb-1">
                            <h3 class="font-weight-normal">{{ $question->answers_count }} Answers</h3>
                        </div>

                        <answers></answers>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card mb-2">
                        <div class="card-body text-center">
                            <h6><span class="text-secondary">Asked:</span> {{ $question->created_at->diffForHumans() }}
                            </h6>
                            <h6><span class="text-secondary">Viewed:</span> {{ $question->view_count }} times</h6>
                        </div>
                    </div>

                    @include('partials._hot-questions')
                </div>
            </div>
        </div>
    </question-view>
@endsection
