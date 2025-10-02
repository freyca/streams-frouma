<div class="form-signin m-auto">
    <x-brand-copy />

    <form wire:submit.prevent="createUser" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <input type="text" id="name" wire:model="name" required
                   placeholder=" "
                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
            <label for="name">@lang('Name')</label>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="email" id="email" wire:model="email" required
                   placeholder=" "
                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
            <label for="email">@lang('Email')</label>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

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

        <button class="w-100 btn btn-lg btn-secondary mt-4" type="submit">
            @lang('Create user')
        </button>

        <x-go-back />
    </form>

    <x-footer />
</div>