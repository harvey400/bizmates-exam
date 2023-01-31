<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{

    /**
     * @param $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseOne($data, $status = 200) : JsonResponse
    {
        return response()->json([
            "data" => $data
        ], $status);
    }

}
