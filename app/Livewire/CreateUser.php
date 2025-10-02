<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_2 = '';

    public function createUser()
    {
        $this->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'password_2' => 'required|same:password',
        ]);

        if ($this->storeUser()) {
            session()->flash('success', __('User has been succesfully created'));
            $this->redirect(route('landing'));
        }
    }

    public function render()
    {
        return view('livewire.create-user');
    }

    private function storeUser(): bool
    {
        try {
            $user = new User([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            return $user->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
