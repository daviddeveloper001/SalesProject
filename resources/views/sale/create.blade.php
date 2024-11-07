@extends('layouts.template.app')

@section('title', 'Crear Venta')

@section('content')
    <div class="card shadow mt-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Crear Venta</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('sales-items.index') }}" class="btn btn-success">Regresar</a>
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

            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="cant">Producto:</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="product">
                        <option>Selecciona un producto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Cantidad:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control"
                        placeholder="Cantidad del Producto" {{-- value="{{ old('name', $product->name) }}" --}} required>
                    @error('quantity')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="price">Precio:</label>
                    <input type="number" id="price" name="price" class="form-control"
                        placeholder="Precio del Producto" {{-- value="{{ old('name', $product->name) }}" --}} required>
                    @error('price')
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
