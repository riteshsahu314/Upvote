@extends('layouts.app')

@section('content')
    <question-view :question="{{ $question }}" inline-template>
        <div class="container">
            <div class="row justify-content-center" v-cloak>
                @include('questions._question')
            </div>

            <answers></answers>
        </div>
    </question-view>
@endsection
