<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Message extends Model
{
    protected $guarded=[];
    use HasFactory;

    public function usersender(){
        return $this->hasOne(User::class,'id','sender_id');
    }

    public function userreceiver(){
        return $this->hasOne(User::class,'id','receiver_id');
    }
    
}
