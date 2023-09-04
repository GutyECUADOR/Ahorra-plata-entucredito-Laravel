<x-app-layout>

    <body>
        <div class="wrapper">
            <nav id="sidebar" class="sidebar js-sidebar">
                <div class="sidebar-content js-simplebar">
                    <a class="sidebar-brand" href="index.html">
                        <span class="align-middle">Dashboard</span>
                    </a>

                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Menú
                        </li>

                        <li class="sidebar-item active">
                            <a class="sidebar-link" href="index.html">
                                <i class="align-middle" data-feather="sliders"></i> <span
                                    class="align-middle">Dashboard</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>

            <div class="main">
                <nav class="navbar navbar-expand navbar-light navbar-bg">
                    <a class="sidebar-toggle js-sidebar-toggle">
                        <i class="hamburger align-self-center"></i>
                    </a>

                    <div class="navbar-collapse collapse">
                        <ul class="navbar-nav navbar-align">

                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                    data-bs-toggle="dropdown">
                                    <i class="align-middle" data-feather="settings"></i>
                                </a>

                                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                    data-bs-toggle="dropdown">
                                    <img src="{{ asset('assets_admin/img/avatars/avatar.jpg') }}"
                                        class="avatar img-fluid rounded me-1" alt="Usuario" /> <span
                                        class="text-dark">{{ Str::title(Auth::user()->name) }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                            data-feather="user"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                            data-feather="pie-chart"></i> Analytics</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                                            data-feather="settings"></i> Settings & Privacy</a>
                                    <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                            data-feather="help-circle"></i> Help Center</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            <i class="align-middle me-1" data-feather="log-out"></i>
                                            {{ __('Cerrar Sesión') }}
                                        </a>
                                    </form>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="content">
                    <div class="container-fluid p-0">

                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h3 mb-3"><strong>Mi</strong> Dashboard</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearCreditoModal">
                                    <span data-feather="file"></span>
									 Nuevo Crédito
                                </button>
                            </div>
                        </div>

                         @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <div class="row">
                            <div class="col-12 col-lg-12 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header">

                                        <h5 class="card-title mb-0">últimos créditos</h5>
                                    </div>
                                    <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th class="d-none d-xl-table-cell">Monto del Crédito </th>
                                                <th class="d-none d-xl-table-cell">Cuotas</th>
                                                <th class="d-none d-md-table-cell">Interes</th>
                                                <th class="d-none d-md-table-cell">Fecha</th>
                                                 <th class="d-none d-md-table-cell">Análisis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($creditos as $credito)
                                            <tr>
                                                <td>{{ $credito->nombre }}</td>
                                                <td>{{ $credito->cantidad }}</td>
                                                <td>{{ $credito->cuotas }}</td>
                                                <td>{{ $credito->interes }}</td>
                                                <td>{{ $credito->created_at }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearCreditoModal">
                                                        <span data-feather="bar-chart-2"></span>
                                                        Análisis
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="crearCreditoModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo crédito</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="{{ route('creditos.store') }}">
                                        @csrf

                                        <!-- Name -->
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" id="nombre" required autofocus>
                                            <label for="nombre" class="text-dark">Nombre de Referencia</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="number" name="cantidad" class="form-control" id="cantidad" min="1" step="0.01" required>
                                            <label for="cantidad" class="text-dark">Cantidad (Valor del Crédito)</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="number" name="cuotas" class="form-control" id="cuotas" min="1" step="1" required>
                                            <label for="cuotas" class="text-dark">Cantidad de Cuotas</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="number" name="interes" class="form-control" id="interes" min="1" step="0.01" required>
                                            <label for="interes" class="text-dark">Interes</label>
                                        </div>

                                         <div class="d-grid gap-2">
                                            <button class="btn-block btn btn-lg btn-primary" type="submit">Registrar</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								</div>
                            </div>
                            </div>
                        </div>

                    </div>
                </main>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-start">
                                <p class="mb-0">
                                    <a class="text-muted" href="#"
                                        target="_blank"><strong>Dashboard</strong></a> - <a class="text-muted"
                                        href="#" target="_blank"><strong>Bootstrap Admin Template</strong></a>
                                    &copy;
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="#" target="_blank">Support</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="#" target="_blank">Help Center</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="#" target="_blank">Privacy</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="#" target="_blank">Terms</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="{{ asset('assets_admin/js/app.js') }}"></script>

    </body>
</x-app-layout>
