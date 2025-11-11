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

    protected const CSV_FILENAME = 'login_history.csv';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $csv = $this->openCsvFileAsWrite();

        $csv->insertOne($this->csv_header);

        User::with('loginHistory')->get()->each(function ($user) use ($csv) {
            $user->loginHistory->each(function ($loginHistory) use ($csv, $user) {
                $csv->insertOne([
                    $user->email,
                    $user->name,
                    $loginHistory->ip_address,
                    $loginHistory->created_at,
                    $loginHistory->updated_at,
                ]);
            });
        });

        $csv->toString();

        $this->info('CSV created: '.storage_path(self::CSV_FILENAME));

        return self::SUCCESS;
    }

    private function openCsvFileAsWrite()
    {
        if (Storage::exists(self::CSV_FILENAME)) {
            Storage::delete(self::CSV_FILENAME);
        }

        $writer = Writer::createFromPath(storage_path(self::CSV_FILENAME), 'w+');

        return $writer;
    }
}
