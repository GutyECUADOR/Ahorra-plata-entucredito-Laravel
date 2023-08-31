<x-guest-layout>
  <div class="container-fluid">
    <div class="row">
      
      <main class="col-md-12">
        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Soporte a usuarios</h1>
        </div>

          <div class="container">
              <div class="row justify-content-md-center">
                  <div class="col-md-6">
                      <div class="mb-4 text-sm text-gray-600">
                          {{ __('Tienes algún problema o consulta referente a tu inversión envíanos un email y te responderemos en la brevedad posible.') }}
                      </div>
              
                      <!-- Session Status -->
                      <x-auth-session-status class="mb-4" :status="session('status')" />

                      <!-- Validation Errors -->
                      <x-auth-validation-errors class="mb-4" :errors="$errors" />
              
                      <form method="POST" action="{{ route('solicitudSoporte') }}">
                          @csrf
              
                           <!-- Name -->
                          <div class="form-floating mb-3">
                              <input type="text" name="asunto" value="{{old('asunto')}}" class="form-control" id="asunto" placeholder="Mi inversion no me llega, no puedo inverir, etc" required autofocus>
                              <label for="asunto">Asunto</label>
                          </div>

                          <div class="form-floating mb-3">
                              <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" required>
                              <label for="email">Email al que te contactaremos</label>
                          </div>

                          <div class="form-floating mb-3">
                              <input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" id="telefono" required>
                              <label for="telefono">Teléfono Celular al que podamos contactarte</label>
                          </div>

                          <!-- Comentario -->
                          <div class="mb-3">
                            <label for="comentario">Consulta / Comentario</label>
                            <textarea name="comentario" class="form-control" id="comentario" rows="3"></textarea>
                           
                        </div>

                          <div class="d-grid gap-2">
                              <button class="btn-block btn btn-lg btn-primary" type="submit"> {{ __('Enviar') }}</button>
                          </div>
                        
                      </form>
                  </div>
              </div>
          </div>
       
      </main>
    </div>
  </div>
</x-guest-layout>

