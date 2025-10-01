<?php

use App\Livewire\CreateUser;
use App\Models\User;
use Livewire\Livewire;

uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    config()->set('froumastream.register_enabled', true);
});

it('only allows access to the route when register_enabled is true', function () {
    config()->set('froumastream.register_enabled', true);
    $this->get(route('create-user'))->assertStatus(200);

    config()->set('froumastream.register_enabled', false);
    $this->get(route('create-user'))->assertStatus(404);
});

it('renders the CreateUser component', function () {
    Livewire::test(\App\Livewire\CreateUser::class)
        ->assertSee('Nome');
});

it('requires all fields', function () {
    Livewire::test(CreateUser::class)
        ->set('name', '')
        ->set('email', '')
        ->set('password', '')
        ->set('password_2', '')
        ->call('createUser')
        ->assertHasErrors([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_2' => 'required',
        ]);
});

it('validates minimum length for name and password', function () {
    Livewire::test(CreateUser::class)
        ->set('name', 'abc')
        ->set('password', '12345')
        ->set('password_2', '12345')
        ->call('createUser')
        ->assertHasErrors([
            'name' => 'min',
            'password' => 'min',
        ]);
});

it('validates password confirmation', function () {
    Livewire::test(CreateUser::class)
        ->set('password', '123456')
        ->set('password_2', '654321')
        ->call('createUser')
        ->assertHasErrors([
            'password_2' => 'same',
        ]);
});

it('prevents duplicate emails', function () {
    $existingUser = User::factory()->create(['email' => 'fran@example.com']);

    Livewire::test(CreateUser::class)
        ->set('name', 'Fran Rey')
        ->set('email', 'fran@example.com')
        ->set('password', '123456')
        ->set('password_2', '123456')
        ->call('createUser')
        ->assertHasErrors(['email' => 'unique']);
});

it('creates a new user with valid data', function () {
    Livewire::test(CreateUser::class)
        ->set('name', 'Fran Rey')
        ->set('email', 'nuevo@example.com')
        ->set('password', '123456')
        ->set('password_2', '123456')
        ->call('createUser');

    $this->assertDatabaseHas('users', [
        'name' => 'Fran Rey',
        'email' => 'nuevo@example.com',
    ]);
});
