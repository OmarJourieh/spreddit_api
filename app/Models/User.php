<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Message;
use App\Models\Rate;
use App\Models\Block;

class User extends Model
{
    protected $guarded=[

    ];
    use HasFactory;

    public function products() {
        return $this->hasMany(Product::class,'user_id','id');
    }
    public function userrater(){
        return $this->hasMany(Rate::class);

    }
    public function userrated(){
        return $this->hasMany(Rate::class);

    }
    public function usersender(){
        return $this->hasMany(Message::class,'sender_id');

    }
    public function userreceiver(){
        return $this->hasMany(Message::class,'receiver_id');

    }
    public function userblocker(){
        return $this->hasMany(Block::class,'blocker_id');

    }
    public function userblocked(){
        return $this->hasMany(Block::class,'blocked_id');

    }
}
