<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title', 'description', 'start_time', 'end_time', 'location', 'type','event_id'];

    // Relation : Une activité peut être liée à un événement ou non
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    use HasFactory;
}
