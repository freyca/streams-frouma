<?php

use App\Models\User;
use App\Livewire\RetrievePassword;
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
        ->assertSee('Enviarémosche un mail para cambiar o contrasinal')
        ->assertSee('Dirección de email')
        ->assertSee('Enviar email');
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
        ->assertSet('errorMessage', 'O usuario non existe');
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
            'Enviouse un mail coas instruccións para resetealo contrasinal. Por favor, revisa a bandexa de SPAM'
        );
});
