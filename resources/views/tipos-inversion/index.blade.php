<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
  
    <div class="container-fluid">
        <div class="row">
            <x-sidebar-menu></x-sidebar-menu>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Lista de Tasas (Tipos de inversion)</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span data-feather="user"></span>
                            Crear nuevo tipo de inversion
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


                <div class="table-responsive">
                    <table class="table table-hover table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Tasa (% de Utilidad)</th>
                            <th scope="col">Ranking</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipo_inversions as $tipo_inversion)
                                <tr>
                                    <td>{{ $tipo_inversion->id }}</td>
                                    <td>{{ $tipo_inversion->nombre }}</td>
                                    <td>{{ $tipo_inversion->tasa }}</td>
                                    <td>{{ $tipo_inversion->nivel_ranking }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('tipos-inversion.edit', $tipo_inversion->id)}}" class="btn btn-sm btn-primary">
                                                <span data-feather="edit"></span>
                                                Editar
                                            </a>
                                            <form method="POST" action="{{ route('tipos-inversion.destroy', $tipo_inversion->id)}}">
                                                @method('delete')
                                                @csrf
    
                                                <a class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault();
                                                                if (window.confirm('Confirma eliminar registro?')) {
                                                                    this.closest('form').submit();
                                                                }">
                                                        <span data-feather="trash"></span>
                                                        Eliminar
                                                </a>
                                            </form>
                                          </div>
                                       
                                    
                                    </td>
                                </tr>
                            @endforeach
                       
                        </tbody>
                    </table>
                </div>

            </main>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo tipo de Inversion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       
                        <form method="POST" action="{{ route('tipos-inversion.store') }}">
                            @csrf
            
                            <!-- Name -->
                            <div class="form-floating mb-3">
                                <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" id="nombre" required autofocus>
                                <label for="nombre">Nombre</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" name="tasa" class="form-control" id="tasa" value="0.80" min="0.10" step="0.01" required>
                                <label for="tasa">Tasa (Utilidad)</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" name="nivel_ranking" class="form-control" id="nivel_ranking" value="1" min="1" required>
                                <label for="nivel_ranking">Nivel Ranking</label>
                                <p class="badge bg-warning text-dark">Indique ranking 1 para conceder acceso a este tipo de inversión para todos los usuarios.</p>
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
    </div>
       
    
</x-app-layout>
