@extends('layouts.template.app')

@section('title', 'Registos Ventas de Productos')

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
                    <table class="table align-items-center table-flush" id="saleItems-table">
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

                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-4" id="pagination-sales-items">
                    {{ $saleItems->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
