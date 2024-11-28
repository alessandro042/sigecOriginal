<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id_rol',
        'nombre_completo',
        'username',
        'email',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $guarded = [];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    
    public function hasRol($rol)
    {
        return $this->rol()->where('rol', $rol)->exists();
    }

}
