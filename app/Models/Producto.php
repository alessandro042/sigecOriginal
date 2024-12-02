<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'id_proveedor',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'venta_producto', 'id_producto', 'id_venta')
                    ->withPivot('cantidad', 'precio_unitario');
    }
}
