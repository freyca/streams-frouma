<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\Attributes\Validate;

class RetrievePassword extends Component
{
    public bool $userExists = true;

    #[Validate('required|email')]
    public string $email;

    public function sendPasswordResetEmail()
    {
        if (! $this->validateUserExists()) {
            return;
        }

        if ($this->sendEmail()) {
            $this->redirect(route('landing'));
        }

        throw new \Exception('Error sending email');
    }

    public function render()
    {
        return view('livewire.retrieve-password');
    }

    private function validateUserExists(): bool
    {
        if (! User::where('email', $this->email)->first()) {
            $this->userExists = false;
        }

        return $this->userExists;
    }

    private function sendEmail(): bool
    {
        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        return Password::sendResetLink(['email' => $this->email]) === Password::ResetLinkSent;
    }
}
