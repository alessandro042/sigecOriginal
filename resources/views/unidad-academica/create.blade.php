<!-- resources/views/principales/matricula.blade.php -->
@extends('layouts.app')

@section('title', 'Unidades académicas')

@section('content')
<div class="container">
    <div class="bg-light">
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h1 class="card-title text-center">Formulario para crear una Unidad Academica</h1>
                  <form id="createForm" action="{{ route('unidad-academica.store') }}" method="POST">
                    @csrf
    
                    <div class="mb-3">
                      <label for="unidad_academica" class="form-label">Nombre de la Unidad Academica:</label>
                      <input value="{{ old('unidad_academica') }}" name="unidad_academica" class="form-control">
                      @error('unidad_academica')
                        <br>
                        <div class="alert alert-danger" role="alert">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="id_institucion" class="form-label">Institucion Educativa:</label>
                        <select class="form-select" aria-label="Default select example" name="id_institucion">
                          <option value="0" {{ old('id_institucion') == 0 ? 'selected' : '' }} disabled=true >Seleccione una opcion</option>
                          @foreach($instituciones as $institucion)
                            <option value="{{ $institucion->id }}" {{ old('id_institucion') == $institucion->id ? 'selected' : '' }}>{{ $institucion->institucion}}</option>
                          @endforeach
                        </select>
                        @error('id_institucion')
                          <br>
                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="id_nivel" class="form-label">Nivel  Acadermico: </label>
                        <select class="form-select" aria-label="Default select example" name="id_nivel">
                          <option value="0" {{ old('id_nivel') == 0 ? 'selected' : '' }} disabled=true >Seleccione una opcion</option>
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
                      <label for="id_municipio" class="form-label">Municipio: </label>
                      <select class="form-select" aria-label="Default select example" name="id_municipio">
                        <option value="0" {{ old('id_municipio') == 0 ? 'selected' : '' }} disabled=true>Seleccione una opcion</option>
                        @foreach($municipios as $municipio)
                          <option value="{{ $municipio->id }}" {{ old('id_municipio') == $municipio->id ? 'selected' : '' }}>{{ $municipio->municipio}}</option>
                        @endforeach
                      </select>
                      @error('id_municipio')
                        <br>
                        <div class="alert alert-danger" role="alert">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
    
                    <div class="mb-3">
                      <label for="clave" class="form-label">Clave:</label>
                      <input type="clave" value="{{ old('clave') }}" name="clave" class="form-control">
                      @error('clave')
                        <br>
                        <div class="alert alert-danger" role="alert">
                          {{ $message }}
                        </div>
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
