@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold text-primary" style="color: #012553;">Gestión de Proveedores</h1>
        <button class="btn text-white shadow-sm px-4" style="background-color: #012553; border: none;" data-bs-toggle="modal" data-bs-target="#addProviderModal">
            <i class="bi bi-plus-circle"></i> Agregar Proveedor
        </button>
    </div>

    <div class="card shadow rounded-4 border-0">
        <div class="card-header text-white rounded-top-4" style="background-color: #012553;">
            <h5 class="mb-0">Listado de Proveedores</h5>
        </div>
        <div class="table-responsive">
            <table id="usuariosTable" class="table table-hover align-middle text-center" style="border: 1px solid #ddd;">
                <thead style="background-color: #012553; color: #fff;">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $proveedor->nombre }}</td>
                            <td>{{ $proveedor->telefono ?? 'N/A' }}</td>
                            <td>{{ $proveedor->email }}</td>
                            <td>{{ $proveedor->direccion ?? 'N/A' }}</td>
                            <td>
                                <div class="d-flex align-items-baseline" role="group" aria-label="Acciones">
                                    <button class="btn btn-sm text-white shadow-sm" style="background-color: #01427E; flex: 0.5; margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#editProviderModal-{{ $proveedor->id }}">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                    <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este proveedor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm text-white shadow-sm" style="background-color: #8B0000; flex: 1;">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade custom-modal" id="editProviderModal-{{ $proveedor->id }}" tabindex="-1" aria-labelledby="editProviderModalLabel-{{ $proveedor->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg border-0 rounded-4">
                                    <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header text-white rounded-top-4" style="background-color: #01427E;">
                                            <h5 class="modal-title" id="editProviderModalLabel-{{ $proveedor->id }}">Editar Proveedor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nombre-{{ $proveedor->id }}" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre-{{ $proveedor->id }}" name="nombre" value="{{ $proveedor->nombre }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telefono-{{ $proveedor->id }}" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="telefono-{{ $proveedor->id }}" name="telefono" value="{{ $proveedor->telefono }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email-{{ $proveedor->id }}" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email-{{ $proveedor->id }}" name="email" value="{{ $proveedor->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="direccion-{{ $proveedor->id }}" class="form-label">Dirección</label>
                                                <textarea class="form-control" id="direccion-{{ $proveedor->id }}" name="direccion" rows="3">{{ $proveedor->direccion }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn text-white rounded-pill" style="background-color: #01427E;">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade custom-modal" id="addProviderModal" tabindex="-1" aria-labelledby="addProviderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf
                <div class="modal-header text-white rounded-top-4" style="background-color: #012553;">
                    <h5 class="modal-title" id="addProviderModalLabel">Agregar Nuevo Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea class="form-control" id="direccion" name="direccion" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn text-white rounded-pill" style="background-color: #012553;">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

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

