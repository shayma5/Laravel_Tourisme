<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $fillable = ['participant_id', 'event_id', 'reserved_places','is_paid'];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function participant()
    {
        return $this->belongsTo(User::class, 'participant_id');
    }


    
    use HasFactory;
}
