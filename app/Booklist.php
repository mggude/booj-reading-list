<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booklist extends Model
{
    //Associate the booklist with a user
    public function user()
    {

        return $this->belongsTo(User::class);
        
    }
}
