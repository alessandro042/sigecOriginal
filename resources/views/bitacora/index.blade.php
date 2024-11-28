@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card p-5">
            <h1 class="text-3xl font-bold mb-6 text-center text-blue-600">Bitácora de Actividades</h1>

            <form method="POST" action="{{ route('bitacora.buscar') }}">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-3">
                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="{{ request('fecha_inicio', $fecha) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                            value="{{ request('fecha_fin', $fecha) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="accion">Acción:</label>
                        <select name="accion" id="accion" class="form-select" aria-label="Acción">
                            <option selected value="">Todas</option>
                            @foreach ($acciones as $accion)
                                <option value="{{ $accion->id }}"
                                    {{ request('accion') == $accion->id ? 'selected' : '' }}>{{ $accion->accion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="seccion">Sección:</label>
                        <select name="seccion" id="seccion" class="form-select" aria-label="Sección">
                            <option selected value="">Todas</option>
                            @foreach ($secciones as $seccion)
                                <option value="{{ $seccion->id }}"
                                    {{ request('seccion') == $seccion->id ? 'selected' : '' }}>{{ $seccion->seccion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>


            <div class="table-responsive">
                <table id="tabla_bitacora" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hora</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Sección</th>
                            <th scope="col">Acción</th>
                            <th scope="col">ID del Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bitacoras as $bitacora)
                            <tr>
                                <td>{{ $bitacora->hora }}</td>
                                <td>{{ $bitacora->usuario->nombre_completo }}</td>
                                <td>{{ $bitacora->seccion->seccion }}</td>
                                <td>{{ $bitacora->accion->accion }}</td>
                                <td>{{ $bitacora->id_registro }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{--

        <div class="mt-4 d-flex justify-content-center">
            {{ $bitacoras->links() }}
        </div> --}}
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tabla_bitacora').DataTable({
                responsive: true,
                paging: true,
                ordering: true,

                info: true,

                language: {
                url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }

            });
        });
    </script>
@endsection
