@extends('layouts.app')

@section('content')
    <question-view :question="{{ $question }}" inline-template>
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <div class="row justify-content-center" v-cloak>
                        @include('questions._question')
                    </div>

                    <answers></answers>
                </div>

                <div class="col-2">
                    <div class="card">
                        <div class="card-body">
                            <span><strong>Asked:</strong> {{ $question->created_at->diffForHumans() }}</span>
                            <span><strong>Viewed:</strong> {{ $question->view_count }} times</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </question-view>
@endsection
