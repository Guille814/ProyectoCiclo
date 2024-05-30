<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'biography', 'created_by', 'imagen_perfil', 'banner_perfil',
        'spotify_url', 'soundcloud_url', 'youtube_url', 'apple_music_url'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'group_members')->withPivot('role')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function followers()
    {
        return $this->hasMany(GroupFollower::class);
    }

    public function isFollowedBy($user)
    {
        return $this->followers()->where('user_id', $user->id)->exists();
    }

    // En tu modelo Group
    public function isMemberOrCreator(User $user)
    {
        return $this->creator_id == $user->id || $this->members->contains($user);
    }
}
