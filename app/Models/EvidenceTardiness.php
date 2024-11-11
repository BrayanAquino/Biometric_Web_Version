<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvidenceTardiness extends Model
{
    use HasFactory;

    protected $fillable = [
        'evidence_tardiness',
        'tardiness_id',
    ];

    // Relación con el modelo Tardiness
    public function tardiness()
    {
        return $this->belongsTo(Tardiness::class);
    }
}
