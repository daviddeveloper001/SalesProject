@if ($errors->any())
    <div class="text-center text-muted mb-2">
        <h4>Se encontro el siguiente error. </h4>
    </div>

    <div class="alert alert-danger mb-4" role="alert">
        {{ $errors->first() }}
    </div>
@else
    <div class="text-center text-muted mb-4">
        <small>O inicie sesión con sus credenciales </small>
    </div>
@endif
