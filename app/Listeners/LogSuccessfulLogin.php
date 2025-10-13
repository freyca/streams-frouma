<?php

namespace App\Listeners;

use App\Events\UpdateUserLogout;
use App\Models\LoginHistory;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateUserLogout $event): void
    {
        LoginHistory::updateLogoutTimestamp($event);
    }
}
