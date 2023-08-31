<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('dashboard')}}">
            <span data-feather="home"></span>
            Dashboard
            </a>
        </li>

        @if(auth()->user()->role == 'ADMIN_ROLE')

        <li class="nav-item">
            <a class="nav-link" href="{{route('users-list')}}">
            <span data-feather="bar-chart-2"></span>
            Lista de usuarios
            </a>
        </li>
       
        @endif

        </ul>

    </div>
</nav>