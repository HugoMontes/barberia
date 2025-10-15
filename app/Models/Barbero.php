<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barbero extends Model {
    use HasFactory;
    protected $table = 'barberos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'apellido',
        'especialidad',
        'user_id',
    ];
    public $timestamps = true;

    // Relación con el usuario
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
