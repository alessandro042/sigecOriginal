<!-- resources/views/principales/matricula.blade.php -->
@extends('layouts.app')

@section('title', 'Unidades académicas')

@section('content')
<div class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title text-center">Formulario para actualizar una Unidad Académica</h1>
            <form id="unidForm" action="{{ route('unidad-academica.update', $unidad_academica->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="unidad_academica" class="form-label">Nombre de la Unidad Académica:</label>
                <input value="{{ old('unidad_academica', $unidad_academica->unidad_academica) }}" name="unidad_academica" class="form-control">
                @error('unidad_academica')
                  <br>
                  <div class="alert alert-danger" role="alert">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="mb-3">
                  <label for="id_institucion" class="form-label">Institución Educativa:</label>
                  <select class="form-select" aria-label="Default select example" name="id_institucion">
                    @foreach($instituciones as $institucion)
                      <option value="{{ $institucion->id }}" {{ old('id_institucion', $unidad_academica->id_institucion) == $institucion->id ? 'selected' : '' }}>{{ $institucion->institucion}}</option>
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
                  <label for="id_nivel" class="form-label">Nivel Académico: </label>
                  <select class="form-select" aria-label="Default select example" name="id_nivel">
                    @foreach($niveles as $nivel)
                      <option value="{{ $nivel->id }}" {{ old('id_nivel', $unidad_academica->id_nivel) == $nivel->id ? 'selected' : '' }}>{{ $nivel->nivel }}</option>
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
                  @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}" {{ old('id_municipio', $unidad_academica->id_municipio) == $municipio->id ? 'selected' : '' }}>{{ $municipio->municipio }}</option>
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
                <input type="clave" value="{{ old('clave', $unidad_academica->clave) }}" name="clave" class="form-control">
                @error('clave')
                  <br>
                  <div class="alert alert-danger" role="alert">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="d-grid gap-2">
                <button id="submitButton" type="submit" class="btn btn-primary">Actualizar</button>
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


<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  // Función para mostrar SweetAlert antes de enviar el formulario
  document.getElementById('unidForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Evitar el envío automático del formulario

    Swal.fire({
      title: '¿Estás seguro?',
      text: "Una vez actualizado, no podrás revertir los cambios.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, actualizar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Si el usuario confirma, se envía el formulario
        document.getElementById('unidForm').submit();
      }
    });
  });
</script>

@endsection