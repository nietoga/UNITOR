<?php

namespace App\Util;
use GuzzleHttp\Client;

use function GuzzleHttp\json_decode;

class GogglesAdvisor {
    public function getRandomGoggles() {
        $full_url = 'http://goggles.ml/api/goggle';

        $client = new Client();
        $advise = [];

        $res = $client->get($full_url);

        if ($res->getStatusCode() == 200) {
            $body = json_decode($res->getBody()->getContents());
            $data = $body->data;
            $advise['reference'] = $data->reference;
            $advise['price'] = $data->price;
            $advise['image'] = $data->image;
            $advise['site'] = $data->site;
        }

        return $advise;
    }
}