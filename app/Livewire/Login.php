<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Login extends Component
{
    public string $email = '';
    public string $password = '';

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            $this->redirect(route('streaming'));
        } else {
            session()->flash('error', __('Invalid credentials'));
        }
    }

    public function render()
    {
        if (Auth::check()) {
            $this->redirect(route('streaming'));
        }

        return view('livewire.login');
    }
}
