<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatAdmin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
