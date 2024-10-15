<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'photo', 'start_date', 'end_date', 'location','type', 'price', 'nbParticipant'];
    protected $table = 'events';
    
    

    public function participations()
{
    return $this->hasMany(Participation::class, 'event_id');
}


}
