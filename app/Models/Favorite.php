<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $guarded=[];
    
    use HasFactory;

    protected function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
