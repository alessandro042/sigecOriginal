@extends('layouts.app')

@section('title', 'Matrícula Interculturalidad')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-4 mb-4">Matrícula Interculturalidad</h1>
            <p class="lead mb-4">La interculturalidad se refiere al reconocimiento, respeto y valoración de la diversidad cultural y
                la interacción equitativa entre diferentes culturas. Promueve el diálogo, la convivencia y el intercambio de conocimientos
                y experiencias entre personas de distintas culturas, fomentando la igualdad de derechos y el enriquecimiento mutuo.
                La interculturalidad busca superar la discriminación, los prejuicios y las desigualdades derivadas de las diferencias culturales,
                promoviendo la coexistencia pacífica y el entendimiento entre individuos y comunidades. Implica valorar y preservar las tradiciones,
                prácticas, lenguajes y formas de vida de cada cultura, al mismo tiempo que se promueve la igualdad, la cohesión social y la
                construcción de sociedades más inclusivas y equitativas.</p>
            <blockquote class="blockquote mb-4">
                <p class="mb-0">"La cultura es el proceso por el cual un individuo se convierte en una persona."</p>
                <p class="mb-0">Geert Hofstede</p>
            </blockquote>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <a href="{{ route('matricula.interculturalidad.create') }}" class="btn btn-custom-admin btn-lg mx-2 my-2 shadow-sm">
              Crear
            </a>
            <!-- <a href="{{ route('matricula.interculturalidad.import-form') }}" class="btn btn-custom-upload btn-lg mx-2 my-2 shadow-sm">
                <i class="fas fa-file-upload"></i> Importar
            </a>
            <a href="{{ route('matricula.interculturalidad.generate.excel') }}" class="btn btn-custom-download btn-lg mx-2 my-2 shadow-sm">
                <i class="fas fa-file-download"></i> Exportar
            </a> -->
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="matriculas-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Programa educativo</th>
                            <th scope="col">Fecha de corte</th>
                            <th scope="col">Indígenas</th>
                            <th scope="col">Afroamericanos</th>
                            <th scope="col">Inmigrantes</th>
                            <th scope="col">Otros</th>
                            <th scope="col">Total</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matriculas as $matricula)
                            <tr>
                                <td>{{ $matricula->programaEducativo->programa_educativo }}</td>
                                <td>{{ $matricula->fechaCorte->fecha }}</td>
                                <td>{{ $matricula->indigenas }}</td>
                                <td>{{ $matricula->afroamericanos }}</td>
                                <td>{{ $matricula->imigrantes }}</td>
                                <td>{{ $matricula->otros }}</td>
                                <td>{{ $matricula->total }}</td>
                                <td>
                                    <a href="{{ route('matricula.interculturalidad.edit', $matricula->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
</div>

<!-- DataTables and Bootstrap CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .btn-custom-admin {
        background-color: #193253;
        color: white;
        border: none;
    }
    .btn-custom-admin:hover {
        background-color: #142741;
        color: white;
    }
    .btn-custom-upload {
        background-color: #2196F3;
        color: white;
        border: none;
    }
    .btn-custom-upload:hover {
        background-color: #0b7dda;
        color: white;
    }
    .btn-custom-download {

        background-color: #2f7e32;
        color: white;
        border: none;
    }
    .btn-custom-download:hover {
        background-color: #45A049;
        color: white;
    }
</style>

<script>
    $(document).ready(function() {
        $('#matriculas-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/Spanish.json"
            }
        });

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Importación completada',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
        @endif

        @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al procesar el archivo. Por favor, intenta nuevamente.',
            showConfirmButton: false,
            timer: 3000
        });
        @endif
    });
</script>
@endsection
