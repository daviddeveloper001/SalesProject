@extends('layouts.template.app')

@section('title', 'Editar Producto')
@section('content')
    <div class="card shadow mt-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Producto</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('products.index') }}" class="btn btn-success">Regresar</a>
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

            <form action="{{ route('products.update', $product) }}" method="POST" id="update-product-form">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del Producto:</label>
                    <input type="text" id="name" name="name" class="form-control"
                        placeholder="Nombre del Producto" required value="{{ old('name', $product->name) }}">
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="price">Precio:</label>
                    <input type="number" id="price" name="price" class="form-control"
                        placeholder="Precio del Producto" required value="{{ old('price', $product->price) }}">
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

                <button type="submit" class="btn btn btn-primary">Actualizar</button>

            </form>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $('#update-product-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('products.update', $product) }}',
                method: 'PUT',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success) {
                        $('#product-list').append(`<div>${data.product.name}</div>`);
                        $('#update-product-form')[0].reset();
                        alert("Producto actualizado exitosamente.");
                        window.location.href = "{{ route('products.index') }}";
                    }
                },
                error: function(xhr) {
                    console.log("Error:", xhr);
                }
            });
        });
    </script>
@endpush
