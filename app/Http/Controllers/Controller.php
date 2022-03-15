<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected $errorMessage = [
        200 => 'OK',
        204 => 'No Content',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        412 => 'Precondition Failed',
        415 => 'Unsupported Media Type',
        500 => 'Internal Server Error',
        501 => 'Not Implemented'
    ];

    /**
     * @param $response
     * @return JsonResponse
     */
    protected function sendSuccess($response)
    {
        return response()->json(
            $this->frameResponse(false, 200, 'OK', $this->sendResponse($response)),
            200);
    }

    /**
     * @param $response
     * @return array|object
     */
    protected function sendResponse($response)
    {
        if (config('security.encrypt_enabled') === true) {
            return ($response) ? (object)['response' => app('securityServices')->encrypt(json_encode($response))] : (object)[];
        } else {
            return (object)$response;
        }
    }

    /**
     * @param $response
     * @param int $status
     * @return JsonResponse
     */
    protected function sendError($response, $status = 200)
    {
        return response()->json(
            $this->frameResponse(true, $status, $this->errorMessage[$status], $this->sendResponse($response)),
            200);
    }

    /**
     * @param $response
     * @return JsonResponse
     */
    protected function validationError($response)
    {

        return response()->json(
            $this->frameResponse(true, 422, 'Unprocessable Entity Error', $this->sendResponse($response)), 422);
    }

    /**
     * @param bool $error
     * @param int $statusCode
     * @param string $statusMessage
     * @param array|object $data
     * @return array
     */
    protected function frameResponse(bool $error, int $statusCode, string $statusMessage, $data): array
    {
        return [
            'error' => $error,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'data' => $data,
            'responseTime' => time()
        ];
    }


}
