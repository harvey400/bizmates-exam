<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class WeatherService
{

    private Client $client;

    public function __construct(private LocationService $locationService)
    {
        $this->client = new Client([
            'base_uri' => env('WEATHER_URL'),
            'headers' => [
                'Authorization' => env('WEATHER_API'),
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * @param $lat
     * @param $lon
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($city)
    {
        $pos = $this->locationService->position($city);

        $response = $this->clientGetRequest('weather', $pos);

        return json_decode($response,true);
    }


    /**
     * @param $city
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function forecast($city)
    {
        $pos = $this->locationService->position($city);

        $response = $this->clientGetRequest('forecast', $pos);

        return json_decode($response,true);
    }

    /**
     * @param $url
     * @param $params
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function clientGetRequest($url, $params)
    {
        $query = [
            'appid' => env('WEATHER_API'),
            'units' => 'metric'
        ];

        $query = array_merge($query,$params);

        return $this->client->get($url, [
            'query' => $query
        ])->getBody();
    }

}
