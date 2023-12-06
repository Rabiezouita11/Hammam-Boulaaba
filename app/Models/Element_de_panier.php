<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element_de_panier extends Model
{
    use HasFactory;
    public function panier() {
        return $this->belongsTo(Panier::class);
    }

   
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
