<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    //Allows multiple selected books to transfer between lists
    protected $fillable = [
        'list_id',
    ];

    public function user()

    {

        return $this->belongsTo(User::class);
        
    }
}
