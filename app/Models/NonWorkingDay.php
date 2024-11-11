<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NonWorkingDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'calendar_id',
    ];

    /**
     * Relación con el modelo Calendar.
     */
    public function calendar()
    {
        return $this->belongsTo(Calendar::class, 'calendar_id');
    }
}
