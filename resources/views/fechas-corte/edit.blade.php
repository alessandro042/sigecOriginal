<!-- resources/views/fechas-corte/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title text-center">Editar Fecha de Corte</h1>
                            <form id="userForm" action="{{ route('fechas-corte.update', $fechasCorte->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha de corte:</label>
                                    <input type="date" value="{{ old('fecha', $fechasCorte->fecha) }}" name="fecha" class="form-control">
                                    @error('fecha')
                                    <br>
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Estado</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="habilitar"
                                            value="1" {{ old('status', $fechasCorte->status) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="habilitar">
                                            Habilitar
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="deshabilitar"
                                            value="0" {{ old('status', $fechasCorte->status) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="deshabilitar">
                                            Deshabilitar
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <a href="{{ route('fechas-corte.index') }}" class="btn btn-secondary">Volver a fechas</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
