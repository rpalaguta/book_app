<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'description', 'iban', 'year', 'format', 'language'
    ];

    public function getCategoryName()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
