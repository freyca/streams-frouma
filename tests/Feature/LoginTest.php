<?php

use App\Livewire\Login;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'email' => 'existing@example.com',
        'password' => bcrypt('correctpassword'),
    ]);
});

it('shows validation errors if fields are empty', function () {
    Livewire::test(Login::class)
        ->set('user', '')
        ->set('password', '')
        ->call('login')
        ->assertHasErrors(['user' => 'required', 'password' => 'required']);
});

it('shows validation error if email is invalid', function () {
    Livewire::test(Login::class)
        ->set('user', 'not-an-email')
        ->set('password', '123456')
        ->call('login')
        ->assertHasErrors(['user' => 'email']);
});

it('shows error if credentials are incorrect', function () {
    Livewire::test(\App\Livewire\Login::class)
        ->set('user', 'wrong@example.com')
        ->set('password', 'wrongpass')
        ->call('login')
        ->assertSee('Credenciais incorrectas');
});

it('redirects to streaming if credentials are correct', function () {
    Livewire::test(Login::class)
        ->set('user', 'existing@example.com')
        ->set('password', 'correctpassword')
        ->call('login')
        ->assertRedirect(route('streaming'));
});

it('shows the "crear usuario" section when register_enabled is true', function () {
    // Garantimos que a configuración está activada
    config()->set('froumastream.register_enabled', true);

    Livewire::test(Login::class)
        ->assertSee('Non tes un usuario creado?')
        ->assertSee('Crear usuario');
});

it('does not show the "crear usuario" section when register_enabled is false', function () {
    config()->set('froumastream.register_enabled', false);

    Livewire::test(Login::class)
        ->assertDontSee('Non tes un usuario creado?')
        ->assertDontSee('Crear usuario');
});

it('shows the login section when login_enabled is true', function () {
    config()->set('froumastream.login_enabled', true);

    Livewire::test(Login::class)
        ->assertSee('Acceder')
        ->assertSee('Olvidache o teu contrasinal?');
});

it('does not show the login section when login_enabled is false', function () {
    config()->set('froumastream.login_enabled', false);

    Livewire::test(Login::class)
        ->assertDontSee('Acceder')
        ->assertDontSee('Olvidache o teu contrasinal?');
});
