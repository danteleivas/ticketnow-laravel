<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show_User extends Model
{
    use HasFactory;
    protected $table = 'show_user';
    protected $fillable = [
       
        'user_id',
        'show_id',
        'codigo_qr',
        'payment_id'
        
    ];

    public function show()
    {
        return $this->belongsTo(Show::class);
    }
}
