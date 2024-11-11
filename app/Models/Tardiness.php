<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tardiness extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_tardiness',
        'entry_time',
        'status_tardiness',
        'reason_tardiness',
        'user_id',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo EvidenceTardiness
    public function evidences()
    {
        return $this->hasMany(EvidenceTardiness::class);
    }
}
