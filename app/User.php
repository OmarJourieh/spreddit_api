<?php

namespace App;


use App\Models\Book;
use App\Models\BookUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;



class User extends Authenticatable implements JWTSubject
{
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function Books(){
        return $this->belongsToMany('App\Models\Book','book_user')->withPivot(['id','date_out','date_in','due_date']);
    }

    public function Bookss()
    {
        return $this->belongsToMany(Book::class,'my_favortes','user_id','Book_id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

}
