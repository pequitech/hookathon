<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'uid', 'bin_id', 'header', 'body'
    ];

    protected $casts = [
       'header' => 'array',
       'body' => 'array'
   ];

    // RELATIONSHIP

    public function bin(){
        return $this->belongsTo(\App\Bin::class);
    }
}
