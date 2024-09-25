<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    // Définir les colonnes qui peuvent être massivement assignées
    protected $fillable = [
        'nom',
        'adresse',
        'siteWeb',
        'telephone',
        'description',
        'noteMoyenne',
    ];


     // Relation avec Plat
     public function plats()
     {
         return $this->hasMany(Plat::class);
     }
 
     // Relation avec Avis
     public function avis()
     {
         return $this->hasMany(Avis::class);
     }
}
