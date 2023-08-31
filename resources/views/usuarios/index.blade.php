<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
    
    <div class="container-fluid">
      <div class="row">
        <x-sidebar-menu></x-sidebar-menu>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Lista de Clientes</h1>
          </div>

          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-3" :errors="$errors" />

          @if (Session::has('status'))
              <div class="alert alert-success">
                  <ul>
                      <li>{{ Session::get('status') }}</li>
                  </ul>
              </div>
          @endif

          <div class="table-responsive">
            <table class="table table-striped table-sm table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nickname</th>
                  <th scope="col">Ubicación</th>
                  <th scope="col">Promotor</th>
                  <th scope="col">Email</th>
                  <th scope="col">Telefono</th>
                  <th scope="col">Paquete</th>
                  <th scope="col">Pagado</th>
                  <th scope="col">Recibo</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nickname }}</td>
                    <td>{{ $user->location }}</td>
                    <td>{{ $user->nickname_promoter }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->package_id }}</td>
                    <td>{{ $user->EstadoPago }}</td>
                  
                    @if($user->imagen_recibo)
                    <td><a href="{{ asset('/storage/recibos/'.$user->imagen_recibo) }}" download target="_blank">
                      <span></span> Descargar</a>
                    </td>
                    @else
                    <td>
                      <span ></span> Sin recibo</a>
                    </td>
                    @endif
                    <td>
                      <form method="GET" action="{{ route('pagos.create', $user) }}">
                        <button class="btn btn-sm btn-primary">
                          <span data-feather="edit"></span> Registrar pago
                        </button>
                     </form>
                    </td>
                    <td>
                      @if(!$user->is_payed)
                        <form method="POST" action="{{ route('register.asignar', $user) }}">
                          @csrf
                          <button class="btn btn-sm btn-success"> <span data-feather="check-square"></span>Asignar ubicación </button>
                        </form>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
</x-app-layout>
