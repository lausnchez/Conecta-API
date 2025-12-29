<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'es_empresa',
        'es_familiar',
        'fecha_nacimiento',
        'porcentaje_discapacidad',
        'rol',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'fecha_nacimiento' => 'date',
            'es_empresa' => 'boolean',
            'es_familiar' => 'boolean',
            'porcentaje_discapacidad' => 'decimal:2',
            'password' => 'hashed',
        ];
    }

    // RELACIONES
    //-------------------------------------------------------
    public function rol(){
        return $this->belongsTo(Roles::class);
    }

    public function event(){
        return $this->hasMany(Eventos::class);
    }

}
