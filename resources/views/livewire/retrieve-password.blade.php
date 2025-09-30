<div>
    <p class="fs-6">Enviarémosche un mail para cambiar o contrasinal</p>
    <p class="text-danger"><strong>Lembra revisar a bandexa de SPAM</strong></p>

    <form wire:submit.prevent="sendPasswordResetEmail" method="POST">
        @csrf

        <div class="form-floating mb-2">
            <input type="email" id="email" placeholder="name@example.com" wire:model="email" required
            @class([
                'form-control',
                'is-invalid' => ! $userExists,
            ])>
            <label for="email">Dirección de email</label>
        </div>

        <button class="w-100 btn btn-lg btn-secondary" type="submit">Enviar email</button>
    </form>
</div>