<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_producto',
        'correo_cliente',
        'activo',
        'status',
        'fh_estimada',
        'fh_fin',
        'UUID',
        'id_usuario',
        'precio',
        'comentario',
    ];
    protected $table = 'reparacion';
}
