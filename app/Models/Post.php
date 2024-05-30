<?php

// App\Models\Post.php
// App\Models\Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'texto',
        'imagen_url',
        'video_url',
        'group_id',  // Asegúrate de incluir el campo group_id
        'user_id'   // También asegúrate de incluir el campo user_id
    ];

    // Relación con el grupo
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // Relación con el usuario que creó el post
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con los likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy($user)
    {
        // Verificar si el usuario ha dado like a este post
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // Relación con los comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
