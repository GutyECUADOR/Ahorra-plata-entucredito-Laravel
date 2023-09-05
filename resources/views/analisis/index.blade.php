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

            <div class="main" id="app">
                <input class="form-control" type="hidden" name="hiddenCreditoID" id="hiddenCreditoID" value="{{$credito->id}}">

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
                                    <img src="{{ asset('assets_admin/img/avatars/no-user-image.gif') }}"
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
                            <h1 class="h3 mb-3"><strong>Analisis de Crédito</strong> {{ $credito->id}}</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <a href="{{route('dashboard')}}" class="btn btn-primary">
									 Regresar
                                </a>
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
                                    <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th class="d-none d-xl-table-cell">Meses</th>
                                                <th class="d-none d-xl-table-cell">Cuotas</th>
                                                <th class="d-none d-md-table-cell">Abono a Interes</th>
                                                <th class="d-none d-md-table-cell">Abono a Capital</th>
                                                <th class="d-none d-md-table-cell">Saldo</th>
                                                <th class="d-none d-md-table-cell">Abono extra a capital</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="fila in tablaAmortizacion">
                                                <td>@{{ fila.mes }}</td>
                                                <td>@{{ fila.cuota }}</td>
                                                <td>@{{ fila.ainteres }}</td>
                                                <td>@{{ fila.acapital }}</td>
                                                <td>@{{ fila.capital }}</td>





                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
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
