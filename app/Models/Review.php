<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Flat3\Lodata\Attributes\LodataRelationship;

class Review extends Model
{
    use HasFactory;

    

     #[LodataRelationship]
     public function products(){
      return $this->belongsTo( Product :: class);
     }
}
