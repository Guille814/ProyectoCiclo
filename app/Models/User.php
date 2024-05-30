<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['nombre', 'apellido', 'username', 'email', 'password', 'imagen_perfil', 'biografia', 'spotify_url', 'soundcloud_url', 'youtube_url', 'apple_music_url'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follows_id', 'follower_id');
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'follows_id');
    }

    public function followUser(User $usuario)
    {
        $this->following()->attach($usuario->id);
    }

    public function unfollowUser(User $usuario)
    {
        $this->following()->detach($usuario->id);
    }

    public function isFollowing(User $usuario)
    {
        return $this->following()->where('follows_id', $usuario->id)->exists();
    }

    public function followersCount()
    {
        return $this->followers()->count();
    }

    public function followingCount()
    {
        return $this->following()->count();
    }


    public function socialLinks()
    {
        return $this->hasMany(UserSocialLink::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_members')->withPivot('role')->withTimestamps();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function followingGroups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_followers', 'user_id', 'group_id');
    }

    public function isFollowingGroup(Group $group)
    {
        return $this->followingGroups()->where('group_id', $group->id)->exists();
    }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_user');
    }
}
