<x-guest-layout>
    
    <main class="form-signin">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
    
            <!-- Email Address -->
            <div class="form-floating">
                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="name@example.com" required autofocus>
                <label for="email">Email</label>
            </div>
    
            <!-- Password -->
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="current-password">
                <label for="password">Contraseña</label>
            </div>
    
            <!-- Password -->
            <div class="form-floating">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="password_confirmation" required>
                <label for="password_confirmation">Confirmar contraseña</label>
            </div>
    
            <button class="w-100 btn btn-lg btn-primary" type="submit">Restaurar mi contraseña</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2022–{{ now()->year }}</p>
        </form>
    </main>

   
</x-guest-layout>

