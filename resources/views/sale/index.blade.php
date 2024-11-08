@extends('layouts.template.app')

@section('title', 'Historial de Ventas')

@section('content')
    <div class="row mt-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col mt-3">
                            <h3 class="mb-0">Historial de Ventas</h3>
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
                    <table class="table align-items-center table-flush" id="sale-list">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">DESCRIPCIÓN</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                                <tr id="sale-item-{{ $sale->id }}">
                                    <td>{{ $sale->id }}</td>
                                    <td>
                                        @foreach ($sale->items as $item)
                                            {{ $item->product->name ?? 'Producto no disponible' }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($sale->items as $item)
                                            {{ $item->product->FormatPrice ?? 'Precio no disponible' }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($sale->items as $item)
                                            {{ $item->product->FormatDescription ?? 'Descripción no disponible' }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($sale->items as $item)
                                            {{ $item->quantity ?? 'Cantidad no disponible' }}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ $sale->FormattedPrice }}</td>
                                    <td>{{ $sale->created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                data-id="{{ $sale->id }}" title="Eliminar"><i class="fas fa-trash"></i>
                                                Eliminar</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center;">No se encontraron registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    {{ $sales->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            // Manejador para eliminar ventas
            $('.btn-delete').on('click', function() {
                const saleId = $(this).data('id');

                if (confirm('¿Está seguro de que desea eliminar esta venta?')) {
                    $.ajax({
                        url: `/sales/${saleId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Eliminar la fila de la tabla
                                $(`#sale-item-${saleId}`).remove();

                                // Mostrar mensaje de éxito
                                alert('Venta eliminada exitosamente');

                                // Si no hay más ventas, mostrar mensaje de "no hay registros"
                                if ($('#sale-list tbody tr').length === 0) {
                                    $('#sale-list tbody').html(`
                                    <tr>
                                        <td colspan="8" style="text-align: center;">No se encontraron registros</td>
                                    </tr>
                                `);
                                }
                            }
                        },
                        error: function(xhr) {
                            console.error('Error al eliminar la venta:', xhr);
                            alert('Ocurrió un error al eliminar la venta');
                        }
                    });
                }
            });
        });
    </script>
@endpush
