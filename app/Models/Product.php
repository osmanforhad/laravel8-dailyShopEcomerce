<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //relation with product table to category table
    public function fetchCategoryFromCategoryTable()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
