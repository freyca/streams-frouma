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
        ], [
            'email.required' => 'Introduce unha conta de correo',
            'email.email' => 'A conta de email non é válida',
        ]);

        if (! $this->validateUserExists()) {
            return;
        }

        if ($this->sendEmail()) {
            session()->flash('success', 'Enviouse un mail coas instruccións para resetealo contrasinal. Por favor, revisa a bandexa de SPAM.');
            $this->redirect(route('landing'));
        } else {
            session()->flash('error', 'Error al enviar el email. Por favor, inténtalo más tarde o contacta con un administrador.');
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
            $this->errorMessage = 'O usuario non existe';
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
