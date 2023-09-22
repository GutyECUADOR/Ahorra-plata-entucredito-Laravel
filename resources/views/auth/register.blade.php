<x-guest-layout>

    <div class="container">
        <div class="row">
            <div class="col col-md-6">
                <h1 class="mt-1">¿No sabes como disminuir considerablemente tu credito ?</h1>
                <img class="img-fluid" loading="lazy" src="./assets/img/asesora.png" alt="asesor">
                <p class="fs-5 text-secondary">¿Requieres atención inmediata con un expertos?</p>
                <p class="fs-5 text-primary">Uno de nuestros asesores te contactará en un plazo máximo de 5 minutos luego de llenar el formulario.</p>

                    <li class="list-group-item h6 text-xl-start"><i class="far fa-solid fa-arrow-right fa-fw me-4 fa-1x text-primary"></i>
                        Entiende y controla tus finanzas de forma
                        sencilla desde cualquier parte del mundo.
                    </li>
                    <li class="list-group-item h6 text-xl-start"><i class="far fa-solid fa-arrow-right fa-fw me-4 fa-1x text-primary"></i>
                        Anticipate al futuro, disminuye tu credito
                        con abonos inteligentes a capital.

                    </li>
                    <li class="list-group-item h6 text-xl-start"><i class="far fa-solid fa-arrow-right fa-fw me-4 fa-1x text-primary"></i>
                        Manten el control financiero y contable
                        que permita mejorar tus decisiones financieras.
                    </li>
                    <li class="list-group-item h6 text-xl-start"><i class="far fa-solid fa-arrow-right fa-fw me-4 fa-1x text-primary"></i>
                        Mejora tus estrategias financieras y controla
                        a rentabilidad de tus activos.
                    </li>

            </div>
            <div class="col col-md-6">
                <main class="form-signin">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                    {{--  <img class="mb-0" src="{{ asset('assets/img/logo.png') }}" alt="" width="160" height="200"> --}}
                        <h3>Registro de nuevo usuario</h3>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <!-- Name -->
                        <div class="form-floating mb-3">
                            <input type="name" name="name" value="{{old('name')}}" class="form-control" id="name" required autofocus>
                            <label for="name">Nombres</label>
                        </div>

                        <!-- DNI -->
                        <div class="form-floating mb-3">
                            <input type="dni" name="dni" value="{{old('dni')}}" class="form-control" id="dni" required>
                            <label for="dni">Documento de Identidad</label>
                        </div>


                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" required>
                            <label for="email">Correo Electrónico (email)</label>
                        </div>

                        <!-- Phone -->
                        <div class="form-floating mb-3">
                            <input type="phone" name="phone" value="{{old('phone')}}" class="form-control" id="phone" required>
                            <label for="phone">Teléfono</label>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="password" required>
                            <label for="password">Contraseña</label>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-floating mb-3">
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                            <label for="password_confirmation">Confirme Contraseña</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn-block btn btn-lg btn-primary" type="submit">Registrar</button>
                            <a href="{{route('login')}}">O si ya tienes una cuenta da clic aqui</a>
                        </div>

                    </form>

                </main>
            </div>


        </div>
    </div>
</x-guest-layout>
