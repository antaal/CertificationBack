<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quartier extends Model
{
    use HasFactory;

    protected $fillable = ['nom_Quartier'];

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
    public function responsables()
    {
        return $this->hasMany(Responsable::class);
    }
}
