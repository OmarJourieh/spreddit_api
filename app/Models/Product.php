<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Product extends Model
{
    protected $guarded=[];
    
    use HasFactory;
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    
}
