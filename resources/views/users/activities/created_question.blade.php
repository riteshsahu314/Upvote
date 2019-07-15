@component('users.activities.activity')
    @slot('heading')
        {{ $user->name }} asked
        <a href="{{ $activity->subject->path() }}">
            {{ $activity->subject->title }}
        </a>
    @endslot

    @slot('body')
        {{ Str::limit($activity->subject->body, 200) }}
    @endslot
@endcomponent
