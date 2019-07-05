<div class="col-11">
    {{-- Editing the Question --}}
    <div class="border-bottom" v-if="editing">

        <div class="mb-2">
            <wysiwyg v-model="form.body" class="mb-3"></wysiwyg>

            <tag-editor :tags="{{ $question->tags }}" @tag-added="addTag"
                        @tag-removed="removeTag"></tag-editor>
        </div>

        @can('update', $question)
            <div class="pt-2 pb-5">
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
    <div class="mb-3" v-else>
        <div v-html="body" class="mb-2"></div>

        <div class="mb-2">
            <a :href="`/tags/${tag.name}`" class="tag" v-for="tag in tags"
               v-text="tag.name"></a>
        </div>

        <div class="mt-4 mb-2 d-flex justify-content-between">
            <div>
                @can('update', $question)
                    <a href="#" class="btn btn-link btn-sm px-0" @click="editing = true">Edit
                    </a>
                @endcan
            </div>

            <div>
                <div class="small text-secondary text-left pl-2">
                    Asked {{ $question->created_at->diffForHumans() }}</div>
                <div class="user-box">
                    <a href="{{ route('users.show', $question->owner) }}" class="ml-1">
                        <img class="user-avatar" src="{{ $question->owner->avatar_path }}"
                             alt="User Avatar" width="25" height="25">
                        <span class="user-name">{{ $question->owner->name }}</span>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <ul class="comments">
                @foreach($question->comments as $comment)
                    <li class="comment" id="{{ "comment-{$comment->id}" }}">
                        {{ $comment->body }} - <a
                            href="{{ route('users.show', $comment->owner) }}">{{ $comment->owner->name }}</a>
                    </li>
                @endforeach
            </ul>

            @auth
                <form action="{{ url("/questions/{$question->slug}/comments") }}" method="post">
                @csrf

                <!-- Form Input for Comment body-->
                    <div class="d-flex">
                        <textarea class="form-control" style="min-height: 53px;" name="body" rows="1"
                                  placeholder="add a comment..."></textarea>

                        <button type="submit" class="btn btn-primary align-self-start m-2">
                            Publish
                        </button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
</div>
