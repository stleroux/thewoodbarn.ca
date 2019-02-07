<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Item extends Model implements AuditableContract
{

	use SoftDeletes;
	use Auditable;
	
	protected $dates = ['deleted_at'];
	
    public $fillable = ['title','description'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

}