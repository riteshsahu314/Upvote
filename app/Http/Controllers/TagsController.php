<?php

namespace App\Http\Controllers;

use App\Filters\TagFilter;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request, TagFilter $filter)
    {
        if ($request->expectsJson()) {
            $query = $request['q'];

            $tags = Tag::search($query);

            return $tags->get();
        }

        $tags = Tag::filter($filter)->paginate(20);

        return view('tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }
}
