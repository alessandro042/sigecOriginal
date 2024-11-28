<!-- resources/views/principales/matricula.blade.php -->
@extends('layouts.app')

@section('title', 'Unidades académicas')

@section('content')
<div class="container mt-2">
    <div class="card p-3">
        <h1 class="mb-4 text-center text-3xl font-bold text-blue-600">Gestión de Unidades Académicas</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('unidad-academica.create') }}" class="btn btn-primary">Nueva unidad académica</a>
        </div>
        <div class="table-responsive">
            <table id="unidadesTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Unidad Académica</th>
                        <th>Institución</th>
                        <th>Nivel Académico</th>
                        <th>Municipio</th>
                        <th>Clave</th>
                        <th>Siglas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unidades_academicas as $unidad_academica)
                    <tr>
                        <td>{{ $unidad_academica->unidad_academica }}</td>
                        <td>{{ $unidad_academica->institucion->institucion ?? 'N/A' }}</td>
                        <td>{{ $unidad_academica->nivel->nivel ?? 'N/A' }}</td>
                        <td>{{ $unidad_academica->municipio->municipio ?? 'N/A' }}</td>
                        <td>{{ $unidad_academica->clave ?? 'N/A' }}</td>
                        <td>{{ $unidad_academica->siglas ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('unidad-academica.edit', $unidad_academica) }}" class="btn btn-warning me-2">Editar</a>
                            {{-- <form action="{{ route('unidad-academica.destroy', $matricula->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#unidadesTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });
    });
</script>
@endsection
