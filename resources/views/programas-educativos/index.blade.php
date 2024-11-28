@extends('layouts.app')

@section('title', 'Programas educativos')

@section('content')
<div class="container mt-2">
    <div class="card p-3">
        <h1 class="mb-4 text-center text-3xl font-bold text-blue-600">Gestión de Programas Educativos</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('programas-educativos.create') }}" class="btn btn-primary">Nuevo programa educativo</a>
        </div>
        <div class="table-responsive">
            <table id="programasTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Programa educativo</th>
                        <th>Unidad Académica</th>
                        <th>Nivel del Programa</th>
                        <th>Área del Conocimiento</th>
                        <th>Modalidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programas_educativos as $programa_educativo)
                    <tr id="programa-{{ $programa_educativo->id }}">
                        <td>{{ $programa_educativo->id }}</td>
                        <td>{{ $programa_educativo->programa_educativo }}</td>
                        <td>{{ $programa_educativo->unidadAcademica->unidad_academica ?? 'N/A' }}</td>
                        <td>{{ $programa_educativo->nivel->nivel ?? 'N/A' }}</td>
                        <td>{{ $programa_educativo->areaConocimiento->area_conocimiento ?? 'N/A' }}</td>
                        <td>{{ $programa_educativo->modalidad->modalidad ?? 'N/A' }}</td>
                        <td class="estado">
                            {{ $programa_educativo->status == 1 ? 'Activo' : 'Inactivo' }}
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('programas-educativos.edit', $programa_educativo->id) }}" class="btn btn-warning me-2">Editar</a>
                            <button class="btn toggle-status {{ $programa_educativo->status == 1 ? 'btn-danger' : 'btn-success' }}" data-id="{{ $programa_educativo->id }}">
                                {{ $programa_educativo->status == 1 ? 'Deshabilitar' : 'Habilitar' }}
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#programasTable').DataTable({
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
                const programaId = this.getAttribute('data-id');
                const row = document.getElementById('programa-' + programaId);
                const statusCell = row.querySelector('.estado');
                const button = this;

                Swal.fire({
                    title: 'Confirmar acción',
                    text: `¿Estás seguro de que deseas cambiar el estado del programa educativo?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/programas-educativos/${programaId}/toggle-status`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Hubo un problema al cambiar el estado del programa educativo');
                                }
                                return response.json();
                            })
                            .then(data => {
                                statusCell.textContent = data.status == 1 ? 'Activo' : 'Inactivo';
                                button.textContent = data.status == 1 ? 'Deshabilitar' : 'Habilitar';
                                button.classList.toggle('btn-danger');
                                button.classList.toggle('btn-success');
                                Swal.fire({
                                    title: 'Estado cambiado',
                                    text: `El programa educativo ahora está ${data.status == 1 ? 'activo' : 'inactivo'}`,
                                    icon: 'success'
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Hubo un problema al cambiar el estado del programa educativo',
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
