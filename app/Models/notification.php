<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_id',
        'data_to_broadcast',
    ];

    // Define the relationship to the Reservation model
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    

}
