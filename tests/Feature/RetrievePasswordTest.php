<?php

use App\Livewire\RetrievePassword;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Livewire\Livewire;

uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'email' => 'existing@example.com',
    ]);
});

it('renders the RetrievePassword component', function () {
    Livewire::test(RetrievePassword::class)
        ->assertSee(__('We will send you an email to change your password.'))
        ->assertSee(__('Email'))
        ->assertSee(__('Send email'));
});

it('validates email is required', function () {
    Livewire::test(RetrievePassword::class)
        ->set('email', '')
        ->call('sendPasswordResetEmail')
        ->assertHasErrors(['email' => 'required']);
});

it('validates email format', function () {
    Livewire::test(RetrievePassword::class)
        ->set('email', 'invalid-email')
        ->call('sendPasswordResetEmail')
        ->assertHasErrors(['email' => 'email']);
});

it('shows error if user does not exist', function () {
    Livewire::test(RetrievePassword::class)
        ->set('email', 'nonexistent@example.com')
        ->call('sendPasswordResetEmail')
        ->assertSet('userExists', false)
        ->assertSet('errorMessage', __('User does not exists'));
});

it('sends password reset email successfully if user exists', function () {
    Password::shouldReceive('sendResetLink')
        ->once()
        ->with(['email' => 'existing@example.com'])
        ->andReturn(Password::RESET_LINK_SENT);

    Livewire::test(RetrievePassword::class)
        ->set('email', 'existing@example.com')
        ->call('sendPasswordResetEmail')
        ->assertRedirect(route('landing'))
        ->assertSessionHas(
            'success',
            __('A mail has been sent with instructions to reset your password. Please, check SPAM box.')
        );
});
