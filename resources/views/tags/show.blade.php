@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="card">
                <div class="card-header">{{ $tag->name }}</div>

                <div class="card-body">
                    {{ $tag->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
