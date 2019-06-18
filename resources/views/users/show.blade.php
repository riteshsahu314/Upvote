@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="border-bottom p-2">{{ $user->name }}</h2>

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
