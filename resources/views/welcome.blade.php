@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container my-5">
    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="h2 fw-bold" style="color: #012553;">Dashboard Principal</h1>
            <p class="text-muted">{{ __('Accede rápidamente a las funciones principales del sistema') }}</p>
        </div>
    </div>

    <!-- Botón destacado para nueva venta -->
    <div class="row mb-5">
        <div class="col text-center">
            <a href="{{ route('ventas.create') }}" class="btn btn-lg text-white shadow" 
               style="background-color: #e63946; padding: 15px 30px; font-size: 1.25rem; font-weight: bold; border-radius: 8px;">
                <i class="fas fa-plus-circle"></i> {{ __('Hacer Nueva Venta') }}
            </a>
        </div>
        <div >
    </div>

    </div>
    <div class="col text-center">
            <a href="{{ route('ventas.create') }}" class="btn btn-lg text-white shadow" 
               style="background-color: #e63946; padding: 15px 30px; font-size: 1.25rem; font-weight: bold; border-radius: 8px;">
                <i class="fas fa-plus-circle"></i> {{ __('Hacer Nueva Venta') }}
            </a>
        </div>

    <!-- Tarjetas principales -->
    <div class="row">
        <!-- Tarjeta de Proveedores -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-truck fa-3x text-primary mb-3"></i>
                    <h5 class="card-title fw-bold">{{ __('Proveedores') }}</h5>
                    <p class="card-text text-muted">{{ __('Gestión de proveedores para mantener relaciones eficientes con tus socios comerciales.') }}</p>
                    <a id="btn-proveedores" href="{{ route('proveedores.index') }}" class="btn btn-primary mt-3" style="background-color: #012553;">
                        <i class="fas fa-truck"></i> {{ __('Ir a Proveedores') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Productos -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-boxes fa-3x text-success mb-3"></i>
                    <h5 class="card-title fw-bold">{{ __('Productos') }}</h5>
                    <p class="card-text text-muted">{{ __('Controla tu inventario y asegúrate de tener siempre el stock adecuado para tu negocio.') }}</p>
                    <a href="{{ route('productos.index') }}" class="btn btn-success mt-3">
                        <i class="fas fa-boxes"></i> {{ __('Ir a Productos') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Ventas -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-3x text-danger mb-3"></i>
                    <h5 class="card-title fw-bold">{{ __('Ventas') }}</h5>
                    <p class="card-text text-muted">{{ __('Monitorea tus ventas y genera reportes para optimizar el desempeño de tu negocio.') }}</p>
                    <a href="{{ route('ventas.index') }}" class="btn btn-danger mt-3">
                        <i class="fas fa-chart-line"></i> {{ __('Ir a Ventas') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de métricas -->
    <div class="row mt-5">
        <div class="col">
            <h4 class="fw-bold" style="color: #012553;">{{ __('Estadísticas Rápidas') }}</h4>
        </div>
    </div>
    <div class="row mt-3">
        <!-- Total de Proveedores -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body text-center">
                    <h2 class="fw-bold">2</h2>
                    <p class="mb-0">{{ __('Proveedores Registrados') }}</p>
                </div>
            </div>
        </div>

        <!-- Total de Productos -->
        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body text-center">
                    <h2 class="fw-bold">30</h2>
                    <p class="mb-0">{{ __('Productos en Inventario') }}</p>
                </div>
            </div>
        </div>

        <!-- Total de Ventas -->
        <div class="col-md-4">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body text-center">
                    <h2 class="fw-bold">$30,000</h2>
                    <p class="mb-0">{{ __('Total en Ventas') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnProveedores = document.getElementById('');

        btnProveedores.addEventListener('click', function (e) {
            e.preventDefault(); 
            const userRole = "{{ Auth::check() ? Auth::user()->role : 'guest' }}";

            if (userRole !== 'Administrador') {
                Swal.fire({
                    icon: 'error',
                    title: 'Acceso Denegado',
                    text: 'No cuentas con los permisos suficientes para acceder a esta sección.',
                });
            } else {
                window.location.href = this.href;
            }
        });
    });
</script>
