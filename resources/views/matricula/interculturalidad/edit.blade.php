@extends('layouts.app')

@section('title', 'Editar Matrícula Interculturalidad')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-4 mb-4">Editar Matrícula Interculturalidad</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('matricula.interculturalidad.update', $matricula->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="id_programa_educativo" class="form-label">Programa Educativo</label>
                            <select class="form-select" name="id_programa_educativo">
                                <option value="0" {{ old('id_programa_educativo', $matricula->id_programa_educativo) == 0 ? 'selected' : '' }}>Seleccione una opción</option>
                                @foreach($programasEducativos as $programa)
                                    <option value="{{ $programa->id }}" {{ old('id_programa_educativo', $matricula->id_programa_educativo) == $programa->id ? 'selected' : '' }}>
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
                                <option value="0" {{ old('id_fechas_corte', $matricula->id_fechas_corte) == 0 ? 'selected' : '' }}>Seleccione una opción</option>
                                @foreach($fechasCorte as $fecha)
                                    <option value="{{ $fecha->id }}" {{ old('id_fechas_corte', $matricula->id_fechas_corte) == $fecha->id ? 'selected' : '' }}>
                                        {{ $fecha->fecha }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_fechas_corte')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="indigenas" class="form-label">Indigenas:</label>
                            <input value="{{ old('indigenas', $matricula->indigenas) }}" name="indigenas" class="form-control">
                            @error('indigenas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="afroamericanos" class="form-label">Afroamericanos:</label>
                            <input value="{{ old('afroamericanos', $matricula->afroamericanos) }}" name="afroamericanos" class="form-control">
                            @error('afroamericanos')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="imigrantes" class="form-label">Inmigrantes:</label>
                            <input value="{{ old('imigrantes', $matricula->imigrantes) }}" name="imigrantes" class="form-control">
                            @error('imigrantes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="otros" class="form-label">Otros:</label>
                            <input value="{{ old('otros', $matricula->otros) }}" name="otros" class="form-control">
                            @error('otros')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total:</label>
                            <input value="{{ old('total', $matricula->total) }}" name="total" class="form-control">
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
                            <a href="{{ route('matricula.interculturalidad.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection