<?php
namespace schuetzenlust\easyverein;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

class Client
{
    private $client;
    private $apiToken;
    private $baseUrl = 'https://app.easyverein.com/api/v1.7/';

    public function __construct($apiToken)
    {
        $this->apiToken = $apiToken;
        $this->client = new GuzzleClient([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Token ' . $this->apiToken,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ]
        ]);
    }

    public function get($endpoint, $params = [])
    {
        try {
            $response = $this->client->request('GET', $endpoint, ['query' => $params]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function post($endpoint, $data = [])
    {
        try {
            $response = $this->client->request('POST', $endpoint, ['json' => $data]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function put($endpoint, $data = [])
    {
        try {
            $response = $this->client->request('PUT', $endpoint, ['json' => $data]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function delete($endpoint)
    {
        try {
            $response = $this->client->request('DELETE', $endpoint);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    private function handleException(RequestException $e)
    {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->hasResponse() ? json_decode($e->getResponse()->getBody(), true) : null
        ];
    }
}
