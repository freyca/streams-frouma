<?php

namespace App\Console\Commands;

use App\Traits\InteractsWithChat;
use Illuminate\Console\Command;

class ClearChatCommand extends Command
{
    use InteractsWithChat;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-chat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the chat questions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->clearChat();

        $this->info('Chat cleared correctly: ' . storage_path('/app/chat_log.json'));

        return self::SUCCESS;
    }
}
