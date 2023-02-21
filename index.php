<?php


require_once ('./vendor/autoload.php');

use Delorkor\TelegramBotClient\Service\TelegramBotClient;

$telegramBotClient = new TelegramBotClient('6066674814:AAGK_leG4QRDMcFa8As3qZzk228lLtQH01s');

// $telegramBotClient->getUpdates();
// echo '<pre>';
// echo print_r($telegramBotClient->getUpdates());
// echo '</pre>';

// echo '<pre>';
// echo print_r(($telegramBotClient->sendMessage((int) $telegramBotClient->getUpdates()['result'][0]['message']['chat']['id'], 'hello world 123 !!!')));
// echo '</pre>';


// $response = $telegramBotClient->sendDocument('562262708', 'C:\OSPanel\1.jpg');


// $response = $telegramBotClient->sendDocument('562262708', 'C:\OSPanel\Alok - Alive (It Feels Like).mp3');
$response = $telegramBotClient->sendPhoto('562262708', 'C:\OSPanel\1.jpg');

print_r($response);