<?php

namespace App\Http\Traits;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

trait ClientTrait
{
    protected function postData($data)
    {
        $client = new Client();
        return $response = $client->request("POST", env("DICE_SITE").env("DICE_API_URL"), $data)->getBody();
    }
}
