<?php

namespace App\Livewire;

use App\Events\UpdateUserLogout;
use App\Services\ChatService;
use App\Traits\InteractsWithChat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatQuestions extends Component
{
    public array $messages = [];

    protected ChatService $chat_service;

    public function boot(ChatService $chat_service,)
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
        UpdateUserLogout::dispatch(
            Auth::user(),
            request(),
        );

        return view('livewire.chat-questions');
    }

    public function fetchChatMessages()
    {
        $this->messages = $this->chat_service->getChatMessages();
    }
}
