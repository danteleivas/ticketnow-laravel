<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'capacidad_campo',
        'capacidad_vip',
        'capacidad_platea',
        'direccion',      
    ];

    
}
