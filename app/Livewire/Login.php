<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Login extends Component
{
    public string $user = '';
    public string $password = '';

    public function login()
    {
        $this->validate([
            'user' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'user.required' => 'Introduce unha conta de correo',
            'user.email' => 'A conta de email non é válida',
            'password.required' => 'Introduce o teu contrasinal',
            'password.min' => 'O contrasinal debe ter mínimo 6 caracteres',
        ]);

        if (Auth::attempt([
            'email' => $this->user,
            'password' => $this->password,
        ])) {
            $this->redirect(route('streaming'));
        } else {
            session()->flash('error', 'Credenciais incorrectas');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
