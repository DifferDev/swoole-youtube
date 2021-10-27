<?php

function index()
{
    $client = new GuzzleHttp\Client();

    $baseUrl = 'https://jsonplaceholder.typicode.com';

    $response = $client->get($baseUrl . '/users');

    $users = json_decode($response->getBody());

    $result = [];

    // Versão Sync
    // $slow = 'http://slowwly.robertomurray.co.uk/delay/1000/url/';

    // // foreach ($users as $user) {
    // //     $todoResponse = $client->get("$slow$baseUrl/users/$user->id/todos");

    // //     $todos = json_decode($todoResponse->getBody());

    // //     $user->todos = $todos;

    // //     $result[] = $user;

    // //     echo $user->name . PHP_EOL;
    // // }

    // Versão Async
    Co\run(function () use ($users, &$result) {
        $client = new GuzzleHttp\Client();

        foreach ($users as $user) {
            go(function () use ($client, $user, &$result) {
                $slow = 'http://slowwly.robertomurray.co.uk/delay/1000/url/';

                $todoResponse = $client->get("{$slow}https://jsonplaceholder.typicode.com/users/$user->id/todos");

                $todos = json_decode($todoResponse->getBody());

                $user->todos = $todos;

                $result[] = $user;

                echo $user->name . PHP_EOL;
            });
        }
    });

    $resultJson = json_encode($result);

    return APIResponse($resultJson);
}

function APIResponse($body)
{
    $headers = [
        'Content-Type' => 'text/html',
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Headers' => 'Content-Type',
        'Access-Control-Allow-Methods' => 'OPTIONS,POST,GET'
    ];

    // Padrão de saída
    return json_encode([
        'statusCode' => 200,
        'headers' => $headers,
        'body' => $body
    ]);
}
