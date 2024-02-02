<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TagsController;

use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::name("admin.")->prefix("admin")->middleware("auth")->group(function () {

    Route::middleware("admin")->group(function() {
        Route::resource("category", AdminCategoryController::class);
    });

    Route::resource("tags", TagsController::class);

    Route::resource("posts", AdminPostController::class)->where(["post" => "[0-9]+"]);
    Route::get("posts/trashed", [AdminPostController::class, "trashed"])->name("posts.trashed");
    Route::patch("posts/{post}/restore", [AdminPostController::class, "restore"])->name("posts.restore")->where(["post" => "[0-9]+"]);

    Route::resource("users", AdminUserController::class);

    Route::post("ckeditor/upload", [AdminPostController::class, "editor"])->name("ckeditor.upload");
}); 

Route::resource("comments", CommentController::class)->middleware("auth")->except(["index", "show", "create"]);
Route::resource("posts", PostController::class);