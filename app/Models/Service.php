<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'Designations',
        'prix',
        'categories',
        'image',
        'Description',
        'capacite',
        'dure',
        'methode_tarification', // Add the new attribute
        'minutes',
        'pause',
        'promotion'





    ];
}
