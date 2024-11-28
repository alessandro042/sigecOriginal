<!-- resources/views/principales/matricula.blade.php -->
@extends('layouts.app')

@section('title', 'Programas educativos')

@section('content')
<div class="container">
    <div class="container">
        <div class="bg-light">
            <div class="container mt-5">
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <h1 class="card-title text-center">Formulario para crear un Programa Educativo</h1>
                      <form id="createForm" action="{{ route('programas-educativos.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                          <label for="programa_educativo" class="form-label">Nombre del Programa Educativo:</label>
                          <input value="{{ old('programa_educativo') }}" name="programa_educativo" class="form-control">
                          @error('programa_educativo')
                            <br>
                            <div class="alert alert-danger" role="alert">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_unidad_academica" class="form-label">Unidad Academica:</label>
                            <select class="form-select select2" aria-label="Default select example" name="id_unidad_academica">
                              <option value="0" {{ old('id_unidad_academica') == 0 ? 'selected' : '' }} disabled=true >Seleccione una opcion</option>
                              @foreach($unidades as $unidad)
                                <option value="{{ $unidad->id }}" {{ old('id_unidad_academica') == $unidad->id ? 'selected' : '' }}>{{ $unidad->unidad_academica}}</option>
                              @endforeach
                            </select>
                            @error('id_unidad_academica')
                              <br>
                              <div class="alert alert-danger" role="alert">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_nivel" class="form-label">Nivel  del Programa: </label>
                            <select class="form-select" aria-label="Default select example" name="id_nivel">
                              <option value="0" {{ old('id_nivel') == 0 ? 'selected' : '' }} disabled=true>Seleccione una opcion</option>
                              @foreach($niveles as $nivel)
                                <option value="{{ $nivel->id }}" {{ old('id_nivel') == $nivel->id ? 'selected' : '' }}>{{ $nivel->nivel }}</option>
                              @endforeach
                            </select>
                            @error('id_nivel')
                              <br>
                              <div class="alert alert-danger" role="alert">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>

                        <div class="mb-3">
                          <label for="id_area_conocimiento" class="form-label">Area del Conocimiento: </label>
                          <select class="form-select" aria-label="Default select example" name="id_area_conocimiento">
                            <option value="0" {{ old('id_area_conocimiento') == 0 ? 'selected' : '' }} disabled=true>Seleccione una opcion</option>
                            @foreach($areas as $area)
                              <option value="{{ $area->id }}" {{ old('id_area_conocimiento') == $area->id ? 'selected' : '' }}>{{ $area->area_conocimiento}}</option>
                            @endforeach
                          </select>
                          @error('id_area_conocimiento')
                            <br>
                            <div class="alert alert-danger" role="alert">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>

                        <div class="mb-3">
                          <label for="id_modalidad" class="form-label">Modalidad: </label>
                          <select class="form-select" aria-label="Default select example" name="id_modalidad">
                            <option value="0" {{ old('id_modalidad') == 0 ? 'selected' : '' }} disabled=true >Seleccione una opcion</option>
                            @foreach($modalidades as $modalidad)
                              <option value="{{ $modalidad->id }}" {{ old('id_modalidad') == $modalidad->id ? 'selected' : '' }}>{{ $modalidad->modalidad}}</option>
                            @endforeach
                          </select>
                          @error('id_modalidad')
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
                          <button id="submitButton" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                        <div class="d-grid mt-3 gap-2">
                          <a href="{{ route('unidad-academica.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('createForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const form = this;

            Swal.fire({
                title: 'Confirmar envío',
                text: "¿Estás seguro de que deseas enviar el formulario?",
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
</script>

@endsection
