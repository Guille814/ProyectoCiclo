<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'event_date',
        'location',
        'image',
    ];

    protected $dates = [
        'event_date',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id');
    }

    public function getEventDateAttribute($value)
    {
        return Carbon::parse($value);
    }
}
