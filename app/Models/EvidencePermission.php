<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvidencePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'evidence_permission',
        'permission_id',
    ];

    // Relación con el modelo Permission
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
