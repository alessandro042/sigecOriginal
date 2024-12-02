@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold text-primary" style="color: #012553;">Listado de Ventas</h1>
        <button class="btn text-white shadow-sm px-4" style="background-color: #012553; border: none;">
            <a href="{{ route('ventas.create') }}" class="bi bi-plus-circle">Nueva Venta</a>
        </button>
    </div>

    <div class="mb-3">
        <label for="startDate" class="form-label">Desde:</label>
        <input type="date" id="startDate" class="form-control" placeholder="Desde">
    </div>
    <div class="mb-3">
        <label for="endDate" class="form-label">Hasta:</label>
        <input type="date" id="endDate" class="form-control" placeholder="Hasta">
    </div>

    <table id="ventasTable" class="table table-bordered">
        <thead>
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
                        <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                        onclick="loadVentaEdit({{ $venta }}, {{ $productos }})">Editar</button>
                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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

                    <!-- Dinámicamente rellenado con JavaScript -->
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
</script>
@endsection
