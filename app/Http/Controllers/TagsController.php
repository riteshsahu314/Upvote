<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $query = $request['q'];

        $tags = Tag::search($query);

        if ($request->expectsJson()) {
            return $tags->get();
        }

        $tags = $tags->paginate(20);

        return view('tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }
}
