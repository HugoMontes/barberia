<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model {

    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellido', 'telefono', 'user_id'];
    public $timestamps = true;

    // Relación con el usuario
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
