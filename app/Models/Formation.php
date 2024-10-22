<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'formation';
    protected $fillable = [
        'name',
        'description',
        'date_debut',
        'date_fin',
        'specialite',
        'formateur_id'
    ];

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }
    public function programmes()
    {
        return $this->belongsToMany(Programme::class, 'formation_programme');
    }

    public function countUsersReserved()
    {
        return $this->reservations()->distinct('user_id')->count('user_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
