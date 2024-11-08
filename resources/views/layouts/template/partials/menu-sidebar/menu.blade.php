@role('admin')
    <h6 class="navbar-heading text-muted">Gestión</h6>
    <ul class="navbar-nav">
        @include('layouts.template.partials.menu-sidebar.admin')
    </ul>
@else
    <h6 class="navbar-heading text-muted">Menú</h6>
    @role('auxiliar de bodega')
        <ul class="navbar-nav">
            @include('layouts.template.partials.menu-sidebar.auxiliar-de-bodega')
        </ul>
    @else
        @role('vendedor')
            <ul class="navbar-nav">
                @include('layouts.template.partials.menu-sidebar.vendedor')
            </ul>
        @endrole
    @endrole
@endrole
