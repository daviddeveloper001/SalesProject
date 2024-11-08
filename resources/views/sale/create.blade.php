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

            <form action="{{ route('sales.store') }}" method="POST" id="create-sale-form">
                @csrf
                <div class="form-group">
                    <label for="cant">Producto:</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="idProduct">
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

                <button type="submit" class="btn btn btn-primary">Guardar</button>

            </form>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            $('#create-sale-form').on('submit', function(e) {
                e.preventDefault(); // Evitar el envío del formulario normal

                $.ajax({
                    url: $(this).attr('action'), // Usar la acción del formulario
                    method: 'POST',
                    data: $(this).serialize(), // Serializar los datos del formulario
                    success: function(data) {
                        if (data.success) {
                            alert("Venta creada exitosamente.");
                            // Aquí puedes actualizar la tabla de elementos vendidos o limpiar el formulario
                            $('#create-sale-form')[0]
                        .reset(); // Limpiar el formulario si es necesario

                            // Aquí puedes añadir el nuevo ítem vendido a la tabla si lo deseas, por ejemplo:
                            // $('#sale-items-list tbody').append(` ... `); // Agregar el nuevo registro a la tabla de ventas.
                        } else {
                            alert("Ocurrió un error al crear la venta.");
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function(index, value) {
                            alert(value[0]); // Mostrar el primer error de cada campo
                        });
                    }
                });
            });
        });
    </script>
@endpush
