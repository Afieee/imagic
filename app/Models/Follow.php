<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follow';
    protected $primaryKey = 'id_follow';
    protected $fillable = ['id_following', 'id_followed', 'follow'];
    public function followed()
    {
        return $this->belongsTo(User::class, 'id_follow');
    }

    // Relasi ke pengguna yang mengikuti
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
