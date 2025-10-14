<?php

namespace App\Livewire;

use App\Services\ChatService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public string $question = '';

    protected ChatService $chat_service;

    public function boot(ChatService $chat_service)
    {
        $this->chat_service = $chat_service;
    }

    public function mount()
    {
        $this->chat_service->initChat();
    }

    public function sendMessage()
    {
        if (! Auth::check()) {
            return;
        }

        $this->validate([
            'question' => 'required|string|min:3',
        ]);

        $this->messageReceived();

        sleep(1);

        $this->reset('question');
    }

    public function render()
    {
        return view('livewire.chat');
    }

    public function messageReceived()
    {
        $this->chat_service->saveChatQuestion(
            date('H:i'),
            auth()->user()->name,
            $this->question,
        );
    }
}
