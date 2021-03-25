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
    const exceptionTypeNotFound = HttpFoundationResponse::HTTP_NOT_FOUND;
    const exceptionTypeForbidden = HttpFoundationResponse::HTTP_FORBIDDEN;
    const exceptionBadRequest = HttpFoundationResponse::HTTP_BAD_REQUEST;

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        switch (true) {
            case $exception instanceof NotFoundHttpException:
                $status = self::exceptionTypeNotFound;
                break;
            case $exception instanceof UserNotFoundException:
                $status = self::exceptionTypeNotFound;
                break;
            case $exception instanceof ClientNotFoundException:
                $status = self::exceptionTypeNotFound;
                break;
            case $exception instanceof ProductNotFoundException:
                $status = self::exceptionTypeNotFound;
                break;
            case $exception instanceof ClientUnauthorizedException:
                $status = self::exceptionTypeForbidden;
                break;
            default:    
                $status = self::exceptionBadRequest;
        }

        $customResponse = new JsonResponse(['status'=>$status, 'message' => $exception->getMessage()]);

        $event->setResponse($customResponse);
    }
}