<?php

namespace App\Livewire;

use App\Traits\InteractsWithChat;
use Livewire\Component;

class ChatQuestions extends Component
{
    use InteractsWithChat;

    public array $messages = [];

    public function mount()
    {
        $this->initChat();

        $this->fetchChatMessages();
    }

    public function render()
    {
        return view('livewire.chat-questions');
    }

    public function fetchChatMessages()
    {
        $this->messages = $this->getChatMessages();
    }
}
