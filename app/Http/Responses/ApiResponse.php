<?php

namespace App\Http\Responses;

class ApiResponse
{
    public static function get(array $data, int $statusCode)
    {
        return response()
            ->json($data, $statusCode);
    }
}
