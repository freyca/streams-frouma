<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\UserAccountCreated;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CreateUsersInBulk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-users-in-bulk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates users and notifies them by email';

    protected $emails = [];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach ($this->emails as $email) {
            if (User::where('email', $email)->first()) {
                continue;
            }

            $password = Str::random();
            $user = $this->createUser($email, $password);
            $this->notifyUser($user, $password);

            $this->info('User created successfully: ' . $email);
        }
    }

    private function createUser($email, $password): User
    {
        $name = explode('@', $email)[0];

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return $user;
    }

    private function notifyUser(User $user, string $password): void
    {
        $user->notify(new UserAccountCreated($password));
    }
}
