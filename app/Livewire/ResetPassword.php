<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Url;

class ResetPassword extends Component
{
    #[Url]
    public string $token;

    #[Url]
    public string $email;

    public bool $passwordMatch = true;

    public function render()
    {
        if (! $this->validateTokenAndEmail()) {
            $this->redirect(route('landing'));
        }

        return view('livewire.reset-password');
    }

    private function validateTokenAndEmail()
    {
        return false;
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
