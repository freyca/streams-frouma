<?php

namespace App\Console\Commands;

use App\Services\ChatService;
use Illuminate\Console\Command;

class ClearChatCommand extends Command
{
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

    public function __construct(public ChatService $chat_service,)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->chat_service->clearChat();

        $this->info('Chat cleared correctly: ' . storage_path('/app/chat_log.json'));

        return self::SUCCESS;
    }
}
