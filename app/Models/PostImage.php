<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostImage extends Model
{
    use HasFactory;

    protected $table = "post_images";

    protected $fillable = [
        'post_id',
        'path'
    ];

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
