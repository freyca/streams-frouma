<?php

use App\Livewire\ResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Livewire;

uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    // Crear un usuario de exemplo
    $this->user = User::factory()->create();

    // Crear token fake na táboa password_resets
    $this->token = Str::random(10);
    DB::table('password_resets')->insert([
        'email' => $this->user->email,
        'token' => Hash::make($this->token),
        'created_at' => now(),
    ]);
});

it('renders the ResetPassword component', function () {
    Livewire::test(ResetPassword::class, [
        'token' => $this->token,
        'email' => $this->user->email,
    ])
        ->assertSee(__('Password'))
        ->assertSee(__('Repeat password'))
        ->assertSeeHtml('id="passwd"')
        ->assertSeeHtml('id="passwd-2"');
});

it('validates required password fields', function () {
    Livewire::test(ResetPassword::class, [
        'token' => $this->token,
        'email' => $this->user->email,
    ])
        ->set('password', '')
        ->set('password_2', '')
        ->call('sendPasswordResetEmail')
        ->assertHasErrors([
            'password' => 'required',
            'password_2' => 'required',
        ]);
});

it('validates password minimum length and confirmation', function () {
    Livewire::test(ResetPassword::class, [
        'token' => $this->token,
        'email' => $this->user->email,
    ])
        ->set('password', '123')
        ->set('password_2', '456')
        ->call('sendPasswordResetEmail')
        ->assertHasErrors([
            'password' => 'min',
            'password_2' => 'same',
        ]);
});

it('resets the password successfully', function () {
    Livewire::test(ResetPassword::class, [
        'token' => $this->token,
        'email' => $this->user->email,
    ])
        ->set('password', 'newpassword')
        ->set('password_2', 'newpassword')
        ->call('sendPasswordResetEmail')
        ->assertRedirect(route('landing'))
        ->assertSessionHas('success', 'Contraseña modificada correctamente.');

    $this->user->refresh();
    expect(Hash::check('newpassword', $this->user->password))->toBeTrue();
});

it('redirects when token or email are invalid', function () {
    // Borrar token válido
    DB::table('password_resets')->where('email', $this->user->email)->delete();

    $test = Livewire::test(ResetPassword::class, [
        'token' => 'wrongtoken',
        'email' => $this->user->email,
    ]);

    $test->assertRedirect(route('landing'))
        ->assertSessionHas('error', 'No es posible resetear tu contraseña. Solicita un nuevo mail para resetearla o contacta con un administrador.');
});
