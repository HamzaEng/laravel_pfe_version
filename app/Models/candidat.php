<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidat extends Model
{ 
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'tel',
        'cin',
        'cne',
        'dateNs',
        'lieuNs',
        'niveauBac',
        'bacMoyen',
        'lycee',
        'email',
        'filiere',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'    
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
}
