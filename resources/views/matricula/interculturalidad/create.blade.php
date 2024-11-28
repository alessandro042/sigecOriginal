@extends('layouts.app')

@section('content')
    <div class="bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title text-center">Formulario para crear una Matricula</h1>
                            <form action="{{route('matricula.interculturalidad.store')}}" method="POST">
                            @csrf


                            <div class="mb-3">
                                <label for="id_programa_educativo" class="form-label">Programa Educativo</label>
                                <select class="form-select" name="id_programa_educativo">
                                    <option value="0" {{ old('id_programa_educativo') == 0 ? 'selected' : '' }}>Seleccione una opción</option>
                                    @foreach($programasEducativos as $programa)
                                        <option value="{{ $programa->id }}" {{ old('id_programa_educativo') == $programa->id ? 'selected' : '' }}>
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
                                    <option value="0" {{ old('id_fechas_corte') == 0 ? 'selected' : '' }}>Seleccione una opción</option>
                                    @foreach($fechasCorte as $fecha)
                                        <option value="{{ $fecha->id }}" {{ old('id_fechas_corte') == $fecha->id ? 'selected' : '' }}>
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
                                <input id="indigenas" value="{{ old('indigenas') }}" name="indigenas" class="form-control" oninput="calculateTotal()">
                                @error('indigenas')
                                <br>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="afroamericanos" class="form-label">Afroamericanos:</label>
                                <input id="afroamericanos" value="{{ old('afroamericanos') }}" name="afroamericanos" class="form-control" oninput="calculateTotal()">
                                @error('afroamericanos')
                                <br>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="imigrantes" class="form-label">Inmigrantes:</label>
                                <input id="imigrantes" value="{{ old('imigrantes') }}" name="imigrantes" class="form-control" oninput="calculateTotal()">
                                    @error('imigrantes')
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="otros" class="form-label">Otros:</label>
                                <input id="otros" value="{{ old('otros') }}" name="otros" class="form-control" oninput="calculateTotal()">
                                    @error('otros')
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="total" class="form-label">Total:</label>
                                <input id="total" value="{{ old('total') }}" name="total" class="form-control" readonly>
                                    @error('total')
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
                                </div>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('matricula.interculturalidad.index') }}" class="btn btn-secondary">Volver a Matricula</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateTotal() {
            const indigenas = parseInt(document.getElementById('indigenas').value) || 0;
            const afroamericanos = parseInt(document.getElementById('afroamericanos').value) || 0;
            const imigrantes = parseInt(document.getElementById('imigrantes').value) || 0;
            const otros = parseInt(document.getElementById('otros').value) || 0;
            const total = indigenas + afroamericanos + imigrantes + otros;
            document.getElementById('total').value = total;
        }
    </script>
@endsection
