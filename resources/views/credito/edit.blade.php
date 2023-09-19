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
                                    {{-- <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                            data-feather="user"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                            data-feather="pie-chart"></i> Analytics</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                                            data-feather="settings"></i> Settings & Privacy</a>
                                    <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                            data-feather="help-circle"></i> Help Center</a>
                                    <div class="dropdown-divider"></div> --}}
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
                            <h1 class="h3 mb-3"><strong>Editar crédito</strong></h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <a href="{{route('dashboard')}}" class="btn btn-primary">
                                    Regresar
                                </a>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-6">

                                <form method="POST" action="{{ route('creditos.update', $credito) }}">
                                    @csrf
                                    @method('PUT')

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />


                                    <!-- Name -->
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nombre" value="{{ $credito->nombre }}" class="form-control" id="nombre" required autofocus>
                                        <label for="nombre" class="text-dark">Nombre de Referencia</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" value="{{ number_format($credito->cantidad) }}" :value="credito_edit.getterCapital()" v-on:keyup="credito_edit.setCapital($event)" class="form-control">
                                        <label for="cantidad" class="text-dark">Cantidad (Valor del Crédito)</label>
                                        <input type="hidden" v-model="credito_edit.capital" name="cantidad" class="form-control" id="cantidad" min="1" step="0.01" required>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" v-model.number="credito_edit.cuotas" name="cuotas" class="form-control" id="cuotas" min="1" step="1" required>
                                        <label for="cuotas" class="text-dark">Cantidad de Cuotas</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" v-model.number="credito_edit.interes"  name="interes" class="form-control" id="interes" min="0.01" step="0.01" required>
                                        <label for="interes" class="text-dark">Interes</label>
                                    </div>

                                        <div class="d-grid gap-2">
                                        <button class="btn-block btn btn-lg btn-primary" type="submit">Actualizar</button>
                                    </div>


                                </form>

                            </div>

                        </div>
                </main>

                {{-- <footer class="footer">
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
                </footer> --}}
            </div>



    </body>
</x-app-layout>
