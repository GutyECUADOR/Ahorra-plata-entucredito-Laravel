<x-guest-layout>
  
    <div class="container">
        <div class="row">
            <main class="form-signin">
        
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    {{-- <img class="mb-0" src="{{ asset('assets/img/logo.png') }}" alt="" width="160" height="200"> --}}
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
            
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <h1 class="h3 mb-3 fw-normal">Ingrese por favor</h1>
        
                    <div class="form-floating">
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="name@example.com" required autofocus>
                        <label for="email">Correo electrónico</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="current-password">
                        <label for="password">Contraseña</label>
                    </div>
        
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                        </label>
                   
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
                        <a href="{{route('register')}}">No tienes cuenta? Registrate aquí</a>
                        <p class="mt-5 mb-3 text-muted">&copy; 2022–{{ now()->year }}</p>
                    </div>
                </form>
            
            </main>
        </div>
    </div>

</x-guest-layout>
