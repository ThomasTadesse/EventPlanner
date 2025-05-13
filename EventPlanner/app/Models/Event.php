<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_participants');
    }
    public function isParticipant($userId)
    {
        return $this->participants()->where('user_id', $userId)->exists();
    }
}
