<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'name', 'email', 'password',
        'name', 'email', 'mobile', 'password', 'user_img',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // TO IGNORE CREAYED_AT AND UPDATED_AT
    //public $timestamps = FALSE;

    // RELATION WITH BOOKS TABLE
    public function books()
    {
        return $this->hasOne('App\Book', 'userid_fk', 'id');
    }

    public function getNameAttribute($value)
    {
        // return strtoupper($value);
        return ($value);
    }

    // CREATE RELATION WITH UERS AND QUESTIONS
    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute()
    {
        return "#";
    }

}
