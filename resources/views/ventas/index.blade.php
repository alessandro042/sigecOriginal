@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold text-primary" style="color: #012553;">Listado de Ventas</h1>
        <button
            class="btn text-white shadow-sm px-4"
            style="background-color: #012553; border: none;"
            onclick="window.location.href='{{ route('ventas.create') }}'">
            <i class="bi bi-plus-circle"></i> Nueva Venta
        </button>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <label for="startDate" class="form-label">Desde:</label>
            <input type="date" id="startDate" class="form-control" placeholder="Desde">
        </div>
        <div class="col-md-6 mb-3">
            <label for="endDate" class="form-label">Hasta:</label>
            <input type="date" id="endDate" class="form-control" placeholder="Hasta">
        </div>
    </div>

    <div class="card shadow rounded-4 border-0">
        <div class="card-header text-white rounded-top-4" style="background-color: #012553;">
            <h5 class="mb-0">Listado de Ventas</h5>
        </div>
        <div class="table-responsive">
            <table id="ventasTable" class="table table-hover align-middle text-center" style="border: 1px solid #ddd;">
                <thead style="background-color: #012553; color: #fff;">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->usuario->nombre_completo }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->fecha_venta }}</td>
                    <td>
                        <div class="d-flex justify-content-center align-items-baseline" role="group" aria-label="Acciones">
                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-dark btn-sm" style="margin-right: 10px;">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            <button class="btn btn-sm text-white shadow-sm" style="background-color: #01427E; margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#editModal"
                                    onclick="loadVentaEdit({{ $venta }}, {{ $productos }})">
                                <i class="bi bi-pencil-square"></i> Editar
                            </button>
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta venta?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm text-white shadow-sm" style="background-color: #8B0000; flex: 1;">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div id="editModalBody"></div>

                    <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Inicializa DataTables
        var table = $('#ventasTable').DataTable();

        // Filtro por rango de fechas
        $('#startDate, #endDate').on('change', function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            // Filtra la columna de fecha entre las dos fechas
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var date = new Date(data[3]); // La fecha está en la cuarta columna
                    return (startDate === '' || date >= new Date(startDate)) &&
                           (endDate === '' || date <= new Date(endDate));
                }
            );

            // Redibuja la tabla
            table.draw();
        });
    });

    // Función para cargar los datos en el modal de edición
    function loadVentaEdit(venta, productos) {
        let modalBody = document.getElementById('editModalBody');
        let form = document.getElementById('editForm');
        form.action = `/ventas/${venta.id}`;

        modalBody.innerHTML = `
            <input type="hidden" name="id_usuario" value="${venta.id_usuario}">
            ${productos.map(producto => `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="productos[${producto.id}][id]" value="${producto.id}"
                           id="producto-${producto.id}" ${venta.productos.some(vp => vp.id === producto.id) ? 'checked' : ''}>
                    <label class="form-check-label" for="producto-${producto.id}">
                        ${producto.nombre} - $${producto.precio} (Stock: ${producto.stock})
                    </label>
                    <input type="number" class="form-control mt-1" name="productos[${producto.id}][cantidad]"
                           value="${venta.productos.find(vp => vp.id === producto.id)?.pivot?.cantidad || ''}"
                           min="1" max="${producto.stock}">
                </div>
            `).join('')}
        `;
    }
    document.addEventListener('DOMContentLoaded', function() {
        $('#ventasTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });
    });

</script>
@endsection
