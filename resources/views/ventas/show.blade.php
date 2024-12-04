@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de la Venta #{{ $venta->id }}</h1>

    <p><strong>Usuario:</strong> {{ $venta->usuario->nombre_completo }}</p>
    <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
    <p><strong>Fecha de Venta:</strong> {{ $venta->fecha_venta }}</p>

    <h3>Productos Vendidos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->pivot->cantidad }}</td>
                    <td>${{ number_format($producto->pivot->precio_unitario, 2) }}</td>
                    <td>${{ number_format($producto->pivot->cantidad * $producto->pivot->precio_unitario, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver al Listado de Ventas</a>
</div>
@endsection
