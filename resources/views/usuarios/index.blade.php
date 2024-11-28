@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="card p-3">
        <h1 class="mb-4 text-center text-3xl font-bold text-blue-600">Gestión de Usuarios</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-md">Crear nuevo usuario</a>
        </div>
        <div class="table-responsive">
            <table id="usuariosTable" class="table-bordered table-striped table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr id="usuario-{{ $usuario->id }}">
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->username }}</td>
                        <td>{{ $usuario->nombre_completo }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol->rol }}</td>
                        <td class="estado">
                            @if ($usuario->status == 1)
                            Activo
                            @else
                            Inactivo
                            @endif
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning me-2">Editar</a>
                            <button class="btn toggle-status {{ $usuario->status == 1 ? 'btn-danger' : 'btn-success' }}" data-id="{{ $usuario->id }}">
                                {{ $usuario->status == 1 ? 'Deshabilitar' : 'Habilitar' }}
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $usuarios->links() }}
        </div>
    </div>
    @if (session('usuario'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Usuario Registrado Exitosamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#usuariosTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });

        const buttons = document.querySelectorAll('.toggle-status');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const row = document.getElementById('usuario-' + userId);
                const statusCell = row.querySelector('.estado');
                const button = this;

                Swal.fire({
                    title: 'Confirmar acción',
                    text: '¿Estás seguro de que deseas cambiar el estado del usuario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/usuarios/${userId}/toggle-status`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status == 1) {
                                    statusCell.textContent = 'Activo';
                                    button.textContent = 'Deshabilitar';
                                    button.classList.remove('btn-success');
                                    button.classList.add('btn-danger');
                                    Swal.fire({
                                        title: 'Estado cambiado',
                                        text: 'El usuario ahora está activo',
                                        icon: 'success'
                                    });
                                } else {
                                    statusCell.textContent = 'Inactivo';
                                    button.textContent = 'Habilitar';
                                    button.classList.remove('btn-danger');
                                    button.classList.add('btn-success');
                                    Swal.fire({
                                        title: 'Estado cambiado',
                                        text: 'El usuario ahora está inactivo',
                                        icon: 'success'
                                    });
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    });
</script>

@endsection
