<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model {
    use HasFactory;
    protected $table = 'detalle_factura';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'subtotal',
        'factura_id',
        'servicio_id',
    ];

    // Relación con Servicio
    // Un servicio puede estar en muchos detalles (1:N)
    // Un detalle pertenece a un servicio (N:1)
    public function servicio() {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    // Relación con Factura
    // Una factura puede tener muchos detalles (1:N)
    // Un detalle pertenece a una factura (N:1)
    public function factura() {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
