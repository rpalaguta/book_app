<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'category_id', 'active'
    ];

    protected $attributes = [
        'active' => true,
    ];

    protected $softDelete = true;

    public function parentCategoryName(): BelongsTo
    {
         return $this->belongsTo(Category::class, 'category_id');
    }

    public function categories(): hasMany
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories(): hasMany
    {
        return $this->hasMany(Category::class)->with('categories');
    }
}
