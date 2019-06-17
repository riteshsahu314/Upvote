@extends('layouts.app')

@section('content')
    <question-view :question="{{ $question }}" inline-template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    @include('questions._question')

                    <answers></answers>
                </div>
            </div>
        </div>
    </question-view>
@endsection
