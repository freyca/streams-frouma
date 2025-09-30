<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreateUser extends Component
{
    public bool $invalidEmail = false;

    public bool $passwordMatch = true;

    #[Validate('required|email')]
    public string $email;

    #[Validate('required|min:6')]
    public string $password;

    #[Validate('required|min:6')]
    public string $password_2;

    #[Validate('required|min:4')]
    public string $name;

    public function createUser()
    {
        if (! $this->validatePassword()) {
            return;
        }

        if (! $this->emailIsUnique()) {
            return;
        }

        if ($this->storeUser()) {
            $this->redirect(route('landing'));
        }
    }

    public function render()
    {
        return view('livewire.create-user');
    }

    private function validatePassword(): bool
    {
        $this->passwordMatch = $this->password === $this->password_2;

        return $this->passwordMatch;
    }

    private function emailIsUnique(): bool
    {
        if (User::where('email', $this->email)->first()) {
            $this->invalidEmail = true;
        }

        return ! $this->invalidEmail;
    }

    private function storeUser(): bool
    {
        try {
            $user = new User([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);

            return $user->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
