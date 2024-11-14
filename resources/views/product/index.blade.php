@extends('layouts.template.app')

@section('title', 'Productos')

@section('content')
    <div class="row mt-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col mt-3">
                            <h3 class="mb-0">Productos</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('products.create') }}" class="btn btn-sm btn btn-default">Nuevo Producto</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="product-list">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">DESCRIPCIÓN</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr id="product-{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->FormatPrice }}</td>
                                    <td>{{ $product->FormatDescription }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-primary btn-sm mr-2 rounded" title="Editar"><i
                                                    class="fas fa-edit"></i>Editar</a>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                data-id="{{ $product->id }}" title="Eliminar">
                                                <i class="fas fa-trash"> Eliminar</i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center;">No se encontraron registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-4">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
@push('javascript')
    <script>
        function fetchProducts() {
            $.ajax({
                url: `/products}`,
                method: 'GET',
                success: function(data) {
                    $('#product-list').html('');
                    data.products.data.forEach(product => {
                        $('#product-list').append(`<div>${product.name}</div>`);
                    });
                }
            });
        }

        $(document).ready(function() {
            fetchProducts();
            $('.btn-delete').on('click', function() {
                const productId = $(this).data('id');

                if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
                    $.ajax({
                        url: `/products/${productId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Elimina la fila del producto del DOM
                                $(`#product-${productId}`).remove();
                                alert("Producto eliminado exitosamente.");
                            }
                        },
                        error: function(xhr) {
                            alert("Ocurrió un error al eliminar el producto.");
                        }
                    });
                }
            });
        });
    </script>
@endpush
