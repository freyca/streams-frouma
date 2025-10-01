<div>
    <form wire:submit.prevent="sendPasswordResetEmail" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <input type="password" id="passwd" wire:model="password" required
                   placeholder=" "
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
            <label for="passwd">Contrasinal</label>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" id="passwd-2" wire:model="password_2" required
                   placeholder=" "
                   class="form-control {{ $errors->has('password_2') ? 'is-invalid' : '' }}">
            <label for="passwd-2">Repetir Contrasinal</label>
            @error('password_2')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="w-100 btn btn-lg btn-secondary" type="submit">Cambiar contrasinal</button>
    </form>

    <x-go-back />
</div>
