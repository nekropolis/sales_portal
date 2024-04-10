<?php

namespace App\Traits;

use App\Api\ApiAbstractController;
use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * Returns a generic success (200) JSON response.
     */
    public function responseSuccess(string $message = 'Success.'): JsonResponse
    {
        return response()->json([
            'status'  => 200,
            'message' => $message,
        ], 200);
    }

    /**
     * Returns a generic success (200) JSON response.
     */
    public function responseSuccessData(array $data = []): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'data'   => $data,
        ], 200);
    }

    /**
     * Returns an bad request (400) JSON response.
     *
     * @param  array  $errors
     *
     * @return JsonResponse
     */
    public function responseBadRequest($errors = ['Bad request.']): JsonResponse
    {
        return response()->json([
            'status' => 400,
            'errors' => $errors,
        ], 400);
    }

    /**
     * Returns an unauthorized (401) JSON response.
     *
     * @param  array  $errors
     *
     * @return JsonResponse
     */
    public function responseUnauthorized($errors = ['Unauthorized.']): JsonResponse
    {
        return response()->json([
            'status' => 401,
            'errors' => $errors,
        ], 401);
    }

    /**
     * Returns a unprocessable entity (422) JSON response.
     */
    public function responseUnprocessable(array $errors = []): JsonResponse
    {
        return response()->json([
            'status' => 422,
            'errors' => $errors,
        ], 422);
    }

    /**
     * Returns a server error (500) JSON response.
     */
    public function responseServerError(array $errors = ['Server error.']): JsonResponse
    {
        return response()->json([
            'status' => 500,
            'errors' => $errors,
        ], 500);
    }

    /**
     * Returns a server error (200) JSON response.
     */
    public function responseThrowError(array $errors = ['Server error.']): JsonResponse
    {
        return response()->json([
            'status' => 500,
            'errors' => $errors,
        ], 200);
    }

    public function responseServerExceptionDetailed(
        \Throwable $exception,
        array $data = []
    ): JsonResponse {
        report($exception);

        return response()->json([
            'status'    => 500,
            'errors'    => [$exception->getMessage()],
            'message'   => $exception->getMessage(),
            'data'      => $data,
            'detailed' => [
                'message' => $exception->getMessage(),
                'file'    => $exception->getFile(),
                'line'    => $exception->getLine(),
                'trace'   => $exception->getTrace(),
                'code'    => $exception->getCode(),
            ],
        ], 500);
    }
}
