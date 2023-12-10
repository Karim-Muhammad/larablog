<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class); // if the foreign key is not category_id, then add it as a second parameter
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull("parent_id");
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag(string $tagID) {
        return in_array($tagID, $this->tags->pluck('id')->toArray());
    }

    // protected $guarded = [
    //     "id",
    //     "image"
    // ];

}
