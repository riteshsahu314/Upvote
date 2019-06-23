<div class="col-1 d-flex flex-column justify-content-start align-items-center" style="font-size: 1.5rem;">
    <div>
        <form action="{{ route('questions.votes.store', ['question' => $question, 'type' => 'UpVote']) }}" method="post">
            @csrf
            <button class="btn btn-link"><i class="fas fa-caret-up fa-3x"></i></button>
        </form>
    </div>
    <div>
        <span>{{ $question->score }}</span>
    </div>
    <div>
        <form action="{{ route('questions.votes.store', ['question' => $question, 'type' => 'DownVote']) }}" method="post">
            @csrf
            <button class="btn btn-link"><i class="fas fa-caret-down fa-3x"></i></button>
        </form>
    </div>
</div>

<div class="col-11">
    {{-- Editing the Question --}}
    <div class="card mb-3" v-if="editing">
        <div class="card-header">
            <input type="text" v-model="form.title" placeholder="Question Title" class="form-control">
        </div>
        <div class="card-body">
            <wysiwyg v-model="form.body"></wysiwyg>
        </div>

        @can('update', $question)
            <div class="card-footer">
                <button class="btn btn-primary btn-sm float-left mr-3" @click="update">Update</button>
                <button class="btn btn-link btn-sm float-left" @click="resetForm">Cancel</button>
                <form method="post" action="{{ route('questions.destroy', $question) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link btn-sm float-right">DELETE</button>
                </form>
            </div>
        @endcan
    </div>


    {{-- Viewing the Question --}}
    <div class="card mb-3" v-else>
        <div class="card-header d-flex justify-content-between">
            <div class="">
                <h4 v-text="title"></h4>
                <h5>
                    Asked By: 
                    <a href="{{ route('users.show', $question->owner) }}" class="ml-1">
                        <img src="{{ $question->owner->avatar_path }}"
                             alt="User Avatar" width="25" height="25" class="rounded-circle mr-1">
                        {{ $question->owner->name }}
                    </a>
                </h5>
            </div>
            <favorite :question="{{ $question }}"></favorite>
        </div>
        <div class="card-body" v-html="body"></div>

        @can('update', $question)
            <div class="card-footer">
                <button class="btn btn-secondary btn-sm" @click="editing = true">Edit</button>
            </div>
        @endcan

        <div>
            <ul class="list-group">
                @foreach($question->comments as $comment)
                    <li class="list-group-item" id="{{ "comment-{$comment->id}" }}">
                        {{ $comment->body }} - <a href="{{ route('users.show', $comment->owner) }}">{{ $comment->owner->name }}</a>
                    </li>
                @endforeach
            </ul>

            @auth
                <form action="{{ url("/questions/{$question->slug}/comments") }}" method="post">
                @csrf

                <!-- Form Input for Comment body-->
                    <div class="d-flex">
                        <textarea class="form-control" style="min-height: 53px;" name="body" rows="1" placeholder="add a comment..."></textarea>

                        <button type="submit" class="btn btn-primary align-self-start m-2">Publish</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
</div>
