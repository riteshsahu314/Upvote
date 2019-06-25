@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            @foreach($users as $user)
                <a href="{{ route('users.show', $user) }}" class="m-1 border border-info" style="width: 24%;">
                    <div class="card-body d-flex align-items-center p-2">
                        <img src="{{ $user->avatar_path }}" alt="User Avatar" width="50" height="50" class="mr-2 rounded-circle">

                        <h5>{{ $user->name }}</h5>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
