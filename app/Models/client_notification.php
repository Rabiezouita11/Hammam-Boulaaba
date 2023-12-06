<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class client_notification extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'message',
        'read',
     


    ];

    protected $table = 'client_notifications'; // Specify the table name

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
