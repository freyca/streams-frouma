<?php

use App\Livewire\Login;
use App\Models\User;
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
        ->set('email', '')
        ->set('password', '')
        ->call('login')
        ->assertHasErrors(['email' => 'required', 'password' => 'required']);
});

it('shows validation error if email is invalid', function () {
    Livewire::test(Login::class)
        ->set('email', 'not-an-email')
        ->set('password', '123456')
        ->call('login')
        ->assertHasErrors(['email' => 'email']);
});

it('shows error if credentials are incorrect', function () {
    Livewire::test(\App\Livewire\Login::class)
        ->set('email', 'wrong@example.com')
        ->set('password', 'wrongpass')
        ->call('login')
        ->assertSee(__('Invalid credentials'));
});

it('redirects to streaming if credentials are correct', function () {
    Livewire::test(Login::class)
        ->set('email', 'existing@example.com')
        ->set('password', 'correctpassword')
        ->call('login')
        ->assertRedirect(route('streaming'));
});

it('shows the "crear usuario" section when register_enabled is true', function () {
    // Garantimos que a configuración está activada
    config()->set('froumastream.register_enabled', true);

    Livewire::test(Login::class)
        ->assertSee(__("Don't you have a user?"))
        ->assertSee(__('Create user'));
});

it('does not show the "crear usuario" section when register_enabled is false', function () {
    config()->set('froumastream.register_enabled', false);

    Livewire::test(Login::class)
        ->assertDontSee(__("Don't you have a user?"))
        ->assertDontSee(__('Create user'));
});

it('shows the login section when login_enabled is true', function () {
    config()->set('froumastream.login_enabled', true);

    Livewire::test(Login::class)
        ->assertSee(__('Login'))
        ->assertSee(__('Did you forget your password?'));
});

it('does not show the login section when login_enabled is false', function () {
    config()->set('froumastream.login_enabled', false);

    Livewire::test(Login::class)
        ->assertDontSee(__('Login'))
        ->assertDontSee(__('Did you forget your password?'));
});
