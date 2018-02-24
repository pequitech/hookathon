<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bin extends Model
{
    use SoftDeletes;
    protected $fillable = ["name","user_id","uid"];

    // RELATIONSHIPS

    public function user(){
        return $this->belongsTo(\App\User::class);
    }
}
