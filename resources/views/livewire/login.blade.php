<div>
@if( config('froumastream.login_enabled'))
    <form wire:submit.prevent="login" method="POST">
        @csrf

        <div class="form-floating">
            <input type="email" class="form-control" id="user_name" name="user_name" placeholder="name@example.com" wire:model="user" value="" required>
            <label for="user_name">Dirección de email</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Password" wire:model="password" required>
            <label for="passwd">Contraseña</label>
        </div>

        <button class="w-100 btn btn-lg btn-secondary" type="submit">Acceder</button>
    </form>

    <p class="mt-2"><small><a href="/recuperar-contrasinal">Olvidache o teu contrasinal?</a></small></p>
@endif

@if (config('froumastream.register_enabled'))
    <section class="mt-5 mb-4">
        <hr/>
        <p>Non tes un usuario creado?</p>
        <a href="/crear-usuario">
            <button class="w-100 btn btn-lg btn-secondary">Crear usuario</button>
        </a>
    </section>
@endif
</div>