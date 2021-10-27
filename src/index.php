<?php

function index()
{
    // $client = new GuzzleHttp\Client();

    // $baseUrl = 'https://jsonplaceholder.typicode.com';

    // $response = $client->get($baseUrl . '/users');

    // $users = json_decode($response->getBody());

    // $result = [];

    // $slow = 'http://slowwly.robertomurray.co.uk/delay/1000/url/';

    // // foreach ($users as $user) {
    // //     $todoResponse = $client->get("$slow$baseUrl/users/$user->id/todos");

    // //     $todos = json_decode($todoResponse->getBody());

    // //     $user->todos = $todos;

    // //     $result[] = $user;

    // //     echo $user->name . PHP_EOL;
    // // }

    // Co\run(function () use ($users, &$result) {
    //     $client = $client = new GuzzleHttp\Client();

    //     foreach ($users as $user) {
    //         go(function () use ($client, $user, &$result) {
    //             $slow = 'http://slowwly.robertomurray.co.uk/delay/1000/url/';

    //             $todoResponse = $client->get("{$slow}https://jsonplaceholder.typicode.com/users/$user->id/todos");

    //             $todos = json_decode($todoResponse->getBody());

    //             $user->todos = $todos;

    //             $result[] = $user;

    //             echo $user->name . PHP_EOL;
    //         });
    //     }
    // });

    // $resultJson = json_encode($result);

    Co\run(function () {
        go(function () {
            co::sleep(3.0);
            go(function () {
                co::sleep(2.0);
                echo "co[3] end\n";
            });
            echo "co[2] end\n";
        });

        co::sleep(1.0);
        echo "co[1] end\n";
    });

    return APIResponse('');
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
