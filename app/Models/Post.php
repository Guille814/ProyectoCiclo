<?php

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
        'user_id', // Asegúrate de incluir el campo user_id para la relación con el usuario
        // Otros campos que desees agregar
    ];

    // Relación con el usuario que creó el post
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
