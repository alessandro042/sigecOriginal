@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Corte de Caja</h1>

    <!-- Mostrar el total de ventas actuales -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Total de Ventas Acumuladas</h5>
            <p class="card-text"><strong>${{ number_format($totalVentas, 2) }}</strong></p>
            <form action="{{ route('corte_caja.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Realizar Corte de Caja</button>
            </form>
        </div>
    </div>

    @if($existeCorte)
        <!-- Mostrar los cortes realizados previamente -->
        <h3>Cortes Realizados</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Total Ingresos</th>
                    <th>Total Egresos</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cortes as $corte)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $corte->usuario->nombre_completo }}</td>
                        <td>${{ number_format($corte->total_ingresos, 2) }}</td>
                        <td>${{ number_format($corte->total_egresos, 2) }}</td>
                        <td>{{ $corte->fecha_corte }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <!-- Mensaje si no hay cortes realizados -->
        <div class="alert alert-info" role="alert">
            No se han realizado cortes de caja hasta el momento. Realiza un corte para comenzar.
        </div>
    @endif
</div>
@endsection
