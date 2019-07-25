<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booklist extends Model
{
    //Associate the booklist with a user
    protected $fillable = [
        'title',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
