<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;

    protected $fillable = ['nom_Secteur'];

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }
}
