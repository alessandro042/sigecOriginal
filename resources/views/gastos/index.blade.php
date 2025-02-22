@extends('layouts.app')

@section('title', 'Gastos de Productos')

@section('content')
<div class="container my-5">
    <h1 class="h2 fw-bold text-primary">Gastos de Productos</h1>
    <p class="text-muted">Aquí puedes ver los gastos totales de los productos según su costo y stock.</p>

    <div class="row mt-4">
        <!-- Cuadro de Total Gastos -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-money-bill-wave fa-4x text-warning mb-3"></i>
                    <h5 class="card-title fw-bold">{{ __('Total Gastos (considerando productos vendidos)') }}</h5>
                    <h2 class="fw-bold text-danger">${{ number_format($totalGastos, 2) }}</h2>
                </div>
            </div>
        </div>

        <!-- Cuadro de Total Ventas -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-4x text-success mb-3"></i>
                    <h5 class="card-title fw-bold">{{ __('Total Ventas (con ganancia)') }}</h5>
                    <h2 class="fw-bold text-success">${{ number_format($totalVentas, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de productos -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Costo Unitario</th>
                <th>Stock</th>
                <th>Total Gastos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>${{ number_format($producto->costo, 2) }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>${{ number_format($producto->costo * $producto->stock, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Agrega estilos personalizados -->
<style>
    .card {
        transition: transform 0.3s;
        border-radius: 10px; /* Bordes redondeados */
    }

    .card:hover {
        transform: scale(1.05); /* Efecto de ampliación */
    }

    h2 {
        font-size: 2rem; /* Aumentar el tamaño de fuente */
    }

    .fa-money-bill-wave, .fa-chart-line {
        color: #f39c12; /* Color del icono */
    }

    .fa-chart-line {
        color: #28a745; /* Color del icono de ventas */
    }
</style>
@endsection
