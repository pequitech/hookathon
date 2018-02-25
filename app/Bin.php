<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bin extends Model
{
    use SoftDeletes;
    protected $fillable = ["name","user_id","uid"];

    // RELATIONSHIPS

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function requests()
    {
        return $this->hasMany(\App\Request::class);
    }

    // SCOPES

    public function scopeLoggedUser($query, \App\User $user)
    {
        return $query->where('user_id', $user->id);
    }
}
