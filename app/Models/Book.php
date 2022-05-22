<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'category_id', 'description', 'iban', 'year', 'pages', 'format', 'language', 'sku'
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
