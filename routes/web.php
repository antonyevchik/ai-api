<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $response = Http::withToken(config('services.openai.secret'))
        ->withHeader('Content-Type', 'application/json')
        ->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo-instruct",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "You are a poetic assistant, skilled in explaining complex programming concepts with creative flair."
                ],
                [
                    "role" => "user",
                    "content" => "Compose a poem that explains the concept of recursion in programming."
                ]
            ]
        ])->json('error.message');

    return view('welcome', ['content' => $response]);
});
