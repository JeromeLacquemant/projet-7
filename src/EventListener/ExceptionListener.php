<?php
namespace App\EventListener;

use App\Exception\ValidationException;
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

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        switch (true) {
            case $exception instanceof NotFoundHttpException:
                $status = 404;
                $message = $exception->getMessage();
                $constant = self::exceptionTypeNotFound;
                break;
            case $exception instanceof UserNotFoundException:
                $status = 404;
                $message = $exception->getMessage();
                $constant = self::exceptionTypeNotFound;
                break;
            case $exception instanceof ClientNotFoundException:
                $status = 404;
                $message = $exception->getMessage();
                $constant = self::exceptionTypeNotFound;
                break;
            case $exception instanceof ProductNotFoundException:
                $status = 404;
                $message = $exception->getMessage();
                $constant = self::exceptionTypeNotFound;
                break;
            case $exception instanceof ClientUnauthorizedException:
                $status = 403;
                $message = $exception->getMessage();
                $constant = self::exceptionTypeForbidden;
                break;
        }

        $customResponse = new JsonResponse(['status'=>$status, 'message' => $message], $constant);

        $event->setResponse($customResponse);
    }
}