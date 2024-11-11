<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacations extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'duration_vacation',
        'user_id',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
