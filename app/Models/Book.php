<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Book
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $description
 * @property string|null $iban
 * @property int|null $year
 * @property string|null $pages
 * @property string|null $format
 * @property string|null $language
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $sku
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $viewed_count
 * @property string|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Auction[] $auctions
 * @property-read int|null $auctions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author[] $authors
 * @property-read int|null $authors_count
 * @property-read \App\Models\Category $category
 * @method static \Database\Factories\BookFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Query\Builder|Book onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereViewedCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|Book withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Book withoutTrashed()
 * @mixin \Eloquent
 */
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
