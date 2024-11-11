<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaisonDhaute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'description', 'number_of_rooms', 'image'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
