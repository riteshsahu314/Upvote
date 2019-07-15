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
                    <li class="comment d-flex align-items-center justify-content-between" id="{{ "comment-{$comment->id}" }}">
                        <div>
                            <span>{{ $comment->body }} - </span>
                            <a href="{{ route('users.show', $comment->owner) }}">{{ $comment->owner->name }}</a>
                        </div>

                        @can('update', $comment)
                            <form action="/questions/{{ $question->slug }}/comments/{{ $comment->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link py-0">Delete</button>
                            </form>
                        @endcan
                    </li>
                @endforeach
            </ul>

            <div>
                @auth
                    <vue-show>
                        <template v-slot:link>
                            <span>add comment</span>
                        </template>

                        <template v-slot:body>
                            <!-- Form for Comment body-->
                            <form action="{{ url("/questions/{$question->slug}/comments") }}" method="post">
                                <div class="d-flex align-items-start">
                                    @csrf
                                    <textarea class="form-control mr-2" style="min-height: 53px;" name="body"
                                              placeholder="add a comment..."></textarea>

                                    <button type="submit" class="btn btn-sm btn-primary text-nowrap">
                                        Add Comment
                                    </button>
                                </div>
                            </form>
                        </template>
                    </vue-show>
                @endauth
            </div>
        </div>
    </div>
</div>
