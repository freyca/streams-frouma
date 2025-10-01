<div>
    {{-- Alertas de sesión --}}
    @if (session('success'))
        <div class="alert alert-success fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- Formulario de login --}}
    @if(config('froumastream.login_enabled'))
        <form wire:submit.prevent="login" method="POST">
            @csrf

            <div class="form-floating mb-3">
                <input type="email" id="user_name" wire:model="user" required
                       placeholder=" "
                       class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}">
                <label for="user_name">Dirección de email</label>
                @error('user')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" id="passwd" wire:model="password" required
                       placeholder=" "
                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                <label for="passwd">Contraseña</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="w-100 btn btn-lg btn-secondary" type="submit">Acceder</button>
        </form>

        <p class="mt-2">
            <small><a href="/recuperar-contrasinal">Olvidache o teu contrasinal?</a></small>
        </p>
    @endif

    {{-- Sección de rexistro --}}
    @if(config('froumastream.register_enabled'))
        <section class="mt-5 mb-4">
            <hr/>
            <p>Non tes un usuario creado?</p>
            <a href="/crear-usuario">
                <button class="w-100 btn btn-lg btn-secondary">Crear usuario</button>
            </a>
        </section>
    @endif
</div>
