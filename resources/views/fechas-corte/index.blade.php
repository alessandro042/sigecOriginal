@extends('layouts.app')

@section('title', 'Matrícula Inclusión')

@section('content')

<div class="container mt-2">
    <div class="card p-3">
        <h1 class="mb-4 text-center text-3xl font-bold text-blue-600">Gestión de Fechas de corte</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('fechas-corte.create') }}" class="btn btn-primary btn-md">Crear nueva fecha de corte</a>
        </div>
        <div class="table-responsive">
            <table class="table-bordered table-striped table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Status</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fechasCorte as $fechaCorte)
                        <tr id="fecha-corte-{{ $fechaCorte->id }}">
                            <td>{{ $fechaCorte->id }}</td>
                            <td>{{ $fechaCorte->fecha }}</td>
                            <td class="estado">
                                @if ($fechaCorte->status == 1)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('fechas-corte.edit', $fechaCorte) }}" class="btn btn-warning me-2">Editar</a>
                                <button class="btn toggle-status {{ $fechaCorte->status == 1 ? 'btn-danger' : 'btn-success' }}" data-id="{{ $fechaCorte->id }}">
                                    {{ $fechaCorte->status == 1 ? 'Deshabilitar' : 'Habilitar' }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.toggle-status');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const fechaCorteId = this.getAttribute('data-id');
                const row = document.getElementById('fecha-corte-' + fechaCorteId);
                if (!row) {
                    console.error('No se encontró la fila con ID:', 'fecha-corte-' + fechaCorteId);
                    return;
                }
                const statusCell = row.querySelector('.estado');
                if (!statusCell) {
                    console.error('No se encontró la celda de estado en la fila con ID:', 'fecha-corte-' + fechaCorteId);
                    return;
                }
                const button = this;

                Swal.fire({
                    title: 'Confirmar acción',
                    text: '¿Estás seguro de que deseas cambiar el estado de la fecha de corte?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/fechas-corte/${fechaCorteId}/toggle-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.status == 1) {
                                statusCell.textContent = 'Activo';
                                button.textContent = 'Deshabilitar';
                                button.classList.remove('btn-success');
                                button.classList.add('btn-danger');
                                Swal.fire({
                                    title: 'Estado cambiado',
                                    text: 'La fecha de corte ahora está activa',
                                    icon: 'success'
                                });
                            } else {
                                statusCell.textContent = 'Inactivo';
                                button.textContent = 'Habilitar';
                                button.classList.remove('btn-danger');
                                button.classList.add('btn-success');
                                Swal.fire({
                                    title: 'Estado cambiado',
                                    text: 'La fecha de corte ahora está inactiva',
                                    icon: 'success'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Hubo un problema al cambiar el estado',
                                icon: 'error'
                            });
                        });
                    }
                });
            });
        });
    });
</script>

@endsection
