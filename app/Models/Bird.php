<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bird extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_commun',
        'nom_scientifique',
        'taille_min_cm',
        'taille_max_cm',
        'poids_min_g',
        'poids_max_g',
        'couleur',
        'habitat',
    ];
}
