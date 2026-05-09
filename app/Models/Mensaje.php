<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = ['ticket_id', 'user_id', 'contenido', 'archivo_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
