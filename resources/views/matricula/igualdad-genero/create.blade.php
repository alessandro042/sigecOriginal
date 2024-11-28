@extends('layouts.app')

@section('title', 'Matrícula Igualdad - Crear')

@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($alert)
            <div class="alert alert-warning">
                {{ $alert }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center">Formulario para crear una Matrícula</h1>
                        <form id="createForm" action="{{ route('matricula.igualdad-genero.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="id_programa_educativo" class="form-label">Programa Educativo</label>
                                <select class="form-select select2" name="id_programa_educativo">
                                    <option value="0" {{ old('id_programa_educativo') == 0 ? 'selected' : '' }}>
                                        Seleccione una opción
                                    </option>
                                    @foreach ($programasEducativos as $programa)
                                        @php
                                            $siglas = $programa->unidadAcademica->siglas;
                                        @endphp
                                        <option value="{{ $programa->id }}"
                                            {{ old('id_programa_educativo') == $programa->id ? 'selected' : '' }}>
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
                                <select class="form-select select2" name="id_fechas_corte">
                                    <option value="0" {{ old('id_fechas_corte') == 0 ? 'selected' : '' }}>
                                        Seleccione una opción</option>
                                    @foreach ($fechasCorte as $fecha)
                                        <option value="{{ $fecha->id }}"
                                            {{ old('id_fechas_corte') == $fecha->id ? 'selected' : '' }}>
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
                                <input id="hombres" value="{{ old('hombres') }}" name="hombres" class="form-control"
                                    oninput="calculateTotal()">
                                @error('hombres')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mujeres" class="form-label">Mujeres:</label>
                                <input id="mujeres" value="{{ old('mujeres') }}" name="mujeres" class="form-control"
                                    oninput="calculateTotal()">
                                @error('mujeres')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="otros" class="form-label">Otros:</label>
                                <input id="otros" value="{{ old('otros') }}" name="otros" class="form-control"
                                    oninput="calculateTotal()">
                                @error('otros')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="total" class="form-label">Total:</label>
                                <input id="total" value="{{ old('total') }}" name="total" class="form-control"
                                    readonly>
                                @error('total')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Estado</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="habilitar"
                                        value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="habilitar">
                                        Habilitar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="deshabilitar"
                                        value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="deshabilitar">
                                        Deshabilitar
                                    </label>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('matricula.igualdad-genero.index') }}" class="btn btn-secondary">Volver
                                    a Matricula</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        function calculateTotal() {
            const hombres = parseInt(document.getElementById('hombres').value) || 0;
            const mujeres = parseInt(document.getElementById('mujeres').value) || 0;
            const otros = parseInt(document.getElementById('otros').value) || 0;
            const total = hombres + mujeres + otros;
            document.getElementById('total').value = total;
        }

        document.getElementById('createForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const form = this;

            Swal.fire({
                title: 'Confirmar matrícula',
                text: "¿Estás seguro de que deseas enviar la matrícula?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, enviar',
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
