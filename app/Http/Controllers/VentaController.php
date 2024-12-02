<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\CorteCaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{

    public function create()
    {
        $productos = Producto::where('stock', '>', 0)->get(); // Solo productos en stock
        return view('ventas.create', compact('productos'));
    }


    public function show(Venta $venta)
{
    $venta->load('productos', 'usuario'); 
    return view('ventas.show', compact('venta'));
    
}


    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $venta = Venta::create([
                'id_usuario' => $request->id_usuario,
                'total' => 0, 
                'fecha_venta' => now(),
            ]);

            $total = 0;

            foreach ($request->productos as $producto) {
                $productoModel = Producto::find($producto['id']);
                if ($productoModel->stock < $producto['cantidad']) {
                    return redirect()->back()->withErrors(['productos' => 'Stock insuficiente para el producto: ' . $productoModel->nombre]);
                }

                $subtotal = $productoModel->precio * $producto['cantidad'];
                $total += $subtotal;

                $venta->productos()->attach($producto['id'], [
                    'cantidad' => $producto['cantidad'],
                    'precio_unitario' => $productoModel->precio,
                ]);
                $productoModel->decrement('stock', $producto['cantidad']);
            }
            $venta->update(['total' => $total]);

            $corteCaja = CorteCaja::firstOrCreate(
                ['id_usuario' => $request->id_usuario, 'fecha_corte' => now()->toDateString()],
                ['total_ingresos' => 0, 'total_egresos' => 0]
            );
            $corteCaja->increment('total_ingresos', $total);
        });

        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
    }

    public function index()
    {
    $ventas = Venta::with('productos', 'usuario')->get();
    $productos = Producto::where('stock', '>', 0)->get(); 
    return view('ventas.index', compact('ventas', 'productos'));
    }


    public function edit(Venta $venta)
    {
        $productos = Producto::where('stock', '>', 0)->get(); 
        $venta->load('productos'); 
        return view('ventas.edit', compact('venta', 'productos'));
    }

   
    public function update(Request $request, Venta $venta)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $venta) {
            foreach ($venta->productos as $producto) {
                $productoModel = Producto::find($producto->id);
                $productoModel->increment('stock', $producto->pivot->cantidad);
            }

            $venta->productos()->detach();

            $total = 0;

            foreach ($request->productos as $producto) {
                $productoModel = Producto::find($producto['id']);

                if ($productoModel->stock < $producto['cantidad']) {
                    return redirect()->back()->withErrors(['productos' => 'Stock insuficiente para el producto: ' . $productoModel->nombre]);
                }

                $subtotal = $productoModel->precio * $producto['cantidad'];
                $total += $subtotal;


                $venta->productos()->attach($producto['id'], [
                    'cantidad' => $producto['cantidad'],
                    'precio_unitario' => $productoModel->precio,
                ]);

                $productoModel->decrement('stock', $producto['cantidad']);
            }

            $venta->update(['total' => $total]);
            $corteCaja = CorteCaja::firstOrCreate(
                ['id_usuario' => $request->id_usuario, 'fecha_corte' => now()->toDateString()],
                ['total_ingresos' => 0, 'total_egresos' => 0]
            );
            $corteCaja->increment('total_ingresos', $total);
        });

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
    }

    public function destroy(Venta $venta)
    {
        DB::transaction(function () use ($venta) {
            foreach ($venta->productos as $producto) {
                $productoModel = Producto::find($producto->id);
                $productoModel->increment('stock', $producto->pivot->cantidad);
            }
    
            $corteCaja = CorteCaja::where('id_usuario', $venta->id_usuario)
                ->where('fecha_corte', now()->toDateString())
                ->first();
    
            if ($corteCaja) {
                $corteCaja->decrement('total_ingresos', $venta->total);
            }

            $venta->productos()->detach();
            $venta->delete();
        });
    
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }

}
