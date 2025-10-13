<?php

namespace App\Livewire;

use App\Events\UpdateUserLogout;
use App\Traits\InteractsWithChat;
use Illuminate\Support\Facades\Auth;
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
        UpdateUserLogout::dispatch(
            Auth::user(),
            request(),
        );
        return view('livewire.chat-questions');
    }

    public function fetchChatMessages()
    {
        $this->messages = $this->getChatMessages();
    }
}
