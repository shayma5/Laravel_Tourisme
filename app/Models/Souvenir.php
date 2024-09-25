<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prix', 'description', 'promotion', 'nbr_restant', 'image'];


    public function magasin()
{
    return $this->belongsTo(Magasin::class);
}

}
