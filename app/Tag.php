<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Tag extends Model implements AuditableContract
{
	use Auditable;
	
	public function posts()
	{
		return $this->belongsToMany('App\Post');
		// return $this->belongsToMany('App\Post', 'nameOfTable (post_tag)', 'this model id', 'foreign model id');
	}
}
