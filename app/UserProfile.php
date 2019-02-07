<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

	protected $table = 'user_profile';
	public $timestamps = false;

	public $fillable = [
		'authorFormat',
		'show_email',
		'style',
		'landingPage',
		'display',
		'dateFormat',
		'rowsPerPage',
		'actionButtons',
		'alertFadeTime',
		'place_of_birth',
		];

	public function user()
	{
		return $this->belongsTo('User');
	}

}
