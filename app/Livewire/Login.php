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
        ]);

        if (Auth::attempt([
            'email' => $this->user,
            'password' => $this->password,
        ])) {
            $this->redirect(route('streaming'));
        } else {
            session()->flash('error', __('Invalid credentials'));
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
