<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    // Los atributos que son asignables masivamente
    protected $fillable = [
        'title_message',
        'body_message',
        'create_date',
        'calendar_id',
        'user_id',
    ];

    /**
     * Relación con el modelo Calendar.
     */
    public function calendar()
    {
        return $this->belongsTo(Calendar::class, 'calendar_id');
    }

    /**
     * Relación con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
