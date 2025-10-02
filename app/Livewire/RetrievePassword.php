<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class RetrievePassword extends Component
{
    public bool $userExists = true;
    public string $errorMessage = '';
    public string $email = '';

    public function sendPasswordResetEmail()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        if (! $this->validateUserExists()) {
            return;
        }

        if ($this->sendEmail()) {
            session()->flash('success', __('A mail has been sent with instructions to reset your password. Please, check SPAM box.'));
            $this->redirect(route('landing'));
        } else {
            session()->flash('error', __('Mail sent error. Please try again or contact an administrator.'));
            $this->redirect(route('landing'));
        }
    }

    public function render()
    {
        return view('livewire.retrieve-password');
    }

    private function validateUserExists(): bool
    {
        $this->userExists = true;
        $this->errorMessage = '';

        if (! User::where('email', $this->email)->first()) {
            $this->userExists = false;
            $this->errorMessage = __('User does not exists');
        }

        return $this->userExists;
    }

    private function sendEmail(): bool
    {
        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::ResetLinkSent) {
            return true;
        }

        return false;
    }
}
