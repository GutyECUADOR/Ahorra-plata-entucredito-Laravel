<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
  
   

    <div class="container-fluid">
        <div class="row">
            <x-sidebar-menu></x-sidebar-menu>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Registrar pago para usuario: {{ $user->nickname}}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                    
                            <a href="{{ route('users-list')}}" class="btn btn-sm btn-outline-primary">
                                <span data-feather="corner-down-left"></span>
                                    Regresar a la lista
                            </a>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('pagos.update', $user) }}">
                                @csrf
                                
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <div class="form-floating mb-3">
                                    <input type="date" name="fecha_pago" value="{{ date('Y-m-d'); }}" class="form-control" id="fecha_pago" required>
                                    <label for="fecha_pago">Fecha Pago</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="number" name="monto" value="0" step="0.0" class="form-control" id="monto" required>
                                    <label for="monto">Monto de pago</label>
                                </div>

                                <div class="d-grid gap-2">
                                    <button class="btn-block btn btn-lg btn-primary" type="submit">Registrar Pago</button>
                                </div>
                
                            </form>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <p>Total comisión ganada: ${{ $user->ComisionGanada }}</p> 
                                    <p>Total 10% de equipos: ${{ $user->ComisionGanadaMenorEquipo }}</p> 
                                    <p>Total: <span class="text-success">${{ $user->ComisionGanada + $user->ComisionGanadaMenorEquipo }}</span></p> 
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm table-hover">
                                          <thead>
                                            <tr>
                                              <th scope="col">Fecha</th>
                                              <th scope="col">Cantidad</th>
                                              
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach ($user->PagosRecibidos as $pago)
                                              <tr>
                                                <td>{{ $pago->fecha_pago }}</td>
                                                <td>{{ $pago->monto }}</td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    Total Pagado: $ <span class="text-success">{{ $user->PagosRecibidos->sum('monto')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </main>

            
        </div>
    </div>
       
    
</x-app-layout>
