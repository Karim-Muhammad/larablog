<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(["m1", "m2"]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        dd($request->all());
        // return view("pages.category.index")->with("categories", Category::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("pages.admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        // Mass assignment - Post::create($request->all()); - Don't forget to add the fields in the fillable array in the model
        Category::create($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // try by myself
        // dd(Category::find($id)->posts());
        // dd(Category::find($id)->posts[0]->category["name"]); // 'category()' must be method relationshio in 'Post' model to use this syntax
        // dd(Category::find($id)->posts[0]->category->name); // 'category()' must be method relationshio in 'Post' model to use this syntax

        // dd(Category::find($id)->users); WRONG

        return view("pages.admin.category.show", [
            "category" => Category::find($id),
            "posts" => Category::find($id)->posts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) // not model injection, so paramter name can be anything
    {
        //
        return view("pages.admin.category.edit")->with("category", Category::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, string $id)
    // must parameter name match with parameter url if using Model Injection otherwise it will be OK
    {
        //
        $category = Category::find($id);
        $category->name = $request->input("name");
        $category->save();

        return redirect()->route("admin.category.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    // Route Model Binding - Model injection
    public function destroy(Category $category) // must parameter name match with parameter url for Model injection
    {
        //
        try {
            $category->deleteOrFail(); // $id is a model not just number now!
        } catch (\Throwable $e) {
            session()->flash("error", "Category could not be deleted");
        }

        return redirect()->route("admin.category.index");
    }
}
