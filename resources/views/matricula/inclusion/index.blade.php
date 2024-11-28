@extends('layouts.app')

@section('title', 'Matrícula Inclusión')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-4 mb-4">Matrícula Inclusión</h1>
            <p class="lead mb-4">La inclusión en el contexto de la discapacidad se refiere a garantizar la participación plena y equitativa de las personas con discapacidad en todos los ámbitos de la sociedad. Implica eliminar las barreras físicas, sociales y actitudinales que limitan la participación de las personas con discapacidad en la educación, el empleo, el acceso a servicios, la vida comunitaria y otros aspectos de la vida diaria. La inclusión busca promover la igualdad de oportunidades y trato justo para las personas con discapacidad, reconociendo y respetando sus derechos, capacidades y diversidad. Esto implica adaptar entornos, políticas y prácticas para que sean accesibles e inclusivos, y fomentar una cultura de respeto, aceptación y apoyo a la diversidad de las personas con discapacidad.</p>
            <blockquote class="blockquote mb-4">
                <p class="mb-0">"La inclusión no es un programa, es una actitud."</p>
                <footer class="blockquote-footer">Garth Stein</footer>
            </blockquote>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="table-responsive">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('matricula.inclusion.create') }}" class="btn btn-primary">Crear nueva matricula</a>
                </div>
                <table id="matriculasTable" class="table table-striped table-bordered" style="width:100%"> {{-- dt-responsive nowrap --}}
                    <thead>
                        <tr>
                            <th scope="col">Programa educativo</th>
                            <th scope="col">Fecha de corte</th>
                            <th scope="col">Motriz</th>
                            <th scope="col">Visual</th>
                            <th scope="col">Auditiva</th>
                            <th scope="col">Cognitiva</th>
                            <th scope="col">Transtorno de Conducta </th>
                            <th scope="col">Otros</th>
                            <th scope="col">Total</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matriculas as $matricula)
                        <tr id="matricula-{{ $matricula->id }}">
                            <td>{{ $matricula->programaEducativo->programa_educativo }}</td>
                            <td>{{ $matricula->fechaCorte->fecha }}</td>
                            <td>{{ $matricula->motriz }}</td>
                            <td>{{ $matricula->visual }}</td>
                            <td>{{ $matricula->auditiva }}</td>
                            <td>{{ $matricula->cognitiva }}</td>
                            <td>{{ $matricula->transtorno_conducta }}</td>
                            <td>{{ $matricula->otros }}</td>
                            <td>{{ $matricula->total }}</td>
                            <td class="estado">
                                {{ $matricula->status == 1 ? 'Activo' : 'Inactivo' }}
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('matricula.inclusion.edit', $matricula->id) }}" class="btn btn-warning me-2 btn-sm">Editar</a>
                                <button class="btn toggle-status btn-sm {{ $matricula->status == 1 ? 'btn-danger' : 'btn-success' }}" data-id="{{ $matricula->id }}">
                                    {{ $matricula->status == 1 ? 'Deshabilitar' : 'Habilitar' }}
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#matriculasTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });

        // Confirmación de SweetAlert al cambiar el estado de una matrícula
        $('.toggle-status').on('click', function(e) {
            e.preventDefault();
            const matriculaId = $(this).data('id');
            const row = $('#matricula-' + matriculaId);
            const statusCell = row.find('.estado');
            const button = $(this);

            Swal.fire({
                title: 'Confirmar acción',
                text: `¿Estás seguro de que deseas cambiar el estado de la matrícula?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/matricula/inclusion/${matriculaId}/toggle-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Hubo un problema al cambiar el estado de la matrícula');
                            }
                            return response.json();
                        })
                        .then(data => {
                            statusCell.text(data.status == 1 ? 'Activo' : 'Inactivo');
                            button.text(data.status == 1 ? 'Deshabilitar' : 'Habilitar');
                            button.toggleClass('btn-danger btn-success');
                            Swal.fire({
                                title: 'Estado cambiado',
                                text: `La matrícula ahora está ${data.status == 1 ? 'activa' : 'inactiva'}`,
                                icon: 'success'
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Hubo un problema al cambiar el estado de la matrícula',
                                icon: 'error'
                            });
                        });
                }
            });
        });
    });
</script>

@endsection
