@extends('layouts.app')

@section('title', 'Matrícula Igualdad')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-4 mb-4">Matrícula Igualdad</h1>
            <p class="lead mb-4">La igualdad de género es la idea de que todos los individuos, independientemente de su género,
                deben tener los mismos derechos, oportunidades y trato justo en todos los aspectos de la vida. Implica eliminar
                los estereotipos de género, la discriminación y la desigualdad basada en el género, promoviendo la equidad entre
                hombres y mujeres, así como el respeto y la valoración de todas las identidades de género. Se busca lograr una sociedad
                donde todas las personas tengan las mismas posibilidades de desarrollo y puedan tomar decisiones libres sobre su vida,
                sin limitaciones impuestas por su género.</p>
            <blockquote class="blockquote mb-4">
                <p class="mb-0">"La igualdad es el alma de la libertad; de hecho, no hay libertad sin ella."</p>
                <p class="mb-0">Frances Wright</p>
            </blockquote>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="table-responsive">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('matricula.igualdad-genero.create') }}" class="btn btn-primary">Crear nueva matrícula</a>
                </div>
                <table id="matriculasTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Programa educativo</th>
                            <th scope="col">Fecha de corte</th>
                            <th scope="col">Hombres</th>
                            <th scope="col">Mujeres</th>
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
                            <td>{{ $matricula->hombres }}</td>
                            <td>{{ $matricula->mujeres }}</td>
                            <td>{{ $matricula->otros }}</td>
                            <td>{{ $matricula->total }}</td>
                            <td class="estado">
                                {{ $matricula->status == 1 ? 'Activo' : 'Inactivo' }}
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('matricula.igualdad-genero.edit', $matricula->id) }}" class="btn btn-warning me-2 btn-sm">Editar</a>
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
                    fetch(`/matricula/igualdad-genero/${matriculaId}/toggle-status`, {
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
