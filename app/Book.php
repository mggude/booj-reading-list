<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    //Allows multiple selected books to transfer between lists
    protected $fillable = [
        'title',
        'list_id',
    ];

}
