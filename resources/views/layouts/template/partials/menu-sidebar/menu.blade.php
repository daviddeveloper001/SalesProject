@role('admin')
    <h6 class="navbar-heading text-muted">Gestión</h6>
    <ul class="navbar-nav">
        @include('layouts.template.partials.menu-sidebar.admin')
    </ul>
@else
    <h6 class="navbar-heading text-muted">Menú</h6>
    @role('doctor')
        <ul class="navbar-nav">
            @include('layouts.template.partials.menu-sidebar.doctor')
        </ul>
    @else
        @role('patient')
            <ul class="navbar-nav">
                @include('layouts.template.partials.menu-sidebar.patient')
            </ul>
        @endrole
    @endrole
@endrole
