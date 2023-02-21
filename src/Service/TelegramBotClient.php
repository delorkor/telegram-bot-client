<?php
namespace Delorkor\TelegramBotClient\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;


class TelegramBotClient
{
    private const API = 'https://api.telegram.org/bot';
    private const SEND_MESSAGE = 'sendMessage';
    private const GET_UPDATES = 'getUpdates';
    private const SEND_DOCUMENT = 'sendDocument';
    private const SEND_AUDIO = 'sendAudio';
    private const SEND_PHOTO = 'sendPhoto';
    private string $token;
    private HttpClientInterface $httpClient;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->httpClient = HttpClient::create();
    }

    public function getUpdates(): array
    {
        $response = $this->httpClient->request(
            Request::METHOD_GET,
            self::API . $this->token . '/' . self::GET_UPDATES
        );

        return $response->toArray();
    }
    public function sendMessage(
        int $chatId,
        string $text
    ): array {
        $response = $this->httpClient->request(
            Request::METHOD_GET,
            self::API . $this->token . '/' . self::SEND_MESSAGE . '?chat_id=' . $chatId . '&text=' . $text
        );

        return $response->toArray();
}
public function sendDocument(string $chatId, string $filePath)
{
    $formFields = [
        'chat_id' => $chatId,
        'document' => DataPart::fromPath($filePath),
    ];
    $formData = new FormDataPart($formFields);

    $response = $this->httpClient->request(
        Request::METHOD_POST,
        self::API . $this->token . '/' . self::SEND_DOCUMENT,
        [
            'headers' => $formData->getPreparedHeaders()->toArray(),
            'body' => $formData->bodyToIterable(),
        ]
    );

    return $response->toArray();
}

public function sendAudio(string $chatId, string $audioPath)
{
    $formFields = [
        'chat_id' => $chatId,
        'audio' => DataPart::fromPath($audioPath),
    ];
    $formData = new FormDataPart($formFields);

    $response = $this->httpClient->request(
        Request::METHOD_POST,
        self::API . $this->token . '/' . self::SEND_AUDIO,
        [
            'headers' => $formData->getPreparedHeaders()->toArray(),
            'body' => $formData->bodyToIterable(),
        ]
    );

    return $response->toArray();
}


public function sendPhoto(string $chatId, string $photoPath)
{
    $formFields = [
        'chat_id' => $chatId,
        'photo' => DataPart::fromPath($photoPath),
    ];
    $formData = new FormDataPart($formFields);

    $response = $this->httpClient->request(
        Request::METHOD_POST,
        self::API . $this->token . '/' . self::SEND_PHOTO,
        [
            'headers' => $formData->getPreparedHeaders()->toArray(),
            'body' => $formData->bodyToIterable(),
        ]
    );

    return $response->toArray();
}


}