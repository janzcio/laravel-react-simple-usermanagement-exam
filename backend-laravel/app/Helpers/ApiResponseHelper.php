<?php

if (! function_exists('respond')) {
    function respond($statusCode = 200, $message = null, $data = null): \Illuminate\Http\JsonResponse
    {
        $statusText = getStatusText($statusCode);

        $response = [
            'status'      => $statusCode,
            'description' => $statusText,
            'message'     => $message,
        ];

        if (! is_null($data)) {

            switch (true) {
                case isset($data['error_code']):
                    $response['error_code'] = $data['error_code'];
                    break;

                case isset($data['error']):
                    $response['error'] = $data['error'];
                    break;

                default:
                    $response['data'] = $data;
                    break;
            }
        }

        return response()->json($response, $statusCode);
    }
}

if (! function_exists('success')) {
    function success($message = null, $data = null, $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        return respond($statusCode, $message, $data);
    }
}

if (! function_exists('notFound')) {
    function notFound($message = 'Not Found', $data = null): \Illuminate\Http\JsonResponse
    {
        return respond(404, $message, $data);
    }
}

if (! function_exists('badRequest')) {
    function badRequest($message = 'Bad Request', $data = null): \Illuminate\Http\JsonResponse
    {
        return respond(400, $message, $data);
    }
}

if (! function_exists('error')) {
    function error($errorMessage, $statusCode = 500, $data = null): \Illuminate\Http\JsonResponse
    {
        return respond($statusCode, $errorMessage, $data);
    }
}

if (! function_exists('getStatusText')) {
    function getStatusText($statusCode): string
    {
        $statusTexts = [
            '100' => 'Continue',
            '101' => 'Switching Protocols',
            '200' => 'OK',
            '201' => 'Created',
            '204' => 'No Content',
            '400' => 'Bad Request',
            '401' => 'Unauthorized',
            '403' => 'Forbidden',
            '404' => 'Not Found',
            '422' => 'Unprocessable Entity',
            '429' => 'Too Many Requests',
            '500' => 'Internal Server Error',
        ];

        return $statusTexts[$statusCode] ?? 'Unknown';
    }
}
