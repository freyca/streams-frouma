<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    #[Url]
    public string $token;

    #[Url]
    public string $email;

    public string $password;

    public string $password_2;


    public function sendPasswordResetEmail()
    {
        $this->validate([
            'password' => 'required|min:6',
            'password_2' => 'required|same:password',
        ], [
            'password.required' => 'Debes introducir un contrasinal',
            'password.min' => 'A lonxitude mínima é de 6 caracteres',
            'password_2.required' => 'Debes repetir o contrasinal',
            'password_2.same' => 'Os contrasinais non coinciden',
        ]);

        if (!$this->validateTokenAndEmail()) {
            session()->flash('error', 'Error cambiando la contraseña.');
            $this->redirect(route('landing'));
        }

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_2,
                'token' => $this->token,
            ],

            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PasswordReset) {
            session()->flash('success', 'Contraseña modificada correctamente.');
            $this->redirect(route('landing'));
        } else {
            session()->flash('error', 'Error cambiando la contraseña');
            dd($status);
        }
    }

    public function mount()
    {
        if (! $this->validateTokenAndEmail()) {
            session()->flash('error', 'No es posible resetear tu contraseña. Solicita un nuevo mail para resetearla o contacta con un administrador.');
            $this->redirect(route('landing'));
        }
    }

    public function render()
    {
        return view('livewire.reset-password');
    }

    private function validateTokenAndEmail()
    {
        $password_resets = DB::table('password_resets')->where('email', $this->email)->first();

        if ($password_resets &&  Hash::check($this->token, $password_resets->token)) {
            $createdAt = Carbon::parse($password_resets->created_at);

            if (!Carbon::now()->greaterThan($createdAt->addMinutes(config('auth.passwords.users.expire')))) {
                return true;
            }
        }

        return false;
    }
}
