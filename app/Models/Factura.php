<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
        use HasFactory;

    protected $table = 'facturas';

    protected $fillable = [
        'total',
        'descripcion',
        'precio',
        'id_cliente',
    ];

    // Relación con Cliente
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}

