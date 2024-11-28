@extends('layouts.app')

@section('title', 'Matrícula Igualdad REPORTE')

@section('content')
<div class="container mt-5">
<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Reporte de igualdad genero</h2>
        <div>
        <a href="{{ route('matricula.igualdad-genero.import-form') }}" class="btn btn-custom-upload btn-lg mx-2 my-2 shadow-sm">
                <i class="fas fa-file-upload"></i> Importar
            </a>
            <a href="{{ route('matricula.igualdad-genero.generate.excel') }}" class="btn btn-custom-download btn-lg mx-2 my-2 shadow-sm">
                <i class="fas fa-file-download"></i> Exportar
            </a> 
            <a href="{{ route('matricula.igualdad-genero.export-excel', ['id_fechas_corte' => $fechaCorteSeleccionada->id ?? null]) }}" class="btn btn-excel btn-lg mx-2 my-2 shadow-sm">
                <i class="fas fa-file-excel"></i> Exportar a Excel
            </a>
            <a href="{{ route('matricula.igualdad-genero.export-pdf', ['id_fechas_corte' => $fechaCorteSeleccionada->id ?? null]) }}" class="btn btn-pdf btn-lg mx-2 my-2 shadow-sm">
                <i class="fas fa-file-pdf"></i> Exportar a PDF
            </a>
        </div>
    </div>
    
    <!-- Formulario de búsqueda por fecha de corte -->
    <form action="{{ route('matricula.igualdad-genero.report') }}" method="GET" class="mb-4">
        <div class="form-group col-md-2">
            <label for="id_fechas_corte">Fecha de Corte:</label>
            <select name="id_fechas_corte" id="id_fechas_corte" class="form-control">
                <option value="" disabled>Selecciona una fecha de corte</option>
                @foreach ($fechasCorte as $fecha)
                <option value="{{ $fecha->id }}" {{ $fechaCorteSeleccionada && $fechaCorteSeleccionada->id == $fecha->id ? 'selected' : '' }}>
                    {{ $fecha->fecha }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Mostrar la fecha de corte seleccionada -->
    <p><strong>Datos de fecha de corte:
            @if ($fechaCorteSeleccionada)
            {{ $fechaCorteSeleccionada->fecha }}
            @else
            (Ninguna fecha seleccionada)
            @endif
        </strong></p>

    @php
    // Variables para almacenar las sumas totales
    $sumaTotalHombres = 0;
    $sumaTotalMujeres = 0;
    $sumaTotalOtros = 0;
    $sumaTotalTotal = 0;
    @endphp

    <!-- Totales por Institución -->
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">Totales por Institución</h3>
            <div class="table-responsive">
                <table id="table-totales" class="table table-bordered table-striped table-general">
                    <thead class="thead-dark">
                        <tr>
                            <th>Institución</th>
                            <th class="text-center">Hombres</th>
                            <th class="text-center">Mujeres</th>
                            <th class="text-center">Otros</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportData->groupBy('programaEducativo.unidadAcademica.institucion.institucion') as $institucion => $dataGroup)
                        @php
                        $totalHombres = $dataGroup->sum('hombres');
                        $totalMujeres = $dataGroup->sum('mujeres');
                        $totalOtros = $dataGroup->sum('otros');
                        $totalTotal = $totalHombres + $totalMujeres + $totalOtros;
                        // suma de todos los hombres
                        $sumaTotalHombres += $totalHombres;
                        // suma de todas las mujeres
                        $sumaTotalMujeres += $totalMujeres;
                        // suma de todos los otros
                        $sumaTotalOtros += $totalOtros;
                        // suma de todos los totales
                        $sumaTotalTotal += $totalTotal;
                        @endphp
                        <tr>
                            <td>{{ $institucion }}</td>
                            <td class="text-center">{{ $totalHombres }}</td>
                            <td class="text-center">{{ $totalMujeres }}</td>
                            <td class="text-center">{{ $totalOtros }}</td>
                            <td class="text-center">{{ $totalTotal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total General</th>
                            <th class="text-center">{{ $sumaTotalHombres }}</th>
                            <th class="text-center">{{ $sumaTotalMujeres }}</th>
                            <th class="text-center">{{ $sumaTotalOtros }}</th>
                            <th class="text-center">{{ $sumaTotalTotal }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Detalle por Institución y Programa Educativo -->
    @foreach ($reportData->groupBy('programaEducativo.unidadAcademica.institucion.institucion') as $institucion => $dataGroup)
    <div class="accordion mb-4" id="accordion{{ $loop->iteration }}">
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                    {{ $institucion }} ({{ $dataGroup->count() }} programas) - Ver detalles
                </button>
            </h2>
            <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#accordion{{ $loop->iteration }}">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table id="table-detalle-{{ $loop->iteration }}" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Unidad Académica</th>
                                    <th>Programa Educativo</th>
                                    <th class="text-center">Hombres</th>
                                    <th class="text-center">Mujeres</th>
                                    <th class="text-center">Otros</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataGroup as $data)
                                <tr>
                                    <td>{{ $data->programaEducativo->unidadAcademica->unidad_academica }}</td>
                                    <td>{{ $data->programaEducativo->programa_educativo }}</td>
                                    <td class="text-center">{{ $data->hombres }}</td>
                                    <td class="text-center">{{ $data->mujeres }}</td>
                                    <td class="text-center">{{ $data->otros }}</td>
                                    <td class="text-center">
                                        {{ $data->hombres + $data->mujeres + $data->otros }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
    .btn-custom-upload {
        background-color: #2196F3;
        color: white;
        border: none;
    }

    .btn-custom-upload:hover {
        background-color: #0b7dda;
        color: white;
    }

    .btn-custom-download {

        background-color: #2f7e32;
        color: white;
        border: none;
    }

    .btn-custom-download:hover {
        background-color: #45A049;
        color: white;
    }

    .btn-excel {
        background-color: #1d7a91;
        color: white;
        border: none;
    }

    .btn-excel:hover {
        background-color: #1d7a91;
        color: white;
    }

    .btn-pdf {
        background-color: #d9534f;
        color: white;
        border: none;
    }

    .btn-pdf:hover {
        background-color: #d9534f;
        color: white;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();

        @foreach($reportData->groupBy('programaEducativo.unidadAcademica.institucion.institucion') as $institucion => $dataGroup)
        $('#table-detalle-{{ $loop->iteration }}').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            searching: true,
            paging: true,
            info: true
        });
        @endforeach
    });
</script>
@endsection
