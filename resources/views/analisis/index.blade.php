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
                            <h1 class="h3 mb-3"><strong>Analisis de Crédito</strong> {{ $credito->id}}</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#abonoExtraModal">Agregar abono a capital</a>
                                    <a href="#" class="btn btn-info" v-on:click="guardarAnalisis">Guardar analisis</a>
                                    <a href="{{route('dashboard')}}" class="btn btn-primary">
                                        Regresar
                                    </a>
                                 </div>
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
                            <div class="col-12 col-md-9 d-flex">
                                <div class="card flex-fill table-responsive">
                                    <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th class="d-none d-xl-table-cell">Meses</th>
                                                <th class="d-none d-xl-table-cell">Cuotas</th>
                                                <th class="d-none d-md-table-cell">Abono a Interes</th>
                                                <th class="d-none d-md-table-cell">Abono a Capital</th>
                                                <th class="d-none d-md-table-cell">Saldo</th>
                                                <th class="d-none d-md-table-cell" style="min-width:150px">Abono extra a capital</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="fila in tablaAmortizacion">
                                                <td>@{{ fila.mes.toFixed(0) }}</td>
                                                <td>@{{ fila.getCuota().toFixed(0) | numberWithCommas }}</td>
                                                <td>@{{ fila.getAinteres().toFixed(0) | checkPositiveValue | numberWithCommas }}</td>
                                                <td>@{{ fila.getAcapital().toFixed(0) | checkPositiveValue | numberWithCommas }}</td>
                                                <td>@{{ fila.capital.toFixed(0) | checkPositiveValue | numberWithCommas }}</td>
                                                <td v-if="fila.mes !=0 ">
                                                    <input type="text" :value="fila.getExtraCapital()" v-on:keyup="fila.setExtraCapital($event)" class="form-control text-center input-sm" v-on:change="reGenerateTable">
                                                </td>




                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        Crédito Actual
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Saldo a capital</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">$ @{{ totalCreditoInicial.toFixed(0) | numberWithCommas}}</h1>
                                        </div>

                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Saldo a Intereses</h5>
                                            </div>
                                            <h1 class="mt-1 mb-3">$ @{{ (pagoTotalCredito- totalCreditoInicial).toFixed(0) | numberWithCommas}}</h1>
                                        </div>

                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Total a pagar por tu crédito</h5>
                                            </div>

                                            <h1 class="mt-1 mb-3">$ @{{ pagoTotalCredito.toFixed(0) | numberWithCommas}}</h1>
                                        </div>

                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        Crédito despúes de abono a capital
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Saldo a capital</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">$ @{{ totalCapitalCreditoMenosAbonos.toFixed(0) | numberWithCommas}}</h1>
                                        </div>
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Saldo a Intereses</h5>
                                            </div>
                                            <h1 class="mt-1 mb-3">$ @{{ totalInteresCreditoMenosAbonos.toFixed(0) | numberWithCommas}}</h1>
                                        </div>
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Total a pagar despúes de abono a capital </h5>
                                            </div>

                                        </div>
                                        <h1 class="mt-1 mb-3">$ @{{ pagoTotalCreditoMenosAbonos.toFixed(0) | numberWithCommas}}</h1>

                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                       Ahorro Generado
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Ahorro</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">$ @{{ahorroEstimado.toFixed(0) | numberWithCommas}}</h1>
                                        </div>
                                        <div class="mb-0">
                                            <span class="text-primary h3"> <i class="mdi mdi-arrow-bottom-right"></i> @{{ cuotas_ahorradas.toFixed(2) }} </span>
                                            <span class="text-muted h3">años ahorrados</span>
                                        </div>
                                        <div class="mb-0">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> @{{ ahorroEstimadoPorcent.toFixed(2) | numberWithCommas }}% </span>
                                            <span class="text-muted">de ahorro estimado</span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </main>

                <!-- Modal -->
                <div class="modal fade" id="abonoExtraModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aplicar Abono extra a capital a todas las cuotas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="form-floating mb-3">
                                <input type="number" v-model.number="cuotaInicio"  name="cuotaInicio" class="form-control" id="cuotaInicio" min="1" step="1" required>
                                <label for="cuotaInicio" class="text-dark">Desde la couta</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" v-model.number="cuotaFin"  name="cuotaFin" class="form-control" id="cuotaFin" min="1" step="1" required>
                                <label for="cuotaFin" class="text-dark">Hasta la cuota </label>
                            </div>


                            <div class="form-floating mb-3">
                                <input type="text" :value="aextracapitalAll.getExtraCapital()" v-on:keyup="aextracapitalAll.setExtraCapital($event)" name="cuotas" class="form-control" id="cuotas" min="1" step="1" required>
                                <label for="cuotas" class="text-dark">Cantidad de abono a capital</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn-block btn btn-lg btn-primary" v-on:click="aplicarAbonoAll" type="button">Aplicar abono a capital</button>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn-block btn btn-lg btn-danger" v-on:click="resetAplicarAbonoAll" type="button">Remover todos los abonos a capital</button>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    </div>
                </div>

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

    </body>
</x-app-layout>
