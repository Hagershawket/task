<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{

    protected $table = 'comments';
    protected $fillable =[

        'post_id',
        'comment',
    ];
    public $timestamps = true;

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

}