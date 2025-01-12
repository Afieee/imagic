<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'premium',
    ];

    public function post()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function post_likes()
    {
        return $this->hasMany(PostLike::class, 'id_users', 'id');
    }


    public function comment()
    {
        return $this->hasMany(Comment::class, 'id_post', 'id_post');
    }


    public function following()
    {
        return $this->hasMany(Follow::class, 'id_following');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow', 'id_followed', 'id_following')
            ->where('follow', true);
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follow', 'id_following', 'id_followed')
            ->where('follow', true);
    }


    // public function followersCollection()
    // {
    //     return $this->belongsToMany(User::class, 'follow', 'id_followed', 'id_following');
    // }



    public function follows()
    {
        return $this->hasMany(Follow::class, 'id_following');
    }

    public function isFollowing($userId)
    {
        // Menggunakan relasi follow untuk memeriksa apakah pengguna sedang mengikuti user dengan ID tertentu
        return $this->follows()->where('id_followed', $userId)->exists();
    }


    public function isFollowedBySessionUser()
    {
        $id_following = session('user')->id ?? null;

        if (!$id_following) {
            return false;
        }
        $follow = Follow::where('id_following', $id_following)
            ->where('id_followed', $this->id)
            ->first();

        return $follow && $follow->follow; // Return true jika `follow` bernilai true
    }



    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'id_user');
    }

    public $timestamps = true;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
