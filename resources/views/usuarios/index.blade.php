@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold text-primary" style="color: #012553;">Gestión de Usuarios</h1>
        <button
            class="btn text-white shadow-sm px-4"
            style="background-color: #012553; border: none;"
            onclick="window.location.href='{{ route('usuarios.create') }}'">
            <i class="bi bi-plus-circle"></i> Crear nuevo usuario
        </button>
    </div>

    <div class="card shadow rounded-4 border-0">
        <div class="card-header text-white rounded-top-4" style="background-color: #012553;">
            <h5 class="mb-0">Listado de usuarios</h5>
        </div>
        <div class="table-responsive">
            <table id="usuariosTable" class="table table-hover align-middle text-center" style="border: 1px solid #ddd;">
                <thead style="background-color: #012553; color: #fff;">
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
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button
                                    class="btn btn-sm text-white shadow-sm"
                                    style="background-color: #01427E;"
                                    onclick="window.location.href='{{ route('usuarios.edit', $usuario) }}'">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </button>
                                <button
                                    class="btn btn-sm text-white shadow-sm toggle-status"
                                    style="background-color: {{ $usuario->status == 1 ? '#8B0000' : '#4CAF50' }}"
                                    data-id="{{ $usuario->id }}">
                                    {{ $usuario->status == 1 ? 'Deshabilitar' : 'Habilitar' }}
                                </button>
                            </div>
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
                                    button.style.backgroundColor = '#8B0000';
                                    button.classList.add('btn-danger');
                                    Swal.fire({
                                        title: 'Estado cambiado',
                                        text: 'El usuario ahora está activo',
                                        icon: 'success'
                                    });
                                } else {
                                    statusCell.textContent = 'Inactivo';
                                    button.textContent = 'Habilitar';
                                    button.style.backgroundColor = '#4CAF50';
                                    button.classList.remove('btn-danger');
                                    button.classList.add('btn-success');
                                    // Mostrar alerta de éxito
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
