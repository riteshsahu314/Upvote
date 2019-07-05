@extends('layouts.app')

@section('content')
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
        @foreach($users as $user)
            <a href="{{ route('users.show', $user) }}" class="m-1 border border-info" style="width: 24%;">
                <div class="card-body d-flex align-items-center p-2">
                    <img src="{{ $user->avatar_path }}" alt="User Avatar" width="50" height="50"
                         class="mr-2 rounded-circle">

                    <h5>{{ $user->name }}</h5>
                </div>
            </a>
        @endforeach
    </div>

    <div class="row">
        {{ $users->appends(request()->except('page'))->links() }}
    </div>
@endsection

@section('sidebar')
    @include('partials._hot_questions')
@endsection
