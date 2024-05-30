<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // Relación con el usuario que dio like
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el post que recibió el like
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
