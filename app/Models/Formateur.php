<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;

    protected $table = 'formateur';
    protected $fillable = [
        'name',
        'specialite'
    ];

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class);
    }

    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }
    
}
