<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use DateTimeInterface;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "categories";

    protected $fillable = [
        'name',
        'slug',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function post() : BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
