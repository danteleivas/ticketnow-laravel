<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'artista',
        'imagen',
        'disponibilidad_campo',
        'disponibilidad_vip',
        'disponibilidad_platea',
        'precio',
        'place_id',
        'fecha',
        'hora',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function showUsers()
    {
        return $this->hasMany(Show_User::class);
    }
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    protected $attributes = [

        'fecha' => '0',
        'hora' => '0',

    ];
}
