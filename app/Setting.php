<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

     public $timestamps = false;

	public $fillable = [
		'name',
		'displayName',
		'value',
		'description'
		];

}