<div>
    <p class="fs-6">@lang("We will send you an email to change your password.")</p>
    <p class="text-warning"><strong>@lang("Remember to check SPAM box")</strong></p>

    <form wire:submit.prevent="sendPasswordResetEmail" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <input type="email" id="email" wire:model="email" required
                   placeholder=" "
                   class="form-control {{ ! $userExists ? 'is-invalid' : '' }}">
            <label for="email">@lang('Email')</label>
            @if(!$userExists)
                <div class="invalid-feedback">
                    {{ $errorMessage }}
                </div>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-secondary" type="submit">@lang('Send email')</button>
    </form>

    <x-go-back />
</div>
