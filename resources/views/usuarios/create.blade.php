@extends('layouts.app')

@section('content')
  <div class="bg-light">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h1 class="card-title text-center">Formulario para crear un Usuario</h1>
              <form id="userForm" action="{{ route('usuarios.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                  <label for="nombre_completo" class="form-label">Nombre completo:</label>
                  <input value="{{ old('nombre_completo') }}" name="nombre_completo" class="form-control">
                  @error('nombre_completo')
                    <br>
                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="username" class="form-label">Nombre de usuario:</label>
                  <input value="{{ old('username') }}" name="username" class="form-control">
                  @error('username')
                    <br>
                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña:</label>
                  <input type="password" value="{{ old('password') }}" name="password" class="form-control">
                  @error('password')
                    <br>
                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" value="{{ old('email') }}" name="email" class="form-control">
                  @error('email')
                    <br>
                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="id_rol" class="form-label">Rol:</label>
                  <select class="form-select" aria-label="Default select example" name="id_rol" id="id_rol">
                    <option value="0" {{ old('id_rol') == 0 ? 'selected' : '' }} disabled>Seleccione una opción</option>
                    <option value="11" {{ old('id_rol') == 11 ? 'selected' : '' }}>Administrador</option>
                    <option value="12" {{ old('id_rol') == 12 ? 'selected' : '' }}>Empleado</option>
                  </select>
                  @error('id_rol')
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
                  <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver a usuarios</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    /* Alerta */
    document.getElementById('userForm').addEventListener('submit', function(event) {
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
