<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $table = 'classe';
    protected $fillable = [
        'name',
        'specialite',
        'localisation',
        'programme_id'
    ];

    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class);
    }
    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }
}
