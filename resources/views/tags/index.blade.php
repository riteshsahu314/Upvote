@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-end mb-2">
            <ul class="nav nav-pills" id="tabs">
                <li class="nav-item">
                    <a class="nav-link" href="?sortBy=name">Name</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?sortBy=new">New</a>
                </li>
            </ul>
        </div>

        <div class="row justify-content-start mb-3">
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

        <div class="row">
            {{ $tags->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection
