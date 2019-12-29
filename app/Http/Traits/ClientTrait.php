<?php

namespace App\Http\Traits;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

trait ClientTrait
{
    protected function postData($data)
    {
        $client = new Client();
        return $client->request("POST", env("DICE_SITE").env("DICE_API_URL"), $data);
    }

    public function getData()
    {
        $client = new Client();
        return $client->request("GET", env("DICE_SITE"));
    }
}
