@component('users.activities.activity')
    @slot('heading')
        {{ $user->name }} favorited
        <a href="{{ $activity->subject->question->path() }}">
            {{ $activity->subject->question->title }}
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->question->body }}
    @endslot
@endcomponent
