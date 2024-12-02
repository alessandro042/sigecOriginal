@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Nueva Venta</h1>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Regresar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('ventas.store') }}" method="POST" id="venta-form">
                @csrf
            
                <div class="mb-4">
                    <label for="id_usuario" class="form-label fw-bold">Usuario</label>
                    <input type="text" id="id_usuario" class="form-control" name="id_usuario" value="{{ auth()->user()->id }}" readonly>
                </div>

                
                <div class="mb-4">
                    <h5 class="mb-3">Productos Disponibles</h5>
                    <table id="productos-table" class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td>
                                    <input type="checkbox" name="productos[{{ $loop->index }}][id]" value="{{ $producto->id }}" class="form-check-input me-2">
                                    {{ $producto->nombre }}
                                </td>
                                <td>${{ $producto->precio }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>
                                    <input type="number" name="productos[{{ $loop->index }}][cantidad]" class="form-control" min="1" max="{{ $producto->stock }}" placeholder="Cantidad" disabled>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="total" class="form-label fw-bold">Total de la Venta</label>
                        <input type="text" id="total" class="form-control" value="$0.00" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="pago" class="form-label fw-bold">Pago del Cliente</label>
                        <input type="number" id="pago" name="pago" class="form-control" placeholder="Cantidad pagada" min="0" step="0.01">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="cambio" class="form-label fw-bold">Cambio</label>
                    <input type="text" id="cambio" class="form-control" value="$0.00" readonly>
                </div>

         
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Guardar Venta
                    </button>
                    <button type="button" class="btn btn-success" id="pagar-con-tarjeta">
                        <i class="bi bi-credit-card"></i> Pago con Tarjeta
                    </button>
                    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .table-active {
        background-color: #f5f5f5;
    }
</style>
<script>
    $(document).ready(function () {
        $('#productos-table').DataTable({
            paging: false,
            searching: true,
            info: false,
        });

        
        $('#productos-table tbody').on('click', 'tr', function (e) {
            if ($(e.target).is('input[type="number"]')) return;

            const checkbox = $(this).find('input[type="checkbox"]');
            const cantidadInput = $(this).find('input[type="number"]');
        
            checkbox.prop('checked', !checkbox.prop('checked'));
            cantidadInput.prop('disabled', !checkbox.prop('checked'));
            cantidadInput.val(checkbox.prop('checked') ? 1 : ''); 
            updateTotal();

            $(this).toggleClass('table-active', checkbox.prop('checked'));
        });

        $('#productos-table').on('input', 'input[type="number"]', updateTotal);

        $('#pago').on('input', function () {
            const total = parseFloat($('#total').val().replace('$', '')) || 0;
            const pago = parseFloat($(this).val()) || 0;
            const cambio = Math.max(0, pago - total);
            $('#cambio').val(`$${cambio.toFixed(2)}`);
        });

        function updateTotal() {
            let total = 0;
            $('#productos-table tbody tr').each(function () {
                const checkbox = $(this).find('input[type="checkbox"]');
                const cantidadInput = $(this).find('input[type="number"]');

                if (checkbox.prop('checked')) {
                    const precio = parseFloat($(this).find('td:nth-child(2)').text().replace('$', '')) || 0;
                    const cantidad = parseInt(cantidadInput.val()) || 0;
                    total += precio * cantidad;
                }
            });
            $('#total').val(`$${total.toFixed(2)}`);
        }
    });

    $(document).ready(function () {
        $('#pagar-con-tarjeta').on('click', function () {
            const total = parseFloat($('#total').val().replace('$', '')) || 0;

            if (total <= 0) {
                Swal.fire('Error', 'El total debe ser mayor que $0.00 para realizar el pago.', 'error');
                return;
            }
            Swal.fire({
                title: 'Procesando pago...',
                html: 'Por favor, espere.',
                allowOutsideClick: false,
                onOpen: () => {
                    Swal.showLoading();
                }
            });
            setTimeout(() => {
                Swal.fire({
                    title: 'Pago exitoso!',
                    text: 'El pago ha sido procesado correctamente.',
                    icon: 'success'
                });
            }, 2000); //2s
        });
      
    });

    $('#venta-form').on('submit', function (e) {
            e.preventDefault(); 
            const productosSeleccionados = $('input[type="checkbox"]:checked');
            if (productosSeleccionados.length === 0) {
                Swal.fire('Error', 'Debe seleccionar al menos un producto para realizar la venta.', 'error');
                return;
            }
            Swal.fire({
                title: 'Venta guardada!',
                text: 'La venta se ha registrado correctamente.',
                icon: 'success'
            }).then(() => {
                this.submit();
            });
        });

</script>



@endsection
