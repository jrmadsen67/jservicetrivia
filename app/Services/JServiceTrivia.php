<?php namespace App\Services;

use App\User;
use GuzzleHttp\Exception\ClientException;


class JServiceTrivia{

    protected $endpoint = 'http://jservice.io/api/';

    public function getRandomClue($count=100){
        $url = $this->endpoint . 'random?count=' . $count;
        return $this->fetch($url);
    }

    private function fetch($url){
        $client = new \GuzzleHttp\Client();

        try {
            $res = $client->request('GET', $url,[]
            );
            return ['code' => $res->getStatusCode(), 'body' => $res->getBody()->getContents()];
        } catch (ClientException $e) {
            $res = $e->getResponse();
            return ['code' => $res->getStatusCode(), 'body' => $res->getReasonPhrase()];
        }
    }
}