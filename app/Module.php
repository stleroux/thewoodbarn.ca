<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Module extends Model implements AuditableContract
{
	use Auditable;
	
    /**
    * Always capitalize the first name when we retrieve it
    */
    public function getNameAttribute($value) {
        return ucfirst($value);
    }

}
