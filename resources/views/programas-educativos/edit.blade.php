@extends('layouts.app')

@section('title', 'Editar Programa Educativo')

@section('content')
<div class="container">
  <div class="container">
      <div class="bg-light">
          <div class="container mt-5">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <h1 class="card-title text-center">Editar Programa Educativo</h1>
                    <form id="ProgramForm" action="{{ route('programas-educativos.update', $programa_educativo->id) }}" method="POST">
                      @csrf
                      @method('PUT')

                      <div class="mb-3">
                        <label for="programa_educativo" class="form-label">Nombre del Programa Educativo:</label>
                        <input value="{{ old('programa_educativo', $programa_educativo->programa_educativo) }}" name="programa_educativo" class="form-control">
                        @error('programa_educativo')
                          <br>
                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="mb-3">
                          <label for="id_unidad_academica" class="form-label">Unidad Académica:</label>
                          <select class="form-select" aria-label="Default select example" name="id_unidad_academica">
                              @foreach($unidades as $unidad)
                                  <option value="{{ $unidad->id }}" {{ old('id_unidad_academica', $programa_educativo->id_unidad_academica) == $unidad->id ? 'selected' : '' }}>{{ $unidad->unidad_academica }}</option>
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
                          <label for="id_nivel" class="form-label">Nivel del Programa: </label>
                          <select class="form-select" aria-label="Default select example" name="id_nivel">
                              @foreach($niveles as $nivel)
                                  <option value="{{ $nivel->id }}" {{ old('id_nivel', $programa_educativo->id_nivel) == $nivel->id ? 'selected' : '' }}>{{ $nivel->nivel }}</option>
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
                          <label for="id_area_conocimento" class="form-label">Área del Conocimiento: </label>
                          <select class="form-select" aria-label="Default select example" name="id_area_conocimento">
                              @foreach($areas as $area)
                                  <option value="{{ $area->id }}" {{ old('id_area_conocimento', $programa_educativo->id_area_conocimento) == $area->id ? 'selected' : '' }}>{{ $area->area_conocimiento }}</option>
                              @endforeach
                          </select>
                          @error('id_area_conocimento')
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
                                     value="1" {{ old('status', $programa_educativo->status) == '1' ? 'checked' : '' }}>
                              <label class="form-check-label" for="habilitar">
                                  Habilitar
                              </label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="deshabilitar"
                                     value="0" {{ old('status', $programa_educativo->status) == '0' ? 'checked' : '' }}>
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
                        <a href="{{ route('programas-educativos.index') }}" class="btn btn-secondary">Volver</a>
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

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
// Función para mostrar SweetAlert antes de enviar el formulario
document.getElementById('ProgramForm').addEventListener('submit', function(e) {
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
      document.getElementById('ProgramForm').submit();
    }
  });
});
</script>

@endsection