<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Login extends Component
{
    #[Validate('required|email')]
    public string $user;

    #[Validate('required|min:6')]
    public string $password;

    public function login()
    {
        if (Auth::attempt([
            'email' => $this->user,
            'password' => $this->password,
        ])) {
            $this->redirect(route('streaming'));
        } else {
            session()->flash('error', 'Credenciales incorrectas');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
