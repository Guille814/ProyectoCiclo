<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialLink extends Model
{
    protected $fillable = ['user_id', 'social_network', 'url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
