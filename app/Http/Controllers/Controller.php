<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * @param Validator $validator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithFailedValidator(Validator $validator)
    {
        return Response::json($validator->getMessageBag()->toArray(), 422);
    }

    /**
     * @param array $data
     * @param array $meta
     */
    protected function respondWithData(array $data, array $meta = [])
    {
        return Response::json(array_merge(['data' => $data], $meta));
    }

    /**
     * @param LengthAwarePaginator $paginator
     */
    protected function respondWithPaginatedData(LengthAwarePaginator $paginator)
    {
        $data = $paginator->getCollection()->toArray();

        $payload = [
            'data' => $data,
            'pagination' => [
                'currentPage' => $paginator->currentPage(),
                'totalItems' => $paginator->total(),
                'itemsPerPage' => $paginator->perPage(),
                'links' => [
                    'next' => $paginator->nextPageUrl(),
                    'previous' => $paginator->previousPageUrl(),
                ]
            ],
        ];

        return Response::json($payload);
    }

    /**
     * @param string $message
     * @return mixed
     */
    protected function respondWithSuccess($message = '')
    {
        $payload = ['status' => 'ok'];
        if ($message) {
            $payload['success'] = $message;
        }

        return Response::json($payload);
    }

    /**
     * @param string $message
     * @param integer $code
     * @return mixed
     */
    protected function respondWithError($message = '', $code = 400)
    {
        $payload = ['status' => 'error'];
        if ($message) {
            $payload['error'] = $message;
        }

        return Response::json($payload, $code);
    }
}
