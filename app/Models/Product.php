<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Flat3\Lodata\Attributes\LodataRelationship;

class Product extends Model
{
    use HasFactory;

    #[LodataRelationship]
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
