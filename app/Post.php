<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Post extends Model implements AuditableContract
{
	use Auditable;
	
	// 1 category belongs to many posts
	// a related entry needs to be added to the category model
	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Tag');
	}

	public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function modified_by()
	{
		return $this->belongsTo('App\User');
	}
public function isAdmin() {
		if (Auth::user()->level == 100) {
			return true;
		}
	}
}
