<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Auth;


class Recipe extends Model implements AuditableContract
{
	use Auditable;

	// a recipe belongsTo one user
	// a related entry needs to be added to the post model
	// used in show page to display the author's name
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function modified_by()
	{
		return $this->belongsTo('App\User');
	}

	public function last_viewed_by()
	{
		return $this->belongsTo('App\User');
	}

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	// used in the add and remove favorite
	public function favorites()
	{
		return $this->belongsToMany('App\User')
			->where('user_id','=',Auth::user()->id);
	}




}
