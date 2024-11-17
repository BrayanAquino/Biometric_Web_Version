<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'cellphone',
        'dni',
        'hiring_date',
        'qr_info',
        'state',
        'rol_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con el rol del usuario.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'rol_id');
    }

    /**
     * Relación con las asistencias (attendances).
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Relación con las ausencias (absences).
     */
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    /**
     * Relación con los retrasos (tardinesses).
     */
    public function tardinesses()
    {
        return $this->hasMany(Tardiness::class);
    }

    /**
     * Relación con los permisos (permissions).
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * Relación con los horarios (schedule).
     */
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Relación con los mensajes (messages).
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Relación con los días no laborables (non_working_days).
     */
    public function nonWorkingDays()
    {
        return $this->hasMany(NonWorkingDay::class);
    }
}
