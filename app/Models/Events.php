<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'photo', 'start_date', 'end_date', 'location','type'];
    protected $table = 'events';
    // Relation : Un événement peut avoir plusieurs activités
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    

}
