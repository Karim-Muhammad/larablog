<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // https://stackoverflow.com/questions/49435261/laravel-find-posts-from-current-user
        $existingUser = Auth::user();
        return view("pages.posts.index")->with("posts", $existingUser->posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("pages.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view("pages.posts.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        return view("pages.posts.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        try {
            $post->deleteOrFail();
        } catch (\Throwable $e) {
            session()->flash("error", "Post could not be deleted");
        }

        return redirect()->route('posts.index');
    }
}
