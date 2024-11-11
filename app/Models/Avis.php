<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Avis extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomClient',
        'note',
        'commentaire',
        'dateAvis',
        'restaurant_id', // clé étrangère pour la relation avec Restaurant
    ];

     // Relation avec Restaurant
     public function restaurant()
     {
         return $this->belongsTo(Restaurant::class);
     }
}
