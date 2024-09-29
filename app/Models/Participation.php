<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $fillable = ['participant_id', 'event_id', 'activity_id'];

    // Relation : Une inscription appartient à un participant
    public function participant()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Une inscription peut être liée à un événement
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relation : Une inscription peut être liée à une activité
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    use HasFactory;
}
