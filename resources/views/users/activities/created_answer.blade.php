@component('users.activities.activity')
    @slot('heading')
        {{ $user->name }} answered to
        <a href="{{ $activity->subject->question->path() }}">
            {{ $activity->subject->question->title }}
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
