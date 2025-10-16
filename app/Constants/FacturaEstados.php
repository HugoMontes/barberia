<?php

namespace App\Constants;

class FacturaEstados {

    public const PENDIENTE = 'pendiente';
    public const PAGADA = 'pagada';
    public const ANULADA = 'anulada';

    public const ESTADOS = [
        'pendiente' => 'Pendiente',
        'pagada' => 'Pagada',
        'anulada' => 'Anulada'
    ];
}
