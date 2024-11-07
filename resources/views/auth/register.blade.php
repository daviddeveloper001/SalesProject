@extends('auth.login-register')

@section('title', 'Registrate')
@section('title-page', 'Registrate')
<?php
use Spatie\Permission\Models\Role;
$roles = Role::whereNot('name', 'auxiliar de bodega')->get();

?>
@section('content')
    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    @include('auth.partials.card-header')
                    <div class="card-body px-lg-5 py-lg-5">
                        @include('auth.partials.error-notification')
                        <form role="form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Nombre" type="text" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Correo electrónico" type="email"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Contraseña" type="password" name="password"
                                        required autocomplete="new-password">
                                </div>
                            </div>
                            {{-- Confirmation Password --}}
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Repetir Contraseña" type="password"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect1" name="role">
                                    <option>Seleeciona un rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Registrarse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
