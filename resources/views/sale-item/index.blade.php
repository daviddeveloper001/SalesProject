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
                    @if (!empty($saleItems))
                        <table class="table align-items-center table-flush">
                            <table class="table align-items-center table-flush">
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
                                        <tr>
                                            <td>
                                                {{ $saleItem->id }}
                                            </td>
                                            <td>
                                                {{ $saleItem->product->name }}
                                            </td>
                                            <td>
                                                {{ $saleItem->sale->FormattedPrice }}
                                            </td>

                                            <td>
                                                {{ $saleItem->product->FormatDescription }}
                                            </td>

                                            <td>
                                                {{ $saleItem->quantity }}
                                            </td>

                                            <td>
                                                {{ $saleItem->created_at }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">



                                                    <form class="delete-form" action="{{-- {{ $routeDestroy }} --}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-delete"
                                                            title="Eliminar"><i class="fas fa-trash"></i></button>

                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center;">No se encontraron registros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </table>
                    @else
                        <div class="py-5 text-center">
                            <img src="{{ asset('img/not-result.jpg') }}" alt="No hay registros" style="width:250px;">
                            <p class="text-muted">No hay registros en la base de datos</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer py-4">
                    {{ $saleItems->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
