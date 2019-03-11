<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        // 'id', 'userid_fk', 'book', 'created_at', 'updated_at',
        'userid_fk', 'book',
    ];

}
