<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        "name",
    ];

    // A category has many posts
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // TEST - A category has many posts - WRONG
    // public function users(): HasMany
    // {
    //     return $this->hasMany(User::class);
    //     // Category::find($id)->users;
    //     // SELECT * FROM users WHERE category_id = $id AND category_id IS NOT NULL
    // }
}
