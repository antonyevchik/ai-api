<?php

namespace App\AI;

use Illuminate\Support\Facades\Http;

class Chat
{
    protected array $messages = [];

    public function systemMessage(string $message):static
    {
        $this->messages[] = [
            'role' => 'system',
            'content' => $message
        ];

        return $this;
    }

    public function send(string $message)
    {
        $this->messages[] = [
            'role' => 'user',
            'content' => $message
        ];

        $response = Http::withToken(config('services.openai.secret'))
            ->withHeader('Content-Type', 'application/json')
            ->post('https://api.openai.com/v1/chat/completions', [
                "model" => "gpt-3.5-turbo",
                "messages" => $this->messages
            ])->json('error.message');

        if ($response) {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $response
            ];
        }

        return $response;
    }

    public function reply(string $message)
    {
        return $this->send($message);
    }

    public function messages()
    {
        return $this->messages;
    }
}
