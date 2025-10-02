<div>
    <form wire:submit.prevent="sendPasswordResetEmail" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <input type="password" id="passwd" wire:model="password" required
                   placeholder=" "
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
            <label for="passwd">@lang('Password')</label>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" id="passwd-2" wire:model="password_2" required
                   placeholder=" "
                   class="form-control {{ $errors->has('password_2') ? 'is-invalid' : '' }}">
            <label for="passwd-2">@lang('Repeat password')</label>
            @error('password_2')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="w-100 btn btn-lg btn-secondary" type="submit">@lang('Change password')</button>
    </form>

    <x-go-back />
</div>
