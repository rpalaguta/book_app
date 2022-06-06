<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'category_id', 'description', 'iban', 'year', 'pages', 'format', 'language', 'sku'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    //protected $with = ['category'];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function auctions(): hasMany
    {
        return $this->hasMany(Auction::class);
    }

    public function bookType(): Attribute
    {
        return new Attribute(fn() => 'SuperKnyga');
    }

    //
//    public function jsonSerialize(): array
//    {
//        return [
//            'name' => $this->name,
//            'description' => $this->description,
//            'sugalvojau' => 'tipas'
//        ];
//    }
}
