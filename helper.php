<?php
/*
 * Crawlerista, an idealista crawler
 * 
 * Copyleft 2022, CyberFuffa, MIT license
 * 
 */

function loadUrl($url) {
    $headers = [
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'accept-encoding: identity',
        'accept-language: en-US,en;q=0.9',
        'cache-control: no-cache',
        'pragma: no-cache',
        'sec-ch-ua: "Google Chrome";v="105", "Not)A;Brand";v="8", "Chromium";v="105"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Linux"',
        'sec-fetch-dest: document',
        'sec-fetch-mode: navigate',
        'sec-fetch-site: none',
        'sec-fetch-user: ?1',
        'upgrade-insecure-requests: 1',
        'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36',
    ];

    $headerBuffer = '';
    foreach ($headers as $header) {
        $headerBuffer .= $header . "\r\n";
    }

    $opts = [
    'http' => [
        "method" => "GET",
        'header' => $headerBuffer
        ]
    ];

    $context = stream_context_create($opts);

    return file_get_contents($url, FALSE, $context);
}