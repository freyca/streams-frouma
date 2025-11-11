<?php

namespace App\Livewire;

use App\Services\ChatService;
use Livewire\Component;

class ChatQuestions extends Component
{
    public array $messages = [];

    public int $chat_message_num = 0;

    protected ChatService $chat_service;

    public function boot(ChatService $chat_service)
    {
        $this->chat_service = $chat_service;
    }

    public function mount()
    {
        $this->chat_service->initChat();

        $this->fetchChatMessages();
    }

    public function render()
    {
        if ($this->chat_message_num !== count($this->messages)) {
            $this->chat_message_num = count($this->messages);

            $this->dispatch('scrollToBottom');
        }

        return view('livewire.chat-questions');
    }

    public function fetchChatMessages()
    {
        $this->messages = $this->chat_service->getChatMessages();
    }
}
