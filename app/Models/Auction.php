<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Auction
 *
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property int $enabled
 * @property int $quantity
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Auction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Auction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Auction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auction whereUserId($value)
 * @mixin \Eloquent
 */
class Auction extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
