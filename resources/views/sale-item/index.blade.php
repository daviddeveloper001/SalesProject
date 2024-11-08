@extends('layouts.template.app')

@section('title', 'Ventas')

@section('content')
    <div class="row mt-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col mt-3">
                            <h3 class="mb-0">Registos Ventas de Productos</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('sales.create') }}" class="btn btn-sm btn btn-default">Nueva Venta</a>
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
                    <table class="table align-items-center table-flush" id="sale-items-list">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">DESCRIPCIÓN</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($saleItems as $saleItem)
                                <tr id="sale-item-{{ $saleItem->id }}">
                                    <td>{{ $saleItem->id }}</td>
                                    <td>{{ $saleItem->product->name ?? 'Nombre no disponible' }}</td>
                                    <td>{{ $saleItem->product?->FormatPrice ?? 'Precio no disponible' }}</td>
                                    <td>{{ $saleItem->product?->FormatDescription ?? 'Descripción no disponible' }}</td>
                                    <td>{{ $saleItem->quantity }}</td>
                                    <td>{{ $saleItem->created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                data-id="{{ $saleItem->id }}" title="Eliminar">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center;">No se encontraron registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-4">
                    {{ $saleItems->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            function fetchSaleItems() {
                $.ajax({
                    url: `/sales-items}`,
                    method: 'GET',
                    success: function(data) {
                        $('#sale-items-list tbody').html('');

                        if (data.saleItems.length > 0) {
                            data.saleItems.forEach(item => {
                                $('#sale-items-list tbody').append(`
                                <tr id="sale-item-${item.id}">
                                    <td>${item.id}</td>
                                    <td>${item.product ? item.product.name : 'Nombre no disponible'}</td>
                                    <td>${item.product ? item.product.format_price : 'Precio no disponible'}</td>
                                    <td>${item.product ? item.product.format_description : 'Descripción no disponible'}</td>
                                    <td>${item.quantity}</td>
                                    <td>${item.created_at}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" 
                                                    data-id="${item.id}" 
                                                    title="Eliminar">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            `);
                            });
                        } else {
                            $('#sale-items-list tbody').html(`
                            <tr>
                                <td colspan="7" style="text-align: center;">No se encontraron registros</td>
                            </tr>
                        `);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error al cargar los elementos de venta:', xhr);
                    }
                });
            }


            $(document).on('click', '.btn-delete', function() {
                const saleItemId = $(this).data('id');

                if (confirm('¿Está seguro de que desea eliminar este elemento?')) {
                    $.ajax({
                        url: `/sales-items/${saleItemId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {

                                $(`#sale-item-${saleItemId}`).remove();

                                alert('Elemento eliminado exitosamente');

                                if ($('#sale-items-list tbody tr').length === 0) {
                                    $('#sale-items-list tbody').html(`
                                    <tr>
                                        <td colspan="7" style="text-align: center;">No se encontraron registros</td>
                                    </tr>
                                `);
                                }
                            }
                        },
                        error: function(xhr) {
                            console.error('Error al eliminar el elemento:', xhr);
                            alert('Ocurrió un error al eliminar el elemento');
                        }
                    });
                }
            });

            fetchSaleItems();
        });
    </script>
@endpush
