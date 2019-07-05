@extends('layouts.app')

@section('content')
    <div class="p-5">
        <div class="mb-4">
            <div class="mb-3">
                <h2>Users</h2>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <div></div>
                <div class="btn-group">
                    <a class="btn btn-outline-secondary" href="?sortBy=new">New</a>
                    <a class="btn btn-outline-secondary" href="?sortBy=name">Name</a>
                </div>
            </div>
        </div>

        <div id="users-list" class="mb-3">
            @foreach($users as $user)
                <div class="user-box w-auto border-bottom">
                    <a href="{{ route('users.show', $user) }}">
                        <img src="{{ $user->avatar_path }}" alt="User Avatar" width="50" height="50"
                             class="mr-2 rounded-circle">
                        <span>{{ $user->name }}</span>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="clearfix">
            <div class="pager float-right">
                {{ $users->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
@endsection
