<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tags = Tag::all();
        return view("pages.admin.tags.index")->with("tags", $tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("pages.admin.tags.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required|unique:tags",
        ]);

        Tag::create($request->all());

        return redirect()->route("admin.tags.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
        // dd($tag->posts()->create([])->toSql());

        return view("pages.admin.tags.show", [
            "tag" => $tag,
            "posts" => $tag->posts()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
        return view('pages.admin.tags.edit')->with("tag", $tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {

        $request->validate([
            "name" => "required|unique:tags",
        ]);

        $tag->name = $request->input("name");
        $tag->save();

        return redirect()->route("admin.tags.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
