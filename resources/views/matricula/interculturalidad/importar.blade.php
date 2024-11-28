@extends('layouts.app')

@section('title', 'Subir Archivo Excel')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white text-center py-4" style="background-color: #083b5d;">
                    <h4 class="mb-0"><i class="fas fa-file-excel"></i> Subir Archivo Excel</h4>
                </div>
                <div class="card-body p-5">
                    <div class="mb-4 text-center">
                        <p class="lead">Para facilitar el proceso de llenado, puedes descargar la plantilla de Excel con las cabeceras predefinidas y la información complementaria. Esta plantilla está diseñada para ayudarte a colocar los datos correctos en las columnas correspondientes.</p>
                        <a href="{{ route('matricula.interculturalidad.generate.excel') }}" class="btn btn-lg btn-secondary text-white shadow-sm">
                            <i class="fas fa-file-download"></i> Descargar Plantilla Excel
                        </a>
                    </div>

                    <form action="{{ route('matricula.interculturalidad.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="alert alert-info text-left">
                            <h5>Instrucciones importantes:</h5>
                            <ul class="mb-0">
                                <li>No alteres el formato del layout (bordes, color de fondo, alineación del texto).</li>
                                <li>No cambies el formato de datos (moneda, porcentaje, fechas, número con decimales).</li>
                                <li>No agregues tipos de datos distintos a los establecidos (texto en datos numéricos, porcentajes en fechas, etc.).</li>
                                <li>No agregues texto en celdas cuya columna no tenga cabecera.</li>
                                <li>No pegues datos desde otro Excel con otros formatos.</li>
                                <li>No cambies la posición de la cabecera de datos.</li>
                                <li>No cambies el orden de las columnas.</li>
                                <li>No cambies el nombre de las hojas.</li>
                            </ul>
                            <p class="mt-3">Lo que sí puedes hacer:</p>
                            <ul>
                                <li>Cambiar el ancho de las columnas.</li>
                                <li>Cambiar el nombre del archivo.</li>
                            </ul>
                        </div>

                        <div class="form-group mb-4 text-center">
                            <label for="file" class="form-label font-weight-bold">Selecciona un archivo Excel:</label>
                            <input type="file" name="file" class="form-control-file p-2 border rounded bg-light" id="file" accept=".xlsx, .xls" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg btn-block shadow-sm">
                                <i class="fas fa-upload"></i> Subir Archivo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Importación completada',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
    });
</script>
@endif

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al procesar el archivo. Por favor, intenta nuevamente.',
            showConfirmButton: false,
            timer: 3000
        });
    });
</script>
@endif
@endsection
