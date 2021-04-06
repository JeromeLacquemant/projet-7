<?php
declare(strict_types=1);

namespace App\Responder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class JsonResponder
{
    const codeHttpOk = HttpFoundationResponse::HTTP_OK;
    const cacheTiming = 3600;

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function respond($response, $request, $group, $codeHttp=self::codeHttpOk)
    {         
        $jsonResponse = new JsonResponse(
                $this->serializer->serialize($response, 'json', $group),
                $codeHttp,
                [],
                true
            );

        $jsonResponse->headers->set('Content-Type', 'application/json');

        if($request->isMethodCacheable() == "GET")
        {
            $jsonResponse->setMaxAge(self::cacheTiming);
        }
        
        return $jsonResponse;
    }
}