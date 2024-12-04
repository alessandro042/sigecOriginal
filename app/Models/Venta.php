<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario',
        'total',
        'fecha_venta',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($venta) {
            $corteCaja = CorteCaja::firstOrCreate(
                [
                    'id_usuario' => $venta->id_usuario,
                    'fecha_corte' => now()->toDateString(),
                ],
                [
                    'total_ingresos' => 0,
                    'total_egresos' => 0,
                ]
            );

            $corteCaja->increment('total_ingresos', $venta->total);
        });
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'venta_producto', 'id_venta', 'id_producto')
                    ->withPivot('cantidad', 'precio_unitario');
    }
}
