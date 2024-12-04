@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Venta</h1>

    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <input type="number" name="id_usuario" id="id_usuario" class="form-control" value="{{ $venta->id_usuario }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Productos</label>
            <div id="productos">
                @foreach($productos as $producto)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="productos[{{ $loop->index }}][id]" value="{{ $producto->id }}" id="producto-{{ $producto->id }}" 
                               @if($venta->productos->contains($producto)) checked @endif>
                        <label class="form-check-label" for="producto-{{ $producto->id }}">
                            {{ $producto->nombre }} - ${{ $producto->precio }}
                        </label>
                        <input type="number" name="productos[{{ $loop->index }}][cantidad]" placeholder="Cantidad" class="form-control mt-1" 
                               value="{{ $venta->productos->find($producto->id)?->pivot->cantidad }}">
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
