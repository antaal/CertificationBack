<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = ['nom_Commune'];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function quartiers()
    {
        return $this->hasMany(Quartier::class);
    }
}
