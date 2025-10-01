<div>
    <p class="fs-6">Enviarémosche un mail para cambiar o contrasinal</p>
    <p class="text-warning"><strong>Lembra revisar a bandexa de SPAM</strong></p>

    <form wire:submit.prevent="sendPasswordResetEmail" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <input type="email" id="email" wire:model="email" required
                   placeholder=" "
                   class="form-control {{ ! $userExists ? 'is-invalid' : '' }}">
            <label for="email">Dirección de email</label>
            @if(!$userExists)
                <div class="invalid-feedback">
                    {{ $errorMessage }}
                </div>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-secondary" type="submit">Enviar email</button>
    </form>

    <x-go-back />
</div>
