<form wire:submit.prevent="createUser" method="POST">
    @csrf

    <div class="form-floating mb-2">
        <input type="name" id="name" placeholder="John Doe" wire:model="name" class="form-control" required>
        <label for="name">Nome</label>
    </div>

    <div class="form-floating mb-2">
        <input type="email" id="email" placeholder="name@example.com" wire:model="email" required
        @class([
            'form-control',
            'is-invalid' => $invalidEmail,
        ])>
        <label for="email">Dirección de email</label>
    </div>

    <div class="form-floating">
        <input type="password" id="passwd" name="passwd" placeholder="Password" wire:model="password" required
        @class([
            'form-control',
            'is-invalid' =>  ! $passwordMatch,
        ])>
        <label for="passwd">Contrasinal</label>
    </div>

    <div class="form-floating">
        <input type="password" id="passwd-2" name="passwd-2" placeholder="Repeat password" wire:model="password_2" required
        @class([
            'form-control',
            'is-invalid' => ! $passwordMatch,
        ])>
        <label for="passwd-2">Repetir Contrasinal</label>
    </div>

    <button class="w-100 btn btn-lg btn-secondary" type="submit">Crear Usuario</button>
</form>
