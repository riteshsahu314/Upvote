@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            @foreach($tags as $tag)
                <div class="card bg-light m-2" style="max-width: 23%;">
                    <div class="card-header">
                        <a href="{{ route('tags.show', $tag) }}">
                            {{ $tag->name }}
                        </a>
                    </div>

                    <div class="card-body">
                        <p class="card-text">{{ $tag->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $tags->render() }}

    </div>
@endsection
