<?php
namespace App\EventListener;

use App\Exception\UserNotFoundException;
use App\Exception\ClientNotFoundException;
use App\Exception\ProductNotFoundException;
use App\Exception\ClientUnauthorizedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ExceptionListener
{
    const EXCEPTION_TYPE_NOT_FOUND = HttpFoundationResponse::HTTP_NOT_FOUND;
    const EXCEPTION_TYPE_FORBIDDEN = HttpFoundationResponse::HTTP_FORBIDDEN;
    const EXCEPTION_BAD_REQUEST = HttpFoundationResponse::HTTP_BAD_REQUEST;

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        switch (true) {
            case $exception instanceof NotFoundHttpException:
                $status = self::EXCEPTION_TYPE_NOT_FOUND;
                break;
            case $exception instanceof UserNotFoundException:
                $status = self::EXCEPTION_TYPE_NOT_FOUND;
                break;
            case $exception instanceof ClientNotFoundException:
                $status = self::EXCEPTION_TYPE_NOT_FOUND;
                break;
            case $exception instanceof ProductNotFoundException:
                $status = self::EXCEPTION_TYPE_NOT_FOUND;
                break;
            case $exception instanceof ClientUnauthorizedException:
                $status = self::EXCEPTION_TYPE_FORBIDDEN;
                break;
            default:    
                $status = self::EXCEPTION_BAD_REQUEST;
        }

        $customResponse = new JsonResponse(['message' => $exception->getMessage()], $status);

        $event->setResponse($customResponse);
    }
}