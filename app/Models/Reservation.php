<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'panier_id  ',
        'user_id',
        'etat_confirmation',
        'etat_paiement',
        'start',
        'end',
        'type_reservation'
     


    ];
    public function panier()
    {
        return $this->hasOne(Panier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' is the foreign key in the reservations table
    }
    public function elementDePanier() {
        return $this->hasMany(Element_de_panier::class);
    }
}
