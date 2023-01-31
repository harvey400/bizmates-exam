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
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(Request $request): JsonResponse
    {
        $response = $this->weatherService->get($request['lat'], $request['lon']);

        return $this->responseOne($response);
    }
}
