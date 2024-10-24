<?php

$base = 'http://localhost:8080';

function newsAll($page = 0, $base = '')
{
    $url = $base . '/api/news';

    if ($page) $url .= '?page=' . $page;

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response, true);
}

function newsOne($id = 0, $base = '')
{
    $url = $base . '/api/news/' . $id;

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response, true);
}

function newsSearch($search = '', $base = '')
{
    $search = urlencode($search);

    $url = $base . '/api/news' . '?search=' . $search;

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response, true);
}