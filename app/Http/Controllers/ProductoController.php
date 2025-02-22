<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    
    public function index()
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all(); // Para obtener la lista de proveedores
        return view('productos.index', compact('productos', 'proveedores'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric',
            'costo' => 'required|numeric',
            'codigo' => 'required|string|max:255',
            'stock' => 'required|integer',
            'id_proveedor' => 'required|exists:proveedores,id',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto agregado exitosamente.');
    }

    
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'id_proveedor' => 'required|exists:proveedores,id',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

   
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}

