<?php

namespace App\Livewire;

use App\Events\UpdateUserLogout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserKeepAliveSession extends Component
{
    public function updateUserLogoutTimestamp()
    {
        UpdateUserLogout::dispatch(
            Auth::user(),
            request(),
        );
    }

    public function render()
    {
        return <<<'HTML'
        <span wire:poll="updateUserLogoutTimestamp">
            <!-- nothing here -->
        </span>
        HTML;
    }
}
