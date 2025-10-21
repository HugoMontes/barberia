<?php

namespace App\Constants;

class ReservaEstados {

    public const ESTADOS = [
        'pendiente' => 'Pendiente',
        'confirmada' => 'Confirmada',
        'completada' => 'Completada',
        'facturada' => 'Facturada',
        'cancelada' => 'Cancelada'
    ];

    public const ESTADOS_PARA_BARBEROS = [
        'pendiente' => 'Pendiente',
        'confirmada' => 'Confirmada',
        'completada' => 'Completada',
    ];

    public const PENDIENTE = 'pendiente';
    public const CONFIRMADA = 'confirmada';
    public const COMPLETADA = 'completada';
    public const FACTURADA = 'facturada';
    public const CANCELADA = 'cancelada';
}
