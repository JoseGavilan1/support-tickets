<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'estado',
        'prioridad'
    ];

    // Relación: Un ticket pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Un ticket tiene muchos mensajes
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }
}
