<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'active'
    ];

    protected $attributes = [
        'active' => true,
    ];

    public function parentCategoryName(): BelongsTo
    {
         return $this->belongsTo(Category::class, 'category_id');
    }
}
