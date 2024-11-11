<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'date_debut', 'date_fin', 'campagne_promotionnelle_id'];

    public function campagnePromotionnelle()
    {
        return $this->belongsTo(CampagnePromotionnelle::class);
    }

    public function magasins()
    {
        return $this->belongsToMany(Magasin::class);
    }
}
