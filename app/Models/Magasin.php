<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    use HasFactory;

    protected $fillable = ['nomMagasin', 'type', 'adresse', 'description', 'image'];

    public function promotions()
{
    return $this->belongsToMany(Promotion::class);
}

public function souvenirs()
{
    return $this->hasMany(Souvenir::class); //le magasin a plusieurs 
}


}
