<?php

namespace App\Http\Controllers;

use App\Models\Bird;
use Illuminate\Http\Request;

class BirdController extends Controller
{
    public function index(Request $request)
    {
        // Exercice b) : Afficher tous les oiseaux
        $allBirds = Bird::all();

        // Exercice c) : Afficher les oiseaux avec une taille minimale de 12 cm
        $exerciceC = Bird::where('taille_min_cm', '=', 12)->get();

        // Exercice d) : Afficher les oiseaux avec une taille minimale de 12 cm vivant dans les forêts et jardin
        $exerciceD = Bird::where('taille_min_cm', '=', 12)->where('habitat', '=', 'Forêts, jardins')->get();

        // exercice e) : Afficher tous les oiseaux dont les noms communs commencent par m. 
        $exerciceE = Bird::where('nom_commun', 'like', 'm%')->get();

        // exercice f) : Afficher tous les oiseaux dont les noms communs ou scientifiques commencent par m. 
        $exerciceF = Bird::where('nom_commun', 'like', 'm%')->orWhere('nom_scientifique', 'like', 'm%')->get();

        // exercice g) : Afficher tous les oiseaux vivants dans les jardins. 
        $exerciceG = Bird::where('habitat', 'like', '%jardins%')->get();

        // exercice h) : Afficher tous les oiseaux dont le poids est de 15g. 
        $exerciceH = Bird::where('poids_min_g', '=', 15)->orWhere('poids_max_g', '=', 15)->get();

        // exercice i) : Afficher tous les oiseaux de teinte brune, de poids 15g et taille min 12cm et dont le nom commence par m. 
        $exerciceI = Bird::where('couleur', 'like', '%brun%')->where('poids_min_g', '=', 15)->orWhere('poids_max_g', '=', 15)->where('taille_min_cm', '=', 12)->where('nom_commun', 'like', 'm%')->get();

        // exercice j) : Afficher tous les oiseaux par ordre alphabétique de nom commun. 
        $exerciceJ = Bird::orderBy('nom_commun')->get();

        // Retourner une réponse structurée avec des indications pour chaque exercice
        return response()->json([
            'exercice_b' => [
                'indication' => 'Tous les oiseaux :',
                'birds' => $allBirds
            ],
            'exercice_c' => [
                'indication' => 'Oiseaux avec une taille minimale de 12 cm :',
                'birds' => $exerciceC
            ],
            'exercice_d' => [
                'indication' => 'Oiseaux avec une taille minimale de 12 cm vivant dans les forêts et jardin :',
                'birds' => $exerciceD
            ],
            'exercice_e' => [
                'indication' => 'Oiseaux dont les noms communs ou scientifiques commencent par m',
                'birds' => $exerciceE
            ],
            'exercice_f' => [
                'indication' => 'Oiseaux dont les noms communs ou scientifiques commencent par m',
                'birds' => $exerciceF
            ],
            'exercice_g' => [
                'indication' => 'Oiseaux vivants dans les jardins',
                'birds' => $exerciceG
            ],
            'exercice_h' => [
                'indication' => 'Oiseaux dont le poids est de 15g',
                'birds' => $exerciceH
            ],
            'exercice_i' => [
                'indication' => 'Oiseaux de teinte brune, de poids 15g et taille min 12cm et dont le nom commence par m',
                'birds' => $exerciceI
            ],
            'exercice_j' => [
                'indication' => 'Oiseaux par ordre alphabétique de nom commun',
                'birds' => $exerciceJ
            ],
        ]);
    }
}