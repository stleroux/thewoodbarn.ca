<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
    	return $this->belongsTo('App\Post');
    }

    public function recipe()
    {
    	return $this->belongsTo('App\Recipe');
    }
}
