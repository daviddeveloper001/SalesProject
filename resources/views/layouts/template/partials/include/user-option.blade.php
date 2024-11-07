<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
    <div class=" dropdown-header noti-title">
        <h6 class="text-overflow m-0">Bienvenidos!</h6>
    </div>

    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
        <i class="ni ni-user-run"></i>
        <span>Cerrar sesión</span>
        <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
            @csrf
        </form>
    </a>
</div>
