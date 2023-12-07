<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;

class PostController extends Controller
{

    public function __construct()
    {
        // $this->middleware(\App\Http\Middleware\LoggerMiddleware::class)->only("create");
        // $this->middleware(\App\Http\Middleware\CheckTypeMiddleware::class)->only("create");
        $this->middleware(\App\Http\Middleware\SlugPostMiddleware::class)->only("store");
        $this->middleware(\App\Http\Middleware\CheckExistsCategoryMiddleware::class)->only("create");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // https://stackoverflow.com/questions/49435261/laravel-find-posts-from-current-user
        $existingUser = Auth::user();
        return view("pages.admin.posts.index")->with("posts", $existingUser->posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("pages.admin.posts.create", [
            "categories" => \App\Models\Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        // dd($request->validated());
        $existingUser = Auth::user();
        $request->image = $request->image->store("posts/images", "public");

        // dd($request->image);

        $existingUser->posts()
            ->make([
                ...$request->validated(),
                "image" => $request->image,
            ])
            ->save();

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // dd($post->comments()->get()[0]->replies()->toSql());

        return view("pages.admin.posts.show")
            ->with("post", $post)
            ->with("author", $post->user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view("pages.admin.posts.edit")
            ->with("post", $post)
            ->with("categories", \App\Models\Category::all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // dd($request->hasFile("image")); // check if image field has value or not (uploaded or not)
        $data = $request->validated();
        if ($request->hasFile("image")) {
            Storage::delete("public/" . $post->image); // DELETE OLD IMAGE

            $data["image"] = $request->image->store("posts/images", "public"); // SAVE NEW IMAGE - UPDATE IMAGE
        }

        $post->update($data);
        return redirect()->route("admin.posts.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $post = Post::withTrashed()->findOrFail($id);
        try {
            if ($post->trashed()) {
                Storage::delete("public/" . $post->image);
                // Storage look for directory /storage/app.

                $post->forceDelete(); // permanent delete - in trashed page
            } else
                $post->delete(); // soft delete - in index page
        } catch (\Throwable $e) {
            session()->flash("error", "Post could not be deleted");
        }

        // previous page
        return redirect()->back();
    }

    public function trashed(Request $request)
    {
        // dd(Post::onlyTrashed()->get());
        return view("pages.admin.posts.trashed")->with("posts", Post::onlyTrashed()->get());
    }

    public function restore($id)
    {
        // dd($post);
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route("admin.posts.index");
    }

    public function editor(Request $request)
    {
        // dd($request->all());
        // dd($request->hasFile("upload"));
        if ($request->hasFile("upload")) {
            // create an image manager instance with favored driver
            $manager = new ImageManager(['driver' => 'imagick']);

            // Get Filename with Extension
            $filenamewithextension = $request->file("upload")->getClientOriginalName();

            // Get Filename without Extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            // Get File Extension
            $extension = $request->file("upload")->getClientOriginalExtension();

            // Filename To Store /public/storage/filename.ext
            $filenametostore = $filename . "_" . time() . "_" . $extension;

            // Upload Image
            $request->file("upload")->storeAs("public/editor", $filenametostore);
            $request->file("upload")->storeAs("public/editor/thumbnail", $filenametostore);

            // Resize image here
            $thumbnailpath = public_path("storage/editor/thumbnail/" . $filenametostore);
            $img = $manager->make($thumbnailpath)->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($thumbnailpath);
            // https://www.youtube.com/watch?v=lMe6scNMJMA
            // https://image.intervention.io/v2/introduction/installation#integration-in-laravel
            // https://trendoceans.com/install-imagemagick-php-extension-in-linux/



            return response()->json([
                "uploaded" => true,
                "fileName" => $filenametostore,
                "url" => asset("storage/editor/" . $filenametostore),
            ]);
        }
    }
}


/**
 * Route Model binding doesn't work with restore deleted posts and permanent delete
 */
