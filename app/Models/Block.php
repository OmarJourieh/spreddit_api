<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Block extends Model
{
    protected $guarded=[

    ];
    use HasFactory;
    public function blockuser(){
       return $this->hasOne(User::class,'id','blocked_id');
    }
    
}
