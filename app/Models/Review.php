<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'customer', 'review', 'star',
  
     ];
  
     public function products(){
      return $this->belongsTo( Product :: class);
     }
}
