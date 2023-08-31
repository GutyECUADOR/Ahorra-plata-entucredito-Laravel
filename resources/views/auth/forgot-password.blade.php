<x-guest-layout>
    <div class="container-fluid">
      <div class="row">
        
        <main class="col-md-12">
          <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Restaurar contraseña</h1>
          </div>

            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-6">
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>
                
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                
                             <!-- Name -->
                             <div class="form-floating mb-3">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" required autofocus>
                                <label for="email">Email</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn-block btn btn-lg btn-primary" type="submit"> {{ __('Email Password Reset Link') }}</button>
                            </div>
                          
                        </form>
                    </div>
                </div>
            </div>
         
        </main>
      </div>
    </div>
</x-guest-layout>

