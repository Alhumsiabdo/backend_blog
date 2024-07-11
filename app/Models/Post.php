<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'slug',
        'status',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'post_tag');
    }

    public function images() : HasMany
    {
        return $this->hasMany(PostImage::class);
    }
}
