<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
  
    <div class="container-fluid">
        <div class="row">
            <x-sidebar-menu></x-sidebar-menu>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Editar inversion: {{ $inversion->id}}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                    
                            <a href="{{ route('dashboard')}}" class="btn btn-sm btn-outline-primary">
                                <span data-feather="corner-down-left"></span>
                                    Regresar a la lista
                            </a>
                          
                      
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                    <form method="POST" action="{{ route('inversions.update', $inversion) }}">
                        @csrf
                        @method('PUT')
                        
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
        
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                        <!-- Estado -->
                        <div class="form mb-3">
                            <label for="estado">Estado</label>
                            <select name="estado" class="form-control form-control-sm"  {{ $inversion->estado == 'aprobada' ? 'disabled' : '' }}>
                                <option value="cancelada" {{ $inversion->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                <option value="pendiente" {{ $inversion->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="aprobada" {{ $inversion->estado == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                                <option value="pagada" {{ $inversion->estado == 'pagada' ? 'selected' : '' }}>Pagada</option>
                            </select>
                        </div>

                        
                        <!-- Fecha Inversion -->
                        <div class="form-floating mb-3">
                            <input type="date" name="fecha_inversion" value="{{ $inversion->fecha_inversion }}" class="form-control" id="fecha_inversion" required autofocus  {{ $inversion->estado == 'aprobada' ? 'disabled' : '' }}>
                            <label for="fecha_inversion">Fecha Inversion</label>
                        </div>

                        <!-- Monto -->
                        <div class="form-floating mb-3">
                            <input type="number" name="monto" value="{{ intval($inversion->monto) }}" class="form-control" id="monto" required>
                            <label for="monto">Monto invertido</label>
                        </div>

                        <!-- Tasa -->
                        <div class="form-floating mb-3">
                            <input type="number" name="tasa" value="{{ $inversion->tasa }}" class="form-control" id="tasa" required>
                            <label for="tasa">Tasa</label>
                        </div>


                        <!-- Dias Inversion -->
                        <div class="form-floating mb-3">
                            <input type="number" name="dias_inversion" value="{{ $inversion->dias_inversion }}" class="form-control" id="dias_inversion" required>
                            <label for="dias_inversion">Dias Inversion</label>
                        </div>

                        

                        <!-- Estado -->
                        <div class="form-floating mb-3">
                            <input type="text" name="observacion" value="{{ $inversion->observacion }}" class="form-control" id="nombre" required autofocus>
                            <label for="observacion">Observacion</label>
                        </div>
    
                      
                        <div class="d-grid gap-2">
                            <button class="btn-block btn btn-lg btn-primary" type="submit">Actualizar</button>
                        </div>
        
                    </form>
                        </div>
                    </div>
                </div>
                

            </main>

          
        </div>
    </div>
       
    
</x-app-layout>
