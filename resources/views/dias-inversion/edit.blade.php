<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
  
    <div class="container-fluid">
        <div class="row">
            <x-sidebar-menu></x-sidebar-menu>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Editar: {{ $diasInversion->nombre}}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                    
                            <a href="{{ route('dias-inversion.index')}}" class="btn btn-sm btn-outline-primary">
                                <span data-feather="corner-down-left"></span>
                                    Regresar a la lista
                            </a>
                          
                      
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                    <form method="POST" action="{{ route('dias-inversion.update', $diasInversion) }}">
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
                            <input type="text" name="nombre" value="{{ $diasInversion->nombre }}" class="form-control" id="nombre" required autofocus>
                            <label for="nombre">Nombre</label>
                        </div>
    
                        <div class="form-floating mb-3">
                            <input type="number" name="dias" class="form-control" id="dias" value="{{ $diasInversion->dias }}" min="1" step="1" required>
                            <label for="dias">Dias</label>
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
