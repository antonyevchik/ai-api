<?php

use App\AI\Chat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $chat = new Chat();

    $response = $chat->systemMessage('You are a poetic assistant, skilled in explaining complex programming concepts with creative flair.')
        ->send('Compose a poem that explains the concept of recursion in programming.');

    $sillyResponse = $chat->reply('Cool, can you make it much, much sillier.');

    return view('welcome', ['content' => $sillyResponse]);
});
