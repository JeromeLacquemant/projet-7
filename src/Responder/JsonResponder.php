<?php
declare(strict_types=1);

namespace App\Responder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class JsonResponder
{
    const CODE_HTTP_OK = HttpFoundationResponse::HTTP_OK;
    const CACHE_TIMING = 3600;
    const API_VERSION = "1.0.0";

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function respond($response, $request, $codeHttp=self::CODE_HTTP_OK)
    {         
        $option['json_encode_options'] = JSON_UNESCAPED_SLASHES;

        $jsonResponse = new JsonResponse(
                $this->serializer->serialize($response, 'json', $option),
                $codeHttp,
                [],
                true
            );

        $jsonResponse->headers->set('Content-Type', 'application/json;version= '.self::API_VERSION);

        if($request->isMethodCacheable() == true)
        {
            $jsonResponse->setMaxAge(self::CACHE_TIMING);
        }
        
        return $jsonResponse;
    }
}