<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\Component;

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
        ]);

        if (! $this->validateTokenAndEmail()) {
            session()->flash('error', 'Password change error.');
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
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PasswordReset) {
            session()->flash('success', __('Password succesfully changed.'));
            $this->redirect(route('landing'));
        } else {
            session()->flash('error', __('Password change error'));
            dd($status);
        }
    }

    public function mount()
    {
        if (! $this->validateTokenAndEmail()) {
            session()->flash('error', __('It is not possible to reset your password. Ask for another email to reset it or contact an administrator.'));
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

        if ($password_resets && Hash::check($this->token, $password_resets->token)) {
            $createdAt = Carbon::parse($password_resets->created_at);

            if (! Carbon::now()->greaterThan($createdAt->addMinutes(config('auth.passwords.users.expire')))) {
                return true;
            }
        }

        return false;
    }
}
