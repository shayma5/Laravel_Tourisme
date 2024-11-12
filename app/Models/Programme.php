<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $table = 'programme';
    protected $fillable = [
        'name',
        'objectif',
        'contenu'
    ];

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_programme');
    }
    
  public function classes(){
    return $this->hasMany(Classe::class);
  }
}
