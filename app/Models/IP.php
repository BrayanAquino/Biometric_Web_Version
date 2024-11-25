<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IP extends Model
{
    use HasFactory;

    protected $table = 'i_p_s'; 
    protected $fillable = [
        'ip_address',
    ];
}

