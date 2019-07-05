@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5">
        <div class="row justify-content-center">
            <div class="col-3">
                <div class="text-center">
                    <div>
                        <img src="{{ $user->avatar_path }}" alt="User Avatar" width="200" height="200">
                    </div>

                    <h2 class="p-2">{{ $user->name }}</h2>

                    @can('update', $user)
                        <form method="post" action="{{ route('avatar', $user) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="avatar" class="mb-3 w-100" accept="image/*">
                            <button type="submit" class="btn btn-primary btn-sm form-control">Update Avatar</button>
                        </form>
                    @endcan
                </div>
            </div>

            <div class="col-9">
                <h2 class="p-2 border-bottom">Activities</h2>

                <div>
                    @foreach($user->activities as $activity)
                        @if (view()->exists("users.activities.{$activity->type}"))
                            <div class="mb-3">
                                @include("users.activities.{$activity->type}", ['activity' => $activity])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
