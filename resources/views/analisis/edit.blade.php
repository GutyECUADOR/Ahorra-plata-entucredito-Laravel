<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
  
    <div class="container-fluid">
        <div class="row">
            <x-sidebar-menu></x-sidebar-menu>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Editar: {{ $tipoInversion->nombre}}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                    
                            <a href="{{ route('tipos-inversion.index')}}" class="btn btn-sm btn-outline-primary">
                                <span data-feather="corner-down-left"></span>
                                    Regresar a la lista
                            </a>
                          
                      
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                    <form method="POST" action="{{ route('tipos-inversion.update', $tipoInversion) }}">
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
                            <input type="text" name="nombre" value="{{ $tipoInversion->nombre }}" class="form-control" id="nombre" required autofocus>
                            <label for="nombre">Nombre</label>
                        </div>
    
                        <div class="form-floating mb-3">
                            <input type="number" name="tasa" class="form-control" id="tasa" value="{{ $tipoInversion->tasa }}" min="0.10" step="0.01" required>
                            <label for="tasa">Tasa (Utilidad)</label>
                        </div>
    
                        <div class="form-floating mb-3">
                            <input type="number" name="nivel_ranking" class="form-control" id="nivel_ranking" value="{{ $tipoInversion->nivel_ranking }}" min="1" required>
                            <label for="nivel_ranking">Nivel Ranking</label>
                            <p class="badge bg-warning text-dark">Indique ranking 1 para conceder acceso a este tipo de inversión para todos los usuarios.</p>
                        </div>
    
                        <div class="d-grid gap-2">
                            <button class="btn-block btn btn-lg btn-primary" type="submit">Registrar</button>
                        </div>
        
                    </form>
                        </div>
                    </div>
                </div>
                

            </main>

          
        </div>
    </div>
       
    
</x-app-layout>
