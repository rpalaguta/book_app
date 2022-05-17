<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'description', 'birthday'
    ];

    public function getFullNameAttribute(): string
    {
        return sprintf('%s %s', ucfirst($this->first_name), ucfirst($this->last_name));
    }
}
