<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_id',
        'nombre_de_place',
        'montant_total',
        'nombre_de_placeAdults',
        'nombre_de_placeChildren'



    ];

    public function elementDePanier()
    {
        return $this->hasMany(Element_de_panier::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Element_de_panier::class);
    }
    
    public function elementsDePanier()
    {
        return $this->hasMany(Element_de_panier::class);
    }
}
