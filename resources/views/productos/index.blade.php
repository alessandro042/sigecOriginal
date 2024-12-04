@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold text-primary" style="color: #012553;">Gestión de Productos</h1>
        <button class="btn text-white shadow-sm px-4" style="background-color: #012553; border: none;" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="bi bi-plus-circle"></i> Agregar Producto
        </button>
    </div>

    <div class="card shadow rounded-4 border-0">
        <div class="card-header text-white rounded-top-4" style="background-color: #012553;">
            <h5 class="mb-0">Listado de Productos</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle text-center" style="border: 1px solid #ddd;">
                <thead style="background-color: #012553; color: #fff;">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>${{ $producto->precio }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->proveedor->nombre }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm text-white shadow-sm" style="background-color: #01427E;" data-bs-toggle="modal" data-bs-target="#editProviderModal-{{ $producto->id }}">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm text-white shadow-sm" style="background-color: #8B0000;">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade custom-modal" id="editProviderModal-{{ $producto->id }}" tabindex="-1" aria-labelledby="editProviderModalLabel-{{ $producto->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg border-0 rounded-4">
                                    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header text-white rounded-top-4" style="background-color: #01427E;">
                                            <h5 class="modal-title" id="editProviderModalLabel-{{ $producto->id }}">Editar producto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nombre-{{ $producto->id }}" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre-{{ $producto->id }}" name="nombre" value="{{ $producto->nombre }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telefono-{{ $producto->id }}" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="descripcion-{{ $producto->id }}" name="descripcion" rows="3" required>{{ $producto->descripcion }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="precio-{{ $producto->id }}" class="form-label">Precio</label>
                                                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ $producto->precio }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="stock-{{ $producto->id }}" class="form-label">Stock</label>
                                                <input type="number" class="form-control" id="stock" name="stock" value="{{ $producto->stock }}" required>
                                            </div>
                                            <div class="mb-3">
                                            <label for="id_proveedor">Proveedor</label>
                                            <select class="form-control" id="id_proveedor" name="id_proveedor" required>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}" {{ $proveedor->id == $producto->id_proveedor ? 'selected' : '' }}>
                                                    {{ $proveedor->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
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

<div class="modal fade custom-modal" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                <div class="modal-header text-white rounded-top-4" style="background-color: #012553;">
                    <h5 class="modal-title" id="addProductModalLabel">Agregar Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>            
                    </div>
                    <div class="mb-3">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="mb-3">
                    <label for="id_proveedor">Proveedor</label>
                            <select class="form-control" id="id_proveedor" name="id_proveedor" required>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
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
