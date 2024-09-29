<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'location','type'];

    // Relation : Un événement peut avoir plusieurs activités
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    use HasFactory;
}
