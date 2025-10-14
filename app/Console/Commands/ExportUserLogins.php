<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class ExportUserLogins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-user-logins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export user login history';

    protected $csv_header = ['email', 'name', 'ip', 'login_at', 'logout_at'];

    protected $csv_name = 'login_history.csv';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $csv = $this->openCsvFileAsWrite();

        $csv->insertOne($this->csv_header);

        foreach (User::all() as $user) {
            $user_logins = $user->loginHistory();

            if ($user_logins->count() === 0) {
                continue;
            }

            $user_logins->each(function ($user_login) use ($csv) {
                $record = [
                    $user_login->user->email,
                    $user_login->user->name,
                    $user_login->ip_address,
                    $user_login->created_at,
                    $user_login->updated_at,
                ];

                $csv->insertOne($record);
            });
        }

        $csv->toString();

        $this->info('CSV created: ' . storage_path($this->csv_name));

        return self::SUCCESS;
    }

    private function openCsvFileAsWrite()
    {
        if (Storage::disk('local')->exists($this->csv_name)) {
            Storage::disk('local')->delete($this->csv_name);
        }

        $writer = Writer::createFromPath(storage_path($this->csv_name), 'w+');

        return $writer;
    }
}
