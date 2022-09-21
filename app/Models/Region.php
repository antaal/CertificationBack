<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['nom_Region'];

    public function departements()
    {
        return $this->hasMany(Departement::class);
    }
}
