<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Article extends Model implements AuditableContract
{
	use SoftDeletes;
    use Auditable;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'category_id',
		'description_eng',
        'description_fre',
		'user_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
