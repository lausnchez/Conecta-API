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
        'activo'
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
    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'date',
        'es_empresa' => 'boolean',
        'es_familiar' => 'boolean',
        'porcentaje_discapacidad' => 'decimal:2',
        'password' => 'hashed',
        'activo' => 'boolean',
    ];

    // RELACIONES
    //-------------------------------------------------------
    public function rol(){
        return $this->belongsTo(Roles::class);
    }

    public function eventos(){
        return $this->hasMany(Eventos::class);
    }

    // MÉTODOS PROPIOS
    //-------------------------------------------------------

    /**
     * Devuelve el nombre completo del usuario concatenando nombre y apellidos.
     */
    public function nombre_completo(): string{
        return "{$this->nombre} {$this->apellido}";
    }

    /**
     * Comprueba si el usuario es una empresa
     */
    public function es_empresa():bool{
        return $this->es_empresa;
    }

    /**
     * Comprueba si el usuario es un familiar
     */
    public function es_familiar():bool{
        return $this->es_familiar;
    }

    /**
     * Devuelve la edad del usuario (usa el método age de Carbon)
     */
    public function edad(): ?int
    {
        return $this->fecha_nacimiento ? $this->fecha_nacimiento->age : null;
    }

    /**
     * Comprueba si es un admin de la aplicación
     */
    public function esAdmin(): bool{
        return $this->rol === 1;
    }

    /**
     * Comprueba si es un usuario común de la aplicación
     */
    public function esDeveloper(): bool{
        return $this->rol === 2;
    }

    /**
     * Comprueba si es un usuario común de la aplicación
     */
    public function esUsuario(): bool{
        return $this->rol === 3;
    }

    /**
     * Comprueba si el usuario está activo en la base de datos
     */
    public function esActivo(): bool{
        return $this->activo;
    }

    // SCOPES
    //-------------------------------------------------------

    public function buscar_empresas(){

    }
    
}
