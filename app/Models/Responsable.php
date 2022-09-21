<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    protected $casts = [
        'date_Naissance'=>'datetime:Y-m-d',
    ];

    protected $guarded = ["id"];
    public function projets()
    {
        return $this->hasOne(Projet::class);
    }
    public function quartiers()
    {
        return $this->belongsTo(Quartier::class);
    }
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
