<div>
    @dump($this->token)
    @dump($this->email)
    <form wire:submit.prevent="sendPasswordResetEmail" method="POST">
        @csrf

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

        <button class="w-100 btn btn-lg btn-secondary" type="submit">Cambiar contrasinal</button>
    </form>
</div>