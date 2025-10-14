<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reserva extends Model {
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'fecha_hora',
        'estado',
        'cliente_id',
        'barbero_id',
    ];

    // Relación: una reserva pertenece a un cliente
    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relación: una reserva pertenece a un barbero
    public function barbero(): BelongsTo {
        return $this->belongsTo(Barbero::class, 'barbero_id');
    }

    // Relacion: una reserva puede tener varios servicios
    public function servicios(): BelongsToMany {
        return $this->belongsToMany(
            Servicio::class,
            'reserva_servicios',
            'reserva_id',
            'servicio_id'
        )->withTimestamps();
    }
}
