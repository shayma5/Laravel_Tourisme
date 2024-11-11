<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampagnePromotionnelle extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'budget', 'date_debut', 'date_fin'];

    
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

}


