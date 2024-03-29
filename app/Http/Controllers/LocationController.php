<?php

namespace App\Http\Controllers;

use App\Http\Services\LocationService;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    use ResponseTrait;

    public function __construct(private LocationService $locationService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $response =  $this->locationService->list();

        return $this->responseOne($response);
    }

    /**
     * @param $city
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function nearby($city): JsonResponse
    {
        $response = $this->locationService->nearby($city);

        return $this->responseOne($response);
    }

    /**
     * @param $city
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function position($city): JsonResponse
    {
        $response = $this->locationService->position($city);

        return $this->responseOne($response);
    }
}
