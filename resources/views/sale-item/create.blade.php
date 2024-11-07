@extends('layouts.template.app')
@section('title', 'Hisotrial de Ventas')
@section('content')
    <div class="card shadow mt-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Crear Venta</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('sales.index') }}" class="btn btn-success">Regresar</a>
                    <i class="fas fa-chevron-left"></i>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Por favor</strong>{{ $error }}
                    </div>
                @endforeach
            @endif

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del Producto:</label>
                    <input type="text" id="name" name="name" class="form-control"
                        placeholder="Nombre del Producto" value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="name">Precio:</label>
                    <input type="text" id="name" name="name" class="form-control"
                        placeholder="Nombre del Producto" value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Descripción">{{ old('description', $product->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn btn-primary">Guardar</button>

            </form>
        </div>
    </div>
@endsection
