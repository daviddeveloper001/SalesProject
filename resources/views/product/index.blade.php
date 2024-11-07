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
                    {{-- <div class="form-group mt-3 row">
                        <div class="col-md-6 ml-auto">
                            <form action="" method="get">
                                <div class="input-group">
                                    <input class="form-control" type="search" placeholder="Buscar Producto"
                                        name="filterValue">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                </div>
                <div class="card-body">
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif
                </div>
                <div class="table-responsive">
                    @if (!empty($products))
                        <table class="table align-items-center table-flush">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">PRECIO</th>
                                        <th scope="col">DESCRIPCIÓN</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                {{ $product->id }}
                                            </td>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                {{ $product->FormatPrice }}
                                            </td>

                                            <td>
                                                {{ $product->FormatDescription }}
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
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection