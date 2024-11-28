@extends('layouts.app')

@section('title', 'Editar Matrícula Igualdad')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="display-4 mb-4">Editar Matrícula Igualdad</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="editForm" action="{{ route('matricula.igualdad-genero.update', $matricula->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="id_programa_educativo" class="form-label">Programa Educativo</label>
                                <select class="form-select select2" name="id_programa_educativo">
                                    <option value="0"
                                        {{ old('id_programa_educativo', $matricula->id_programa_educativo) == 0 ? 'selected' : '' }}>
                                        Seleccione una opción
                                    </option>
                                    @foreach ($programasEducativos as $programa)
                                        @php
                                            $siglas = $programa->unidadAcademica->siglas;
                                        @endphp
                                        <option value="{{ $programa->id }}"
                                            {{ old('id_programa_educativo', $matricula->id_programa_educativo) == $programa->id ? 'selected' : '' }}>
                                            {{ $programa->programa_educativo }} ({{ $siglas }})
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
                                <label for="hombres" class="form-label">Hombres:</label>
                                <input id="hombres" value="{{ old('hombres', $matricula->hombres) }}" name="hombres"
                                    class="form-control" oninput="calculateTotal()">
                                @error('hombres')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mujeres" class="form-label">Mujeres:</label>
                                <input id="mujeres" value="{{ old('mujeres', $matricula->mujeres) }}" name="mujeres"
                                    class="form-control" oninput="calculateTotal()">
                                @error('mujeres')
                                    <div class="alert alert-danger">{{ $message }}</div>
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
                                <a href="{{ route('matricula.igualdad-genero.index') }}"
                                    class="btn btn-secondary">Cancelar</a>
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
            const hombres = parseInt(document.getElementById('hombres').value) || 0;
            const mujeres = parseInt(document.getElementById('mujeres').value) || 0;
            const otros = parseInt(document.getElementById('otros').value) || 0;
            const total = hombres + mujeres + otros;
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
