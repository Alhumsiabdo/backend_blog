<?php

namespace App\Repository\Dashboard\Eloquent;

use App\Models\Tag;
use App\Repository\Dashboard\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function __construct(Tag $tag)
    {
        parent::__construct($tag);
    }
}
