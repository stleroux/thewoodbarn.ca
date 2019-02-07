<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Tweet extends Model implements AuditableContract
{
	use Auditable;
	
	public $fillable = ['title','body'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
