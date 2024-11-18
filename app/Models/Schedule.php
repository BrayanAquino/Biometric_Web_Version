<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_time',
        'end_time',
        'shift',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); // Especificar 'id_user' como clave foránea
    }
}
