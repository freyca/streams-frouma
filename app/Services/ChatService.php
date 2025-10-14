<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChatService
{
    protected const CHAT_FILENAME = 'chat_log.json';

    public function initChat()
    {
        if (Storage::exists(self::CHAT_FILENAME)) {
            return;
        }

        Storage::put(self::CHAT_FILENAME, '[]');
    }

    public function getChatMessages()
    {
        return json_decode(Storage::get(self::CHAT_FILENAME), true) ?? [];
    }

    public function clearChat()
    {
        $new_chat_filename = explode('.', self::CHAT_FILENAME)[0];
        $new_chat_filename = $new_chat_filename.'_'.Str::random(6).'_'.now()->format('d-Y-m').'.json';

        if (Storage::exists(self::CHAT_FILENAME)) {
            Storage::move(self::CHAT_FILENAME, $new_chat_filename);
        }

        $this->initChat();
    }

    public function saveChatQuestion(string $date, string $user, string $question)
    {
        $chat_file_contents = Storage::get(self::CHAT_FILENAME);
        $actual_decoded_data = json_decode($chat_file_contents, true);

        if (is_null($actual_decoded_data)) {
            $actual_decoded_data = [];
        }

        array_push(
            $actual_decoded_data,
            [
                'date' => $date,
                'user' => $user,
                'question' => $question,
            ]
        );

        $coded_data = json_encode($actual_decoded_data);

        $fullPath = Storage::path(self::CHAT_FILENAME);
        file_put_contents($fullPath, $coded_data, LOCK_EX);
    }
}
