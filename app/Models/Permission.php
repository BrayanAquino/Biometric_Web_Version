<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'reason_permission',
        'status_permission',
        'user_id',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo EvidencePermission
    public function evidences()
    {
        return $this->hasMany(EvidencePermission::class);
    }
}
