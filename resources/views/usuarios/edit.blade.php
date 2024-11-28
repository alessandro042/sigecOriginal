@extends('layouts.app')

@section('content')
  <div class="bg-light">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h1 class="card-title text-center">Formulario para editar un Usuario</h1>
              <form id="userForm" action="{{ route('usuarios.update', $usuario) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                  <label for="nombre_completo" class="form-label">Nombre completo:</label>
                  <input value="{{ old('nombre_completo', $usuario->nombre_completo) }}" name="nombre_completo" class="form-control">
                  @error('nombre_completo')
                    <br>
                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="username" class="form-label">Nombre de usuario:</label>
                  <input value="{{ old('username', $usuario->username) }}" name="username" class="form-control">
                  @error('username')
                    <br>
                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña:</label>
                  <input type="password" name="password" class="form-control">
                  <small class="form-text text-muted">Dejar en blanco para mantener la misma contraseña.</small>
                  @error('password')
                    <br>
                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" value="{{ old('email', $usuario->email) }}" name="email" class="form-control">
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
                    <option  disabled value="0" {{ old('id_rol', $usuario->id_rol) == 0 ? 'selected' : '' }}>Seleccione una opción</option>
                    <option value="11" {{ old('id_rol', $usuario->id_rol) == 11 ? 'selected' : '' }}>Administrador</option>
                    <option value="12" {{ old('id_rol', $usuario->id_rol) == 12 ? 'selected' : '' }}>Empleado</option>
                  </select>
                  @error('id_rol')
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
    
    // Función para mostrar SweetAlert antes de enviar el formulario
  document.getElementById('userForm').addEventListener('submit', function(e) {
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
        document.getElementById('userForm').submit();
      }
    });
  });
  </script>
@endsection
