<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomPlat',
        'type',
        'prix',
        'description',
        'imageUrl',
        'restaurant_id', // clé étrangère pour la relation avec Restaurant
    ];

      // Relation avec Restaurant
      public function restaurant()
      {
          return $this->belongsTo(Restaurant::class);
      }
}
