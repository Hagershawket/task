<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model 
{

    protected $table = 'posts';
    protected $fillable =[
        'user_id',
        'title',
        'description',
    ];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('deleted_at',Null);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'posts_tags');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

}