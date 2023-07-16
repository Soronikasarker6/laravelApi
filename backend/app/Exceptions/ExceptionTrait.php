<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTraits
{
    public function apiException($apiExc, $e)
    {
        if ($this->isModel($e)) {
            return $this->ModelResponse($e);
        }

        if ($this->isHttp($e)) {
            return $this->HttpResponse($e);
        }
    }
    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }
    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }
    protected function ModelResponse($e)
    {
        return response()->json(
            [
                'Error' => 'Model not Found'
            ],
            Response::HTTP_NOT_FOUND
        );
    }
    protected function HttpResponse($e)
    {
        return response()->json(
            [
                'Error' => 'Incorrect Route'
            ],
            Response::HTTP_NOT_FOUND
        );
    }
}
