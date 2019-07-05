@extends('layouts.app')

@section('content')
    <div class="p-5">
        <div class="mb-4">
            <div class="mb-3">
                <h2>Tags</h2>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <div></div>
                <div class="btn-group">
                    <a class="btn btn-outline-secondary" href="?sortBy=new">New</a>
                    <a class="btn btn-outline-secondary" href="?sortBy=name">Name</a>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div id="tags-list">
                @foreach($tags as $tag)
                    <div class="tag-box border-bottom">
                        <div class="mb-2">
                            <a class="tag" href="{{ route('tags.show', $tag) }}">
                                {{ $tag->name }}
                            </a>
                        </div>

                        <div>
                            <p class="tag-desc">{{ Str::limit($tag->description, 200) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="clearfix">
            <div class="pager float-right">
                {{ $tags->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
@endsection
