<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Validate;

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
        ], [
            'name.required' => 'O nome é obrigatorio',
            'name.min' => 'O nome debe ter polo menos 4 caracteres',
            'email.required' => 'Introduce un email',
            'email.email' => 'O email debe ser válido',
            'email.unique' => 'Este email xa está rexistrado',
            'password.required' => 'Debes introducir un contrasinal',
            'password.min' => 'A lonxitude mínima é de 6 caracteres',
            'password_2.required' => 'Debes repetir o contrasinal',
            'password_2.same' => 'Os contrasinais non coinciden',
        ]);

        if ($this->storeUser()) {
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
                'password' => Hash::make($this->password)
            ]);

            return $user->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
