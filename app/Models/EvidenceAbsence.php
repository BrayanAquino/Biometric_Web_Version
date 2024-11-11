<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvidenceAbsence extends Model
{
    use HasFactory;

    protected $fillable = [
        'evidence_absence',
        'absence_id',
    ];

    // Relación con el modelo Absence
    public function absence()
    {
        return $this->belongsTo(Absence::class);
    }
}
