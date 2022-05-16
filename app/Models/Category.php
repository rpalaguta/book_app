<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'active'
    ];

    protected $attributes = [
        'active' => true,
    ];

    public function parentCategoryName()
    {
         return $this->belongsTo(Category::class, 'category_id');
    }
}
