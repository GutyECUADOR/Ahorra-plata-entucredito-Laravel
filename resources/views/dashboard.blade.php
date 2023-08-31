<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
    
    <div class="container-fluid">
      <div class="row">
        <x-sidebar-menu></x-sidebar-menu>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h3">Datos Personales</h3>
           
          </div>

          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />

          <div class="container text-center">
            <div class="row mb-3">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-header fw-bold">
                    Datos de la cuenta 
                  </div>
                  <div class="card-body">
                    <img src="{{ asset('assets/img/no-user-image.gif') }}" alt="" class="img-fluid rounded-circle" style="max-height: 70px">
                    <h5 id="nickname" class="card-title">{{ Str::title(Auth::user()->nickname) }}</h5>
                    <p class="card-text mb-0">Estado: {{ Auth::user()->EstadoPago }}</p>
                    <p class="card-text mb-0">Cantidad Invitados: {{ Auth::user()->CantidadInvitadosPagados->count() }}</p>
                    <p class="card-text mb-0">Inversión total de Invitados: $ {{ Auth::user()->CantidadInvesionPagada }}</p>
                    <p class="card-text mb-0">Comisión 20% ganada: $ {{ Auth::user()->ComisionGanada }}</p>
                    
                    <button type="button" id="copybutton" onclick="copyText()" class="btn btn-sm btn-success" title="Copiar"><span data-feather="copy"></span>Copiar mi enlace de invitación</button>
                    
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card mb-2">
                  <div class="card-header fw-bold">
                    Comisión Ganada
                  </div>
                  <div class="card-body">
                    <p class="card-text h3 text-success">$ {{ Auth::user()->ComisionGanada }} USDT</p>
                    
                  </div>
                </div>

                <div class="card">
                  <div class="card-header fw-bold">
                    Comprobante
                  </div>
                  <div class="card-body">
                     
                      @if(auth()->user()->imagen_recibo)
                        <a class="btn btn-success btn-sm" href="{{ asset('/storage/recibos/'.auth()->user()->imagen_recibo) }}" download target="_blank">
                        <span data-feather="download"></span> Descargar</a>   
                      @else 
                        <span>Sin Comprobante, carge el comprobante aqui</span>
                      @endif
                  </div>
                   @if(!auth()->user()->imagen_recibo)
                    <div class="card-footer">
                      <form method="POST" enctype="multipart/form-data" action="{{ route('uploadFile') }}">
                        @csrf
                        <input class="form-control form-control-sm" id="imagen_recibo" name="imagen_recibo" type="file" accept="image/*">
                        <button class="btn-block btn btn-sm btn-primary w-100" type="submit">Subir comprobante</button>
                      </form>
                    </div>
                   @endif
                </div>
              </div>

              <div class="col-md-5">
                <div class="card mb-2">
                  <div class="card-header fw-bold">
                    Wallet USDT
                  </div>
                  <div class="card-body">
                      <form method="POST" action="{{ route('uploadWalletUSDT') }}">
                          @csrf
                        <div class="input-group mb-3">
                          <input type="text" name="wallet_usdt" value="{{ Auth::user()->wallet_usdt_tr20 }}" class="form-control" placeholder="Sin wallet - indica aqui tu wallet USDT">
                          <button class="btn btn-sm btn-primary">Actualizar</button>
                        </div>
                      </form>
                  </div>
                </div>

                <div class="card mb-2">
                  <div class="card-header fw-bold">
                    Wallet ALARAB
                  </div>
                <div class="card-body">
                  <form method="POST" action="{{ route('uploadWalletALARAB') }}">
                    @csrf
                    <div class="input-group mb-3">
                      <input type="text" name="wallet_alarab" value="{{ Auth::user()->wallet_alarab }}" class="form-control" placeholder="Sin wallet - indica aqui tu wallet ALARAB">
                      <button class="btn btn-sm btn-primary">Actualizar</button>
                    </div>
                  </form>
                </div>
              </div>

               
              </div>
            </div>

            @if(auth()->user()->CantidadInvitadosPagados->count() >= 2)
            <div class="row">
              <div class="col-md-3">
               <div class="card">
                  <div class="card-header fw-bold">
                    Pagos
                  </div>
                  <div class="card-body">
                    <img src="{{ asset('assets/img/pago.png') }}" alt="" class="img-fluid rounded-circle" style="max-height: 100px">
                   
                    <p class="card-text mb-0">Paga tu paquete con tu USTD atravez de la red TRC20</p>
                   
                    <span class="text-center fw-bold">Wallet</span>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control"  value="TQu8XqRU8H7EfT1q31yLzG5nRAcgc4fwkc" style="font-size: 12px;" readonly>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card">
                  <div class="card-header fw-bold">
                    Equipo 1 - {{ Auth::user()->ListaEquipoA->count() }} invitados
                    <p class="mb-0 text-success">Total Invertido: ${{ Auth::user()->ListaEquipoA->sum('usdt') }}</p>
                  </div>
                  <div class="card-body">
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseEQ1" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Ver detalle
                    </a>
                    <div class="collapse" id="collapseEQ1">
                      <table class="table table-striped table-sm table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Nickname</th>
                            <th scope="col">Inversión</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach (Auth::user()->ListaEquipoA as $user)
                          <tr>
                            <td>{{ $user->nickname }}</td>
                            <td>$ {{ $user->usdt }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card">
                  <div class="card-header fw-bold">
                     Equipo 2 - {{ Auth::user()->ListaEquipoB->count() }} invitados
                     <p class="mb-0 text-success">Total Invertido: ${{ Auth::user()->ListaEquipoB->sum('usdt') }}</p>
                  </div>
                  <div class="card-body">
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseEQ2" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Ver detalle
                    </a>
                    <div class="collapse" id="collapseEQ2">
                      <table class="table table-striped table-sm table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Nickname</th>
                            <th scope="col">Inversión</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach (Auth::user()->ListaEquipoB as $user)
                          <tr>
                            <td>{{ $user->nickname }}</td>
                            <td>$ {{ $user->usdt }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @else
            <div class="row">
              <div class="col-md-3">
               <div class="card">
                  <div class="card-header fw-bold">
                    Pagos
                  </div>
                  <div class="card-body">
                    <img src="{{ asset('assets/img/pago.png') }}" alt="" class="img-fluid rounded-circle" style="max-height: 100px">
                   
                    <p class="card-text mb-0">Paga tu paquete con tu USTD atravez de la red TRC20</p>
                   
                    <span class="text-center fw-bold">Wallet</span>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control"  value="TQu8XqRU8H7EfT1q31yLzG5nRAcgc4fwkc" style="font-size: 12px;" readonly>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Sin equipo completo!</h4>
                  <p>Tus equipos se mostrarán cuando tengas almenos 2 invitados activos y además hayas realizado el pago de tu paquete .</p>
                  <hr>
                  <p class="mb-0">Recuerda que las personas que se registren deben indicar tu Nickname y además realizar el pago del paquete.</p>
                </div>
              </div>
            </div>


            @endif
          </div>

          
        </main>
      </div>
    </div>
</x-app-layout>
