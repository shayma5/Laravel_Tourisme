<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'formateur_id',
        'classe_id',
        'programme_id',
        'user_id',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class); // Relation avec User
    }
}
