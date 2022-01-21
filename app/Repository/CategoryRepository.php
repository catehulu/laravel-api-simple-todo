<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function getAllCategory()
    {
        return Category::all() ?? [];
    }
}
