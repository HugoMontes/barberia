<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
use HasFactory;

    protected $table = 'detalle_factura';

    protected $fillable = [
        'precio',
        'id_reserva',
        'id_servicio',
        'id_factura',
    ];

    // Relación con Reserva
    // Una reserva puede tener muchos detalles (1:N)
    // Un detalle pertenece a una reserva (N:1)
    public function reserva() {
        return $this->belongsTo(Reserva::class, 'id_reserva');
    }

    // Relación con Servicio
    // Un servicio puede estar en muchos detalles (1:N)
    // Un detalle pertenece a un servicio (N:1)
    public function servicio() {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    // Relación con Factura
    // Una factura puede tener muchos detalles (1:N)
    // Un detalle pertenece a una factura (N:1)
    public function factura() {
        return $this->belongsTo(Factura::class, 'id_factura');
    }
}