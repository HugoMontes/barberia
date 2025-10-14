<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicio extends Model {
    use HasFactory;
    protected $table = 'servicios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
    ];

    public function detalleFacturas(): HasMany {
        return $this->hasMany(DetalleFactura::class, 'servicio_id', 'id');
    }

    public function reservas(): BelongsToMany {
        return $this->belongsToMany(
            Reserva::class,
            'reserva_servicios',
            'servicio_id',
            'reserva_id'
        )->withTimestamps();
    }
}
