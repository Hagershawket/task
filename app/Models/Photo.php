<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model 
{

    protected $table = 'photos';
    protected $fillable =[
        'data',
    ];
    public $timestamps = true;

    public function photoable()
    {
        return $this->morphTo();
    }

}