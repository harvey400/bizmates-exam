<?php

namespace App\Http\Controllers;

use App\Http\Services\WeatherService;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    use ResponseTrait;

    public function __construct(private WeatherService $weatherService)
    {
    }

    /**
     * @param Request $request
     * @param $city
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show(Request $request): JsonResponse
    {
        $response = $this->weatherService->get($request['city']);

        return $this->responseOne($response);
    }

    /**
     * @param Request $request
     * @param $city
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function forecast(Request $request): JsonResponse
    {
        $response = $this->weatherService->forecast($request['city']);

        return $this->responseOne($response);
    }
}
