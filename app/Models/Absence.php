<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_absence',
        'status_absence',
        'reason_absence',
        'user_id',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo EvidenceAbsence
    public function evidences()
    {
        return $this->hasMany(EvidenceAbsence::class);
    }
}
