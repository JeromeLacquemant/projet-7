<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;


class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();
        
        // create json response and set the nice message from exception
        $customResponse = new JsonResponse(['status'=>false, 'message' => $exception->getMessage()],403);
        
        // set it as response and it will be sent
        $event->setResponse($customResponse);
    }
}