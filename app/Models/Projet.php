<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
   
   
    public function responsable()
    {
        return $this->belongsTo(Responsable::class);
    }
    
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }
}
