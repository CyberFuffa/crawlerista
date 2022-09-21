<?php
/*
 * Crawlerista, an idealista crawler
 * 
 * Copyleft 2022, CyberFuffa, MIT license
 * 
 */

require_once('config.php');
require_once('helper.php');
require_once('lib/simple_html_dom.php');

$results = [];

foreach ($config['sources'] as $source => $url) {
    $buffer = loadUrl($url);

    $dom = new simple_html_dom();
    $dom->load($buffer);

    $domItems = $dom->find('.item-multimedia-container.item');

    if ($domItems) {
        foreach ($domItems as $domItem) {
            $img = $domItem->find('picture.item-multimedia img', 0)->src;
            $title = trim($domItem->find('div.item-info-container a', 0)->plaintext);
            $link = $domItem->find('div.item-info-container a', 0)->href;
            $price = trim($domItem->find('div.item-info-container div.price-row span.item-price', 0)->plaintext);
            $description = trim($domItem->find('div.item-description', 0)->plaintext);

            $results[$source][] = [
                'img' => $img,
                'title' => $title,
                'link' => $link,
                'price' => $price,
                'description' => $description
            ];
        }
    }
}

print_r($results);
