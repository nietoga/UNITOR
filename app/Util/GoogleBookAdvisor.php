<?php

namespace App\Util;

use App\Interfaces\BookAdvisor;
use GuzzleHttp\Client;

use function GuzzleHttp\json_decode;

class GoogleBookAdvisor implements BookAdvisor {
    public function getAdvise($query) {
        $full_url = 'https://www.googleapis.com/books/v1/volumes';
        $full_url .= '?q=' . $query;
        $full_url .= '&maxResults=1&orderBy=relevance';
        $full_url .= '&key=' . config('services.google.key');

        $client = new Client();
        $advise = [];

        $res = $client->get($full_url);

        if ($res->getStatusCode() == 200) {
            $body = json_decode($res->getBody()->getContents());

            if ($body->totalItems > 0) {
                $items = $body->items;
                $volumeInfo = $items[0]->volumeInfo;
                $advise['title'] = $volumeInfo->title;
                $advise['url'] = $volumeInfo->previewLink;

                if (property_exists($volumeInfo, 'imageLinks') && property_exists($volumeInfo->imageLinks, 'thumbnail')) {
                    $advise['cover_url'] = $volumeInfo->imageLinks->thumbnail;
                } else {
                    $advise['cover_url'] = 'https://i.redd.it/m7gjgqdiy2v11.jpg';
                }
            }
        }

        return $advise;
    }
}