<?php

namespace App\Http\Services;

use App\ValueObjects\Resource;
use GuzzleHttp\Client;

class LocationService
{
    /**
     * @var Client
     */
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('LOCATION_URL'),
            'headers' => [
                'Authorization' => env('LOCATION_API'),
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * @return string[]
     */
    public function list()
    {
        return Resource::AVAILABLE_CITY;
    }

    /**
     * @param $city
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function nearby($city): array
    {
        $request = $this->client->get('search?near=' . $city . ', jp')->getBody();

        return json_decode($request,true);
    }

    /**
     * @param $city
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function ll($city): array
    {
        $city = $this->nearby($city);

        return [
            'lat'   => $city['context']['geo_bounds']['circle']['center']['latitude'],
            'long'  => $city['context']['geo_bounds']['circle']['center']['longitude'],
        ];
    }
}
