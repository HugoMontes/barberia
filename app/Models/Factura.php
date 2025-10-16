<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model {
    use HasFactory;

    protected $table = 'facturas';

    protected $fillable = [
        'fecha_emision',
        'nombre_comprador',
        'nit_comprador',
        'descripcion',
        'total',
        'estado',
        // 'id_cliente',
        'reserva_id'
    ];

    // Relación con Cliente
    // public function cliente() {
    //     return $this->belongsTo(Cliente::class, 'id_cliente');
    // }

    public function detalleFacturas(): HasMany {
        return $this->hasMany(DetalleFactura::class, 'factura_id', 'id');
    }
}
