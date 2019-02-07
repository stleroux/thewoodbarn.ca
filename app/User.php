<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class User extends Authenticatable implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'first_name', 'username', 'role_id', 'email', 'password', 'selfRegistered', 'style', 'active', 'author_fmt', 'createFormat', 'rowsPerPage', 'actionButtons'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
    * Always capitalize the first name when we retrieve it
    */
    public function getFirstNameAttribute($value) {
        return ucfirst($value);
    }

    /**
     * Always capitalize the last name when we retrieve it
     */
    public function getLastNameAttribute($value) {
        return ucfirst($value);
    }

    /**
    * Always capitalize the first letter of the username when we retrieve it
    */
    public function getUsernameAttribute($value) {
        return ucfirst($value);
    }

    public function recipes()
    {
        return $this->belongsToMany('App\Recipe');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function role()
    {
        return $this->belongsTo('App\Role')->orderBy('name', 'asc');
    }

    // public function role()
    // {
    //     return $this->hasOne('App\Role')->orderBy('name', 'asc');
    // }

    public function orders ()
    {
        return $this->hasMany('App\Order');
    }

    public function items ()
    {
        return $this->belongsToMany('App\Item');
    }

    public function userProfile()
    {
       return $this->hasOne('UserProfile');
    }
}
