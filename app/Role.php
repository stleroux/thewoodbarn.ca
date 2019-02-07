<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends Model implements AuditableContract
{
	use Auditable;

	// public function permissions()
	// {
	// 	return $this->hasMany('App\Permission')->orderBy('name');
	// }

	public function users() {
		return $this->hasMany('App\User');
	}

// 	public function users() {
// 		return $this->belongsToMany('App\User');
// 	}
}