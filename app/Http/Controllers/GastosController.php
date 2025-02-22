<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;

class GastosController extends Controller
{

    public function index()
    {
       
        $productos = Producto::all();

    
        $totalGastos = $productos->sum(function ($producto) {
            return $producto->costo * $producto->stock;
        });

    
        $totalVentas = Venta::sum('total');

        
        return view('gastos.index', compact('productos', 'totalGastos', 'totalVentas'));
    }
}
