<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
      use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'fecha_hora',
        'estado',
        'id_cliente',
        'id_barbero',
    ];

    // Relación: una reserva pertenece a un cliente
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    // Relación: una reserva pertenece a un barbero
    public function barbero() {
        return $this->belongsTo(Barbero::class, 'id_barbero');
        
    }
}
