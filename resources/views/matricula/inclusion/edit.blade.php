@extends('layouts.app')

@section('title', 'Editar Matrícula Inclusión')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-4 mb-4">Editar Matrícula Inclusión</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="editForm" action="{{ route('matricula.inclusion.update', $matricula->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                            <div class="mb-3">
                                <label for="id_programa_educativo" class="form-label">Programa Educativo</label>
                                <select class="form-select" name="id_programa_educativo">
                                    <option value="0"
                                        {{ old('id_programa_educativo', $matricula->id_programa_educativo) == 0 ? 'selected' : '' }}>
                                        Seleccione una opción</option>
                                    @foreach ($programasEducativos as $programa)
                                        <option value="{{ $programa->id }}"
                                            {{ old('id_programa_educativo', $matricula->id_programa_educativo) == $programa->id ? 'selected' : '' }}>
                                            {{ $programa->programa_educativo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_programa_educativo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_fechas_corte" class="form-label">Fecha de Corte</label>
                                <select class="form-select" name="id_fechas_corte">
                                    <option value="0"
                                        {{ old('id_fechas_corte', $matricula->id_fechas_corte) == 0 ? 'selected' : '' }}>
                                        Seleccione una opción</option>
                                    @foreach ($fechasCorte as $fecha)
                                        <option value="{{ $fecha->id }}"
                                            {{ old('id_fechas_corte', $matricula->id_fechas_corte) == $fecha->id ? 'selected' : '' }}>
                                            {{ $fecha->fecha }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_fechas_corte')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="motriz" class="form-label">Motriz:</label>
                                <input id="motriz" value="{{ old('motriz') }}" name="motriz" class="form-control"
                                    oninput="calculateTotal()">
                                @error('motriz')
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="visual" class="form-label">Visual:</label>
                                <input id="visual" value="{{ old('visual') }}" name="visual" class="form-control"
                                    oninput="calculateTotal()">
                                @error('visual')
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="auditiva" class="form-label">Auditiva:</label>
                                <input id="auditiva" value="{{ old('auditiva') }}" name="auditiva" class="form-control"
                                    oninput="calculateTotal()">
                                @error('auditiva')
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cognitiva" class="form-label">Cognitiva:</label>
                                <input id="cognitiva" value="{{ old('cognitiva') }}" name="cognitiva" class="form-control"
                                    oninput="calculateTotal()">
                                @error('cognitiva')
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="transtorno_conducta" class="form-label">Transtorno de Conducta:</label>
                                <input id="transtorno_conducta" value="{{ old('transtorno_conducta') }}"
                                    name="transtorno_conducta" class="form-control" oninput="calculateTotal()">
                                @error('transtorno_conducta')
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="otros" class="form-label">Otros:</label>
                                <input id="otros" value="{{ old('otros', $matricula->otros) }}" name="otros"
                                    class="form-control" oninput="calculateTotal()">
                                @error('otros')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="total" class="form-label">Total:</label>
                                <input id="total" value="{{ old('total', $matricula->total) }}" name="total"
                                    class="form-control" readonly>
                                @error('total')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Estado</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="habilitar"
                                        value="1" {{ $matricula->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="habilitar">
                                        Habilitar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="deshabilitar"
                                        value="0" {{ $matricula->status == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="deshabilitar">
                                        Deshabilitar
                                    </label>
                                </div>
                            </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ route('matricula.inclusion.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function calculateTotal() {
        const motriz = parseInt(document.getElementById('motriz').value) || 0;
        const visual = parseInt(document.getElementById('visual').value) || 0;
        const auditiva = parseInt(document.getElementById('auditiva').value) || 0;
        const cognitiva = parseInt(document.getElementById('cognitiva').value) || 0;
        const transtorno_conducta = parseInt(document.getElementById('transtorno_conducta').value) || 0;
        const otros = parseInt(document.getElementById('otros').value) || 0;
        const total = motriz + visual + auditiva + cognitiva + transtorno_conducta + otros;
        document.getElementById('total').value = total;
    }

    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = this;

        Swal.fire({
            title: 'Confirmar actualización',
            text: "¿Estás seguro de que deseas actualizar la matrícula?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, actualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        calculateTotal();
    });
</script>
@endsection