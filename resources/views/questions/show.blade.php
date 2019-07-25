@extends('layouts.app')

@section('content')
    <question-view :question="{{ $question }}" inline-template>
        <div v-cloak class="main-container">
            <div class="border-bottom mb-3">
                <input type="text" v-if="editing" v-model="form.title" placeholder="Question Title"
                       class="form-control mb-3">
                <div v-else class="d-md-flex justify-content-between align-items-start">
                    <div class="order-2 mb-3 d-flex justify-content-end">
                        <a href="{{ route('questions.create') }}" class="btn btn-primary text-nowrap">Ask Question</a>
                    </div>
                    <div class="mr-3 order-1">
                        <h1 v-text="title" class="font-weight-normal"></h1>
                        <div class="mb-2">
                            <div class="d-flex">
                                <h6 class="mr-3">
                                    <span class="text-secondary">Asked:</span>
                                    <span> {{ $question->created_at->diffForHumans() }}</span>
                                </h6>
                                <h6>
                                    <span class="text-secondary">Viewed:</span>
                                    <span> {{ $question->view_count }} times</span>
                                </h6>
                            </div>
                        </div>
                    </div>
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

                <div class="col-lg-3">
                    @include('partials._hot-questions')
                </div>
            </div>
        </div>
    </question-view>
@endsection
