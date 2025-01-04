<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{

    protected $table = 'post_likes';
    protected $primaryKey = 'like_id';
    protected $fillable = [
        'id_post',
        'id_users',
        'like',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }
}
