<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\User', 'user_roles');
    }

}
