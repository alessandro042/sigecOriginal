<?php

namespace App\Http\Controllers;

use App\Models\CorteCaja;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorteCajaController extends Controller
{
    
    public function index()
    {
        // Calcular el total acumulado de ventas actuales
        $totalVentas = Venta::sum('total');
    
        // Obtener los cortes previos realizados
        $cortes = CorteCaja::orderBy('fecha_corte', 'desc')->get();
    
        // Verificar si no hay cortes previos
        $existeCorte = !$cortes->isEmpty();
    
        return view('corte_caja.index', compact('totalVentas', 'cortes', 'existeCorte'));
    }
    
    /**
     * Realizar un nuevo corte de caja.
     */
    public function store(Request $request)
    {
        DB::transaction(function () {
            // Calcular el total acumulado de las ventas
            $totalVentas = Venta::sum('total');
    
            // Verificar si ya existe un corte de caja para la fecha actual
            $corteExistente = CorteCaja::where('fecha_corte', now()->toDateString())->exists();
    
            if ($corteExistente) {
                throw new \Exception('Ya existe un corte de caja para la fecha actual.');
            }
    
            // Crear un nuevo corte de caja
            CorteCaja::create([
                'id_usuario' => auth()->user()->id,
                'total_ingresos' => $totalVentas,
                'total_egresos' => 0,
                'fecha_corte' => now(),
            ]);
    
            // Reiniciar las ventas después del corte
            DB::table('venta_producto')->delete();
            DB::table('ventas')->delete();
        });
    
        return redirect()->route('corte_caja.index')->with('success', 'Corte de caja realizado exitosamente.');
    }

   

}
