<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    // Mass assignment - Post::create($request->all());
    // take only the fields that are in the fillable array
    protected $fillable = [
        "title",
        "description",
        "slug",
        "body",
        "image",
        "user_id",
        "category_id",
        "status",
    ];


    // Default value for status
    protected $attributes = [
        "status" => "draft",
    ];

    // One to many relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class); // if the foreign key is not category_id, then add it as a second parameter
    }

}
